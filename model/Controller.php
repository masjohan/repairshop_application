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

    // sanitize the world
    TW_PropelHelper::safeVars($_POST);
    TW_PropelHelper::safeVars($_GET);
    TW_PropelHelper::safeVars($_REQUEST);
    TW_PropelHelper::safeVars($_COOKIE);
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

  public function start() {
  	// time is important
    date_default_timezone_set('America/Vancouver');
    // setup propel
    require_once APP_DIR . 'model/propel/lib/Propel.php';
    Propel::init(APP_DIR . 'model/propel/build/conf/repairshop-conf.php');
    set_include_path(APP_DIR . 'model/propel/build/classes' . PATH_SEPARATOR . get_include_path());
    // the first thing, start profilling
    $this->param('dbh', Propel::getConnection());

    // the first thing, start profilling
    $this->param('profile',new TW_Profile());

    $this->profile->mark('start session');
    $this->param('session', TW_Session::getInstance());
    $this->param('acl', Biz_ACL::getInstance());

    $this->dispatch($_SERVER['REQUEST_URI']);

    // dump profile info
    if (isset($_REQUEST['profile']) && $this->_output_type == 'html') {
      print $this->profile->as_html();
    }
  }

  /**
   * It is possible for handler call this, like rewrite
   * @param type $url
   */
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

  /**
   * run params is for C running, NOT intended for tpl.
   * tpl can access this by C.param('name').
   * IMPORTANT, those value would go fly with /json/
   */
  public function param ($name, $value = NULL, $to_unset = NULL) {
    if ($to_unset === TRUE) {
      unset($this->_runParams[$name]);
    } else if( $value === NULL ) {
      // return call_user_func(array($class, 'getInstance')); BAD idea
      return isset($this->_runParams[$name]) ? $this->_runParams[$name] : NULL;
    } else {
      $this->_runParams[$name] = $value;
    }
  }

  // output type can be resolve from path or override by handler
  public function outputType($pathType) {
    // set type directly
    if (preg_match('/^(jsonp?|yaml|session|cookie|cache)$/', $pathType)) {
      $this->_output_type = $pathType;
    // path imply the output type request
    } else if(preg_match('/^\/(jsonp?|yaml|session|param|cookie|cache)\b/', $pathType, $match)) {
      $this->_output_type = $match[1];
      $pathType = str_replace("/{$match[1]}", '', $pathType);
    } else {
      $this->_output_type = 'html';
    }
    return $pathType;
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

    $path = $this->outputType($path);
    if ($path === '/') $path = '';

    // handler and tpl are pair; it is fine either tpl or hdl exists
    // if tpl not exists, hdl need to take care it, redirect or json
    $tpl_dir = APP_DIR.'templates';
    $hdl_dir = APP_DIR.'handler';
    while(!is_file($tpl_dir.$path.'.twig') && !is_file($hdl_dir.$path.'.php')) {
      // if dir, serve index file
      if(is_dir($tpl_dir.$path)) {
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

    // ACL check
    $this->param('acl')->check($path);

    $this->_resolve_path = $path;
	}

  // handle can another handler, use $C->run, instead or include()
  public function run($hdl_path = null, array $params = null) {
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
      print json_encode($this->_tplVars);
    } else if ($this->_output_type == 'jsonp' && $_REQUEST['callback']){
      header('Content-type: text/javascript');
      print $_REQUEST['callback'].'('.json_encode($this->_tplVars).')';
    } else if ($this->_output_type == 'yaml') {
      header('Content-type: text/x-yaml');
      print yaml_emit($this->_tplVars);
    } else if ($this->_output_type == 'session') {
      header('Content-type: text/plain');
      print json_encode($_SESSION, JSON_PRETTY_PRINT);
    } else if ($this->_output_type == 'param') {
      header('Content-type: text/plain');
      print json_encode($this->_runParams, JSON_PRETTY_PRINT);
    } else if ($this->_output_type == 'cookie') {
      header('Content-type: text/plain');
      print json_encode($_COOKIE, JSON_PRETTY_PRINT);
    } else {
      $html = TW_PropelHelper::create()->render($tpl, array_merge(
        $this->_tplVars,
        array(
          'C' => $this,
          'request' => $_REQUEST,
          'server' => $_SERVER,
        ),
        $this->param('session')->throwNext()
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
    return $this->param('session')->is_login();
  }

  public function checkLogin() {
    // if false redirect /redirect=currenturl
    return TRUE;
  }

  public function instance($class) {
  }
}
