<?php
class Debuger {
    /* start server: php ~/script/log_server.php */
    private static $port = 10000;

    public static function dump($desc, $v, $depth = 0) {
        $string = self::dumpModel($v, $depth);

        if (($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP))
            && socket_connect($socket, 'localhost', self::$port)
            && socket_write($socket, "$desc: $string\n")
        ) socket_close($socket);
    }

    private static function dumpModel($thing, $depth) {
        if ( !is_object($thing) && !is_array($thing) ) {
            return (string)$thing;
        } else if ( $depth < 0 ) {
            return is_object($thing) ? get_class($thing) : 'Array';
        }

        $data = array();
        foreach((array)$thing as $k => $v) {
            $k = preg_match('/\w+$/', $k, $match) ?  $match[0] : count($data);
            // 4 space indent same as print_r, but not beginning or the end
            $data[$k] = trim(preg_replace('/^/m', '    ',  self::dumpModel($v, $depth - 1)));
        }

        $pretty = print_r($data, true);
        return is_object($thing) ? preg_replace('/^Array/', get_class($thing), $pretty) : $pretty;
    }
    
}