<?php

/**
 * This class is exclusively a helper for fetch result from query_bind when SELECT
 **/
class MySQLi_STMT_Fetch {
    private $keys;
    private $bind_results;
    private $stmt; // MySQLi_STMT
    private $_next_row;

    function __construct($stmt, $fields) {
        foreach($fields as $i => $field) {
            $this->keys[] = $field->name;
            $bind_name = 'rslt'.$i;
            $$bind_name = '';
            $this->bind_results[] = &$$bind_name;
        }
        call_user_func_array(array($stmt, "bind_result"), $this->bind_results);

        $stmt->store_result();

        $this->stmt = $stmt;

        $this->_fetch_next();
    }

    private function _fetch_next() {
        if ($this->_next_row === FALSE) return NULL;

        $this_row = $this->_next_row;

        if ($this->stmt->fetch()) {
            $this->_next_row = array();
            foreach($this->bind_results as $ele) $this->_next_row[] = $ele;
        } else {
            $this->_next_row = FALSE;
            $this->stmt->close();
        }

        return $this_row;
    }

    public function fetch_row() {return $this->_fetch_next();}

    public function fetch_array() {return $this->_fetch_next();}

    public function fetch_assoc() {return ($_ = $this->_fetch_next()) ? array_combine($this->keys, $_) : NULL;}

    public function fetch_object() {return ($_ = $this->_fetch_next()) ? (object)array_combine($this->keys, $_) : NULL;}

    public function fetch_all_array() {
        while($row = $this->fetch_array()) $res[] = $row;
        return $res;
    }

    public function fetch_all_assoc() {
        while($row = $this->fetch_assoc()) $res[] = $row;
        return $res;
    }

    public function fetch_all_object() {
        while($row = $this->fetch_object()) $res[] = $row;
        return $res;
    }

    // explose some useful property from "stmt"
    public function __get($property) {
        return in_array($property, array('num_rows','affected_rows','insert_id','field_count','errno','error'))
            ? $this->stmt->$property
            : NULL;
    }
}

class TW_Db {

    protected $conn;

    public static function getInstance(mysqli $conn = NULL) {
        static $singlton;

        if (!$singlton) {
            $singlton = new Db();
            $singlton->conn = $conn ? $conn : new mysqli('127.0.0.1', 'root', '1qazXSW@','phpbb');
        }
        return $singlton;
    }

    private function __construct() {}

    public function close() {
        $this->conn->close();
    }

    public function query() {
        return call_user_func_array(array($this, 'query_bind'), func_get_args());
    }

    public function query_bind($sql/* $bindVa1, $bindVa2 ...*/) {
        if (!($stmt = $this->conn->prepare($sql))) Debuger::dump("SQL prepare ERROR $sql");

        // paremeter itself has to be a reference to a variable
        $params = array_slice(func_get_args(),1);
        if (count($params)) {
            foreach ($params as $i => $param) {
                $bind_name = 'para'.$i;
                $$bind_name = $param;
                $bind_params[] = &$$bind_name;
                $type[] = is_integer($param) ? 'i' : (is_double($param) ? 'd' : 's');
            }
            array_unshift($bind_params, implode('',$type));
            if(!call_user_func_array(array($stmt, "bind_param"), $bind_params)) {
                Debuger::dump("SQL bind_param ERROR $sql $stmt->error");
            }
        }

        if (!$stmt->execute()) Debuger::dump("SQL execute ERROR $sql $stmt->error");

        // need a helper if having result set
        if ($result = $stmt->result_metadata()) {
            $fields = $result->fetch_fields();
            $thing = new MySQLi_STMT_Fetch($stmt, $fields);
        // either insert_id or affected_rows
        } else {
            $thing = $stmt->insert_id ? $stmt->insert_id : $stmt->affected_rows;
            $stmt->close();
        }

        return $thing;
    }

    // clean up (user's) vars recursively, designed for GET POST COOKIE
    public function safeVars(&$data, $allowLimitedHtml = NULL) {
        // safe html guard
        static $reg_check = '/(javascript|vbscript)\s*:|<\s*(script|embed|object)|\bon(click|dblclick|mousedown|mouseup|mousemove|mouseout|keydown|keypress|keyup|load|unload|abort|error|resize|scroll|select|change|submit|reset|focus|blur|domfocusin|domfocusout|domactivate|subtreemodified|nodeinserted|noderemoved|domnoderemovedfromdocument|domnodeinsertedintodocument|attrmodified|characterdatamodified|cut|copy|paste|beforecut|beforecopy|beforepaste|afterupdate|beforeupdate|cellchange|dataavailable|datasetchanged|datasetcomplete|errorupdate|rowenter|rowexit|rowsdelete|rowinserted|contextmenu|drag|dragstart|dragenter|dragover|dragleave|dragend|drop|selectstart|help|beforeunload|stop|beforeeditfocus|start|finish|bounce|beforeprint|afterprint|propertychange|filterchange|readystatechange|losecapture)\s*=/i';
        static $allowedTags = '<h1><h2><h3><h4><h5><h6><img><ul><ol><li><b><strong><p><br>';

        if (is_string($data)) {
            $data = trim($data);

            if ($data === ''){
                $data = NULL;
            } else if ($allowLimitedHtml && !preg_match($reg_check, $data)) {
                $data = strip_tags($data, $allowedTags);
            } else {
                $data = strip_tags($data);
            }

        } else if (is_array($data)) foreach($data as $key => &$value) {
            $this->safeVars($value, $allowLimitedHtml);
        }
    }

    public function update($table, $data, $where='', $reserved_keys=NULL, $limit_num=0) {

        $set = array();
        $params = array();
        foreach($data as $key => $val) {
            $is_reserved = is_array($reserved_keys) && in_array($key, $reserved_keys);

            $set[] = $is_reserved ? "`$key`=$val" : "`$key`=?";
            if (!$is_reserved) $params[] = $val;
        }
        $set = implode(',', $set);

        list($condition, $where_params) = $this->buildWhere($where, $reserved_keys);
        array_splice($params, count($params), 0, $where_params);

        $limit = $this->buildLimit($limit_num);

        array_unshift($params, "UPDATE `$table` SET $set $condition $limit");

        return call_user_func_array(array($this, 'query_bind'), $params);
    }

    public function insert($table, $data, $reserved_keys = NULL, $update_keys = NULL, $ignore = NULL) {
        $fields = array();
        $values = array();
        $params = array();
        $updates = array();

        foreach($data as $key => $val) {
            $is_reserved = is_array($reserved_keys) && in_array($key, $reserved_keys);

            $fields[] = "`$key`";
            $values[] = $is_reserved ? $val : '?';
            if (!$is_reserved) $params[] = $val;
        }

        foreach($data as $key => $val) if (is_array($update_keys) && in_array($key, $update_keys)) {
            $is_reserved = is_array($reserved_keys) && in_array($key, $reserved_keys);

            $updates[] = $is_reserved ? "`$key`=$val" : "`$key`=?";
            if (!$is_reserved) $params[] = $val;
        }

        $fields = implode(',', $fields);
        $values = implode(',', $values);
        $updates = count($updates) ? 'ON DUPLICATE KEY UPDATE'.implode(',', $updates) : '';
        $ignore = $ignore ? 'IGNORE' : '';

        array_unshift($params, "INSERT $ignore INTO `$table` ($fields) VALUES ($values) $updates");

        return call_user_func_array(array($this, 'query_bind'), $params);
    }

    public function delete ($table, $where, $reserved_keys = NULL, $limit_num=0) {
        list($condition, $params) = $this->buildWhere($where, $reserved_keys);
        $limit = $this->buildLimit($limit_num);
        array_unshift($params, "DELETE FROM `$table` $condition $limit");

        return call_user_func_array(array($this, 'query_bind'), $params);
    }

    // $ext['orderby'], $ext['limit'], $ext['offset']
    public function select ($table, $items, $where, $reserved_keys = NULL, $ext = NULL) {
        // select list
        $items = $items === '*' ? '*' : ('`'.(is_array($items) ? implode('`,`', $items) : $items).'`');

        // where and parameter binding
        list($condition, $params) = $this->buildWhere($where, $reserved_keys);

        // order by
        $order = array();
        if ($ext && isset($ext['orderby']) && $ext['orderby']) {
            if (is_array($ext['orderby'])) {
                foreach($ext['orderby'] as $field=>$asc) {
                    $order[] = "`$field` ".(preg_match('/^desc$/i', $asc) ? 'DESC' : 'ASC');
                }
            } else {
                $order[] = $ext['orderby'];
            }
        }
        $order = count($order) ? ('ORDER BY '.implode(', ', $order)) : '';

        $limit = '';
        if ($ext && isset($ext['limit']) && $ext['limit']) {
            if (isset($ext['offset'])) {
                $limit = 'LIMIT '.intval($ext['offset']).','.intval($ext['limit']);
                /* SELECT SQL_CALC_FOUND_ROWS; SELECT FOUND_ROWS(); */
                $items = "SQL_CALC_FOUND_ROWS $items";
            } else {
                $limit = 'LIMIT '.intval($ext['limit']);
            }
        }

        array_unshift($params, "SELECT $items FROM `$table` $condition $order $limit");

        return call_user_func_array(array($this, 'query_bind'), $params);
    }

    private function buildWhere (&$where, &$reserved_keys) {
        $params = array();
        $condition = array();

        if (is_array($where)) foreach($where as $key => $val) {

            if ($val === NULL) {
                $condition[] = "`$key` IS NULL";
            } else if (is_array($reserved_keys) && in_array($key, $reserved_keys)) {
                $condition[] = "`$key`=$val";
            } else {
                $condition[] = "`$key`=?";
                $params[] = $val;
            }

        } else if ($where) {
            $condition[] = $where;
        }
        $condition = count($condition) ? ('WHERE '.implode(' AND ', $condition)) : '';

        return array($condition, $params);
    }

    private function buildLimit($limit_num) {
        $limit_num = (int)$limit_num;
        return $limit_num > 0 ? "LIMIT $limit_num" : '';
    }

    // call only immediately after select limit
    public function foundTotal() {
        list($found) = $this->conn->query('SELECT FOUND_ROWS()')->fetch_array();
        return $found;
    }

    public function __call($method, $params) {
        if (is_callable(array($this->conn, $method))) {
            return call_user_func_array(array($this->conn, $method), $params);

        } else {
            throw new Exception('Undefined method $method on DB object');

        }
    }
}

