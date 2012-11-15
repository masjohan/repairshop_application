<?php

define('APP_DIR', 'application/');

class Controller {
    // vars for tmeplate engine, read/write for all
    private $_tplVars = array();

    // parameter or resource, read ONLY for outside
    private $_runParams = array();

    private $_resolve_path;
    private $_output_type;
    private $_top_url;

    public static function getInstance() {
        static $singlton;
        if (!$singlton) $singlton = new Controller();
        return $singlton;
    }

    private function __construct(){
    	spl_autoload_register(array($this, 'loader'));
    }

	private function loader($class_name) {
        $path = str_replace ('_','/',$class_name).'.php';

        foreach(array(APP_DIR.'/model/', '/usr/share/php/', '/usr/share/pear/') as $try) {
            if (is_file($try.$path)) {
                require_once $try.$path;
                break;
            }
        }
    }

    public function start($ini_tpl_vars = NULL) {
    	// time is important
        date_default_timezone_set('America/Vancouver');
        // setup propel
        require_once APP_DIR . 'model/propel/lib/Propel.php';
        Propel::init(APP_DIR . 'model/propel/build/conf/repairshop-conf.php');
        set_include_path(APP_DIR . 'model/propel/build/classes' . PATH_SEPARATOR . get_include_path());

        /* passed in tpl vars, something has to be run at index router */
        if ($ini_tpl_vars) $this->_tplVars = array_merge($this->_tplVars, $ini_tpl_vars);
        $this->hasLogin();  // build user

        // the first thing, start profilling
        $this->param('profile',new TW_Profile());

        $this->profile->mark('start session');
        $this->param('session',new TW_Session());

        $this->dispatch($_SERVER['REQUEST_URI']);

        // dump profile info
        if (isset($_REQUEST['profile']) && $this->_output_type == 'html') {
            print $this->profile->as_html();
        }
    }

    public function dispatch($url) {
        if (!isset($this->_top_url)) {
            $this->_top_url = $url;
        }
        ## sets our default templateand handler to run
        $this->profile->mark('url map');
        $this->route($url);

        ## run handler
        $this->profile->mark('run');
		$this->run();
        if ($this->_top_url !== $url) return;

        ## varity of content type html,json,yaml,atom,storable
        $this->profile->mark('display');
        $this->display();
    }

    public function __set ($name, $value) {
        $this->_tplVars[$name] = $value;
    }

    /* get tpl var first; otherwise params var */
    public function __get ($name) {
        return array_key_exists($name, $this->_tplVars)
            ? $this->_tplVars[$name]
            : ( array_key_exists($name, $this->_runParams)
                 ? $this->_runParams[$name]
                 : NULL
            );
    }

    public function param ($name, $value=NULL, $to_unset = FALSE) {
        if ($to_unset) {
            unset($this->_runParams[$name]);
        } else if( $value===NULL ) {
            return $this->_runParams[$name];
        } else {
            $this->_runParams[$name] = $value;
        }
    }

    /* map url to a specific handler and template */
    private function route($url) {
        $uri_path = preg_replace('/\?.*$/','',$url);

        // url always pretty, end with index.php, index, .php or something/, remove them, 2+/ => /
        $path = preg_replace(
            array('/\/{2,}/','/(?<=\w)\/+$/','/(index\.php|index|\.php)$/'),
            array('/','',''),
            $uri_path
        );

        // if url not perfect, redirect
        if($path !== $uri_path) {
            header('Location: '.$path.($_SERVER['QUERY_STRING'] ? "?{$_SERVER['QUERY_STRING']}" : ''), TRUE, 302);
            exit;
        }

        if(preg_match('/^\/(jsonp?|yaml|atom|storable|session|cache|parts)\b/', $path, $match)) {
            $this->_output_type = $match[1];
            $path = str_replace("/{$match[1]}", '', $path);
        } else {
            $this->_output_type = 'html';
        }

        if ($path === '/') $path = '';

        // handler and tpl are pair; tpl is mandatory, hdl is optional
        $hdl_dir = APP_DIR.'templates';
        while(!is_file($hdl_dir.$path.'.twig')) {
            // if dir, serve index file
            if(is_dir($hdl_dir.$path)) {
                $path .= '/index';

            // a file path, not exist
            } else if (preg_match('/(?<=\w)\/(\w+)$/', $path, $match)) {

                // try this dir, parent dir
                $path = $match[1] == 'index'
                    ? preg_replace('/\/\w+\/\w+$/', '', $path)
                    : preg_replace('/\/\w+$/', '', $path);

                $bad_request = TRUE;

            // by all means, serve home page
            } else {
                $path = '';
                $bad_request = TRUE;
            }
        }

        if (isset($bad_request)) {
            $path = preg_replace(array('/index$/','/(?<=\w)\/+$/'), array('',''), $path)
                    .($_SERVER['QUERY_STRING'] ? "?{$_SERVER['QUERY_STRING']}" : '');

            header('Location: '.$path, TRUE, 302);
            exit;
        }

        // remove leading '/'; no why, just do it
        $path = preg_replace('/^\//', '', $path);

        $this->_resolve_path = $path;
	}

    private function run($hdl_path = null, array $params = null) {
        // get valid function name
        if ($hdl_path === NULL) $hdl_path = $this->_resolve_path.".php";
        $full_hdl_path = APP_DIR.'handler/'.$hdl_path;

        if (!is_file($full_hdl_path)) return;

        // no handler is allowed case
        if ($params === NULL) $params = array();

        // save the run vars before run
        $tmpVars = $this->_runParams;
        $this->_runParams = array_merge($this->_runParams, $params);

        // get source code and remove php tag
        $code = preg_replace('/^\s*<\?php|\?>\s*$/', '', file_get_contents($full_hdl_path));

        // create function and run it
        try {
            $func = create_function('$C', $code);
        	call_user_func($func, $this);
        } catch (Exception $e) {
            print('Caught exception: '.$e->getMessage()."\n");
            exit;
        }

        // store _runParams
        $this->_runParams = $tmpVars;
    }

    private function display($tpl = NULL, $return = false) {
        if($tpl) {
        	$this->_resolve_path = $tpl;
        	return;
        } else {
        	$tpl = $this->_resolve_path.".twig";
        }

        if ($this->_output_type == 'json') {
            header('Content-type: application/json');
            foreach(array('phpbb_user') as $p) unset($this->_tplVars[$p]);
            print json_encode($this->_tplVars);

        } else if ($this->_output_type == 'jsonp' && $_REQUEST['callback']){
            header('Content-type: text/javascript');
            print $_REQUEST['callback'].'('.json_encode($this->_tplVars).')';

        } else {
        	$html = TW_PropelHelper::create()->render($tpl, array_merge(
        		$this->_tplVars,
        		array(
        			'C' => $this,
        			'request' => $_REQUEST,
        			'server' => $_SERVER,
        		)
        	));

        	/* typically return a section of page */
        	if ($return) return $html;

            /* css/js in right place will be include by magic */
        	$this->loadCSS("site/{$this->_resolve_path}.css");
        	$this->loadJS("site/{$this->_resolve_path}.js");

        	print Asset_Loader::compileJsCss($html);
        }
    }

    public function loadJS(/*js files*/) {
        foreach(func_get_args() as $one) Asset_Loader::$js_files[] = $one;
        return '';
    }

    public function loadCSS(/*css files*/) {
        foreach(func_get_args() as $one) Asset_Loader::$css_files[] = $one;
        return '';
    }

    public function hasLogin() {
        return $this->_resolve_path !== 'index';
    }
 }
