<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PropelHelper
 *
 * @author tao
 */
class TW_PropelHelper {
    public static function create() {
        $loader = new Twig_Loader_Filesystem(APP_DIR.'templates');
        $twig = new Twig_Environment($loader);
        $twig->addFilter('php', new Twig_Filter_Function('TW_PropelHelper::callPhp'));

        return $twig;
    }
    /**
     * mainly for twig to call php function
     * @return string, whatever the php function return
     */
    public static function callPhp() {
        $args = func_get_args();

        // trick: to stop ouput, just ...|php
        if (count($args) < 2) {
            return '';
        }

        list($func) = array_splice($args, 1, 1);

        if (function_exists($func)) {
            /* all any existing php function
             * in twig: '{"a":1,"b":"this is b"}'|php('json_decode')
             * limitation: - no variable reference; - no php const;
             */
            return call_user_func_array($func, $args);
        } else if (preg_match('/^\((integer|int|float|string|boolean|bool|array|object)\)$/', $func)) {
            /* type juggling
             * in twig:  '{"a":1,"b":"this is b"}'|php('json_decode')|php('(array)')
             */
            eval("\$r = $func(\$args[0]);");
            return $r;
        } else if ($func == 'truncate' && ($lenLimit = (int) $args[1])) {
            /* truncate string
             * in twig 'some string'|php('truncate', 10)
             */
            return preg_replace('/^(.{' . $lenLimit . '}).+$/', '$1...', $args[0]);
        } else if ($func == 'commify') {
            /* find number in a chunk of text and replace with thousand ","
             * in twig: 'a chunk of text'|php('commify')
             */
            return preg_replace('/(\d{1,3})(?=(?:\d{3})+(?!\d))/', '$1,', $args[0]);
        } else {
            // donot know what to do, untouch return
            return $args[0];
        }
    }
}

?>