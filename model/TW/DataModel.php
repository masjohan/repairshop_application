<?php

class TW_DataModel {

    private $dirtyStatus = -1;              // 0: clean from db; 1: dirty, need update; -1: new, need insert
    private $_propery = array();            // field values
    private $_reference = array();          // FK: reference objects

    // clean up (user's) vars recursively, designed for GET POST COOKIE
    public static function safeVars(&$data, $allowLimitedHtml = NULL) {
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
    		TW_DataModel::safeVars($value, $allowLimitedHtml);
    	}
    }

    // searchFor the models with their values from the database
    public static function searchFor($cls, $where, $orderby = NULL) {
        $mo = new $cls;
        return $mo->hydrate($where, $orderby);
    }

    public static function searchForOne($cls, $where, $orderby = NULL) {
        $mo = new $cls;
        $ret = $mo->hydrate($where, array('orderby' => $orderby, 'limit' => 1));
        return count($ret) ? $ret[0] : NULL;
    }

    // Class name === Table name? No. override this
    protected function table() {
        return get_class($this);
    }

    // define reference FK
    protected function FK() {
        return array(/*
          [key_name] => array(
          'reference'     => [datamodel class],
          'foreign'    => array('ref_fk_col1' => $this->fk_col1),
          'orderby'    => array('col1' => 'asc'),
          ) */);
    }

    // CAUSTION: will be put into db as is
    protected function reservedKey() {
        return array(/* 'modified' => 'NOW()' */);
    }

    // find PK and their value from table definition
    protected function PK() {
        $PK = array();
        foreach ($this->definition() as $field => $define) {
            if ($define['isPK'])
                $PK[$field] = $this->property($field);
        }

        return $PK;
    }

    // magic get property or reference via
    public function __get($name) {
        $val = $this->property($name);
        if ($val !== FALSE)
            return $val;

        $val = $this->reference($name);
        if ($val !== FALSE)
            return $val;

        $p = $this->reference('parent');

        return $p ? $p->$name : FALSE;
    }

    // magic set property
    public function __set($name, $val) {
        return $this->property($name, $val);
    }

    public function __sleep() {
        // array_keys(get_object_vars($this));
        return array('dirtyStatus', '_propery');
    }

    public function save($cascade = NULL) {
        if ($this->dirtyStatus == 0)
            return FALSE;

        $dbh = Db::getInstance();
        $table = $this->table();
        $reserved_field = $this->reservedKey();
        $reserved_key = array_keys($reserved_field);
        $goodDb = array();

        if ($this->dirtyStatus < 0) {
            foreach ($this->definition() as $name => $defn) {
                if ($defn['autoincr']) {
                    $autoIncrField = $name;
                    continue;
                }
                $goodDb[$name] = $this->property($name);
            }

            $goodDb = array_merge($goodDb, $reserved_field);
            $res = $dbh->insert($table, $goodDb, $reserved_key);

            if ($autoIncrField && $res) {
                $this->_propery[$autoIncrField] = $res;
            }
        } else {
            foreach ($this->_propery as $name => $val) {
                $val = $this->validate($name, $val);
                if ($val === FALSE)
                    continue;
                $goodDb[$name] = $val;
            }

            $goodDb = array_merge($goodDb, $reserved_field);
            $where = $this->PK();
            $res = $dbh->update($table, $goodDb, $where, $reserved_key, 1);
        }

        if ($res) {
            $this->dirtyStatus = 0;

            if ($cascade)
                foreach ($this->_reference as $ref) {
                    if ($ref instanceof TW_DataModel) {
                        $ref->save($cascade);
                    }
                }
        }

        return (boolean) $res;
    }

    public function delete() {
        $table = $this->table();
        $where = $this->PK();

        if ($this->dirtyStatus < 0 || !$table || !$where)
            return FALSE;

        $rowsDeleted = Db::getInstance()->delete($table, $where, NULL, 1);

        if ($rowsDeleted) {
            // make it new
            $this->dirtyStatus = -1;

            // unset auto incr field
            foreach ($this->definition() as $name => $defn) {
                if ($defn['autoincr']) {
                    unset($this->_propery[$name]);
                };
            }
        }

        return (boolean) $rowsDeleted;
    }

    /* find array of instances given condition */

    // return base64_encode(gzcompress(serialize($obj)));
    // return unserialize(gzuncompress(base64_decode($txt)));
    protected function hydrate($where, $orderby = NULL) {
        $table = $this->table();

        $extra = array();
        if ($orderby && is_array($orderby))
            foreach ($orderby as $key => $val) {
                if (in_array($key, array('limit', 'offset', 'orderby'))) {
                    $extra[$key] = $val;
                } else {
                    $extra['orderby'][$key] = $val;
                }
            }

        $class = get_class($this);
        $insts = array();

        $res = Db::getInstance()->select($table, '*', $where, NULL, $extra);
        while ($row = $res->fetch_assoc()) {
            $o = new $class();
            // this is from db and is clean at this moment
            $o->dirtyStatus = 0;
            $o->property($row);
            $insts[] = $o;
        }

        return $insts;
    }

    // get table definition, or field definition if field name provided, show create table
    protected function definition($field = NULL) {
        static $definition = array();

        $table = $this->table();

        // get table definition from db
        if (!isset($definition[$table])) {
            $def = array();

            $desc = Db::getInstance()->query("DESC $table")->fetch_all_array();
            // Field | Type | Null | Key | Default | Extra
            foreach ($desc as $col) {
                $def[$col[0]] = array(
                    'type' => preg_match('/\w*int\b/i', $col[1]) ? 'i' : (preg_match('/float|double|decimal|real/i', $col[1]) ? 'd' : 's'
                            ), // i: integer; d: double; s: string
                    'canNULL' => $col[2] === 'YES',
                    'isPK' => $col[3] === 'PRI',
                    'default' => $col[4],
                    'autoincr' => preg_match('/auto_increment/', $col[5]),
                );
            }

            $definition[$table] = $def;
        }

        $def = $definition[$table];
        return $field ? (isset($def[$field]) ? $def[$field] : NULL) : $def;
    }

    // array of fields; hash; field; (field, val)
    protected function property(/* $name, $val */) {
        $args = func_get_args();

        // get all properties
        if (count($args) == 0) {
            $keys = array_keys($this->definition());
            return $this->property($keys);

            // get/set array of properties
        } else if (count($args) == 1 && is_array($args[0])) {
            $keys = array_keys($args[0]);

            if ($keys[0] === 0) {
                $ret = array();
                foreach ($items as $name) {
                    $ret[$name] = $this->property($name);
                }
                return $ret;
            } else {
                foreach ($args[0] as $name => $val) {
                    $this->property($name, $val);
                }
                return;
            }

            // get the property, name
        } else if (count($args) == 1) {
            $name = $args[0];
            if (isset($this->_propery[$name]))
                return $this->_propery[$name];

            $define = $this->definition($name);
            return $define ? $define['default'] : FALSE;

            // set the property, name:value
        } else if (count($args) > 1) {
            list($name, $val) = $args;
            $val = $this->validate($name, $val);

            // never use db save a boolean value
            if ($val === FALSE)
                return FALSE;

            // need updating when changed, from one value to another, excluding from NULL to a value
            if ($this->dirtyStatus === 0
                    && isset($this->_propery[$name])
                    && $this->_propery[$name] !== $val
            )
                $this->dirtyStatus = 1;

            $this->_propery[$name] = $val;

            return TRUE;
        }
    }

    // check the value for given field, considering dirty status, column type
    protected function validate($name, $val) {
        $col = $this->definition($name);

        // no db field definition
        if (!$col)
            return FALSE;
        // from db, can not change PK (sure init is allowed)
        else if ($this->dirtyStatus >= 0 && isset($this->_propery[$name]) && $col['isPK'])
            return FALSE;
        // new instatnce, can not set atuoincr
        else if ($this->dirtyStatus < 0 && $col['autoincr'])
            return FALSE;
        else if ($val === NULL)
            return $col['canNULL'] ? NULL : FALSE;
        else if ($col['type'] == 'i')
        // db does treat boolean as tinyint
            return is_bool($val) ? ($val ? 1 : 0) : (int) $val;
        else if ($col['type'] == 'd')
            return (float) $val;
        else
            return (string) $val;
    }

    // return array of reference objects
    protected function reference($ref_nm) {
        // use internal cache. @todo, what if user update fk value
        if (isset($this->_reference[$ref_nm]))
            return $this->_reference[$ref_nm];

        $rel = $this->FK();

        if (isset($rel[$ref_nm])) {
            $fk = $rel[$ref_nm];
            $ref = self::searchFor($fk['reference'], $fk['foreign'], isset($fk['orderby']) ? $fk['orderby'] : NULL);
        } else if ($ref_nm == 'parent'
                && ($super_cls = get_parent_class($this))
                && is_subclass_of($super_cls, TW_DataModel)
        ) {
            // parent - child must have same PK
            $pk = $this->PK();
            $ref = self::searchForOne($super_cls, $pk);
        } else {
            $ref = FALSE;
        }

        $this->_reference[$ref_nm] = $ref;
        return $ref;
    }

}
