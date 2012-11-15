<?php

/**
 * Loader class, handles css, js request like
 * DEGUG ?loader to debug js or css
 *
 */

class Asset_Loader {
    private $cachedir = 'static/cache';
    private $mode; // either script (js) or style (css)

    static private $alias = array(
        'jquery'            => 'jquery/jquery-1.7.2.js',
        'rw'                => 'util/rw.js',
        'string'            => 'util/string.js',
        'array'             => 'util/array.js',
        'function'          => 'util/function.js',
        'formval'           => 'util/formval.js',
        'jformval'         	=> 'util/jformval.js',
        'popover'           => 'util/popover.js',
    	'jpopover'          => 'util/jpopover.js',
    	'messager'          => 'util/messager.js',
        'juicore'           => 'jquery/ui/jquery.ui.core.js',
        'juiwidget'         => 'jquery/ui/jquery.ui.widget.js',
        'juimouse'       	=> 'jquery/ui/jquery.ui.mouse.js',
        'juiposition'       => 'jquery/ui/jquery.ui.position.js',
        'juidraggable'      => 'jquery/ui/jquery.ui.draggable.js',
        'juidroppable'      => 'jquery/ui/jquery.ui.droppable.js',
        'juiresizable'      => 'jquery/ui/jquery.ui.resizable.js',
        'juiselectable'     => 'jquery/ui/jquery.ui.selectable.js',
        'juisortable'       => 'jquery/ui/jquery.ui.sortable.js',
        'juiaccordion'      => 'jquery/ui/jquery.ui.accordion.js',
        'juiautocomplete'   => 'jquery/ui/jquery.ui.autocomplete.js',
        'juibutton'       	=> 'jquery/ui/jquery.ui.button.js',
    	'juidatepicker'     => 'jquery/ui/jquery.ui.datepicker.js',
    	'juidialog'         => 'jquery/ui/jquery.ui.dialog.js',
        'juitabs'           => 'jquery/ui/jquery.ui.tabs.js',
        'jmetadata'         => 'plugins/jquery.metadata.js',
        'jtablesorter'      => 'plugins/jquery.tablesorter.js',
        'jtablesorterpager' => 'plugins/jquery.tablesorter.pager.js',
    );

    static private $dependon = array(
        'rw'                => array('jquery'),
        'formval'           => array('rw','function'),
        'jformval'         	=> array('rw','function','juidatepicker'),
    	'popover'           => array('rw','function'),
    	'jpopover'          => array('juiposition','function'),
    	'juicore'           => array('jquery'),
        'juiwidget'         => array('juicore'),
        'juimouse'          => array('juicore'),
    	'juiposition'       => array('juicore'),
        'juidraggable'      => array('juiwidget', 'juimouse'),
        'juidroppable'      => array('juidraggable'),
        'juiresizable'      => array('juiwidget', 'juimouse'),
        'juiselectable'     => array('juiwidget', 'juimouse'),
        'juisortable'       => array('juiwidget', 'juimouse'),
        'juibutton'			=> array('juiwidget'),
        'juidatepicker'     => array('juicore'),
        'juidialog'         => array('juiposition', 'juiresizable', 'juidraggable'),
        'juitabs'           => array('juiwidget'),
        'juiaccordion'      => array('juiwidget'),
        'juiautocomplete'   => array('juiwidget','juiposition'),
        'jmetadata'         => array('jquery'),
        'jtablesorter'      => array('jmetadata'),
        'jtablesorterpager' => array('jtablesorter'),
    );

    static public $js_files = array();
    static public $css_files = array();

    static public function compileJsCss($html) {
    	$ld = new Asset_Loader();

    	$stype_script = $ld->build_html(array(
    	            'css' => array_unique(self::$css_files),
    	            'js' => array_unique(self::$js_files)
    	));

    	// try after title
    	$html = str_replace('</title>', '</title>'.$stype_script, $html, $count);
    	// otherwise before the end of head
    	if (!$count) $html = str_replace('</head>', $stype_script.'</head>', $html);

    	return $html;
    }

    private function __construct(){}

    private function load($files, $lastmodified){
        $ETag = md5(implode('', $files));

        $cachepath = $this->cachedir.'/'.$ETag.'.'.$this->mode;

        $forceRebuild = isset($_REQUEST['loader']) && ($_REQUEST['loader']=='nominify' || $_REQUEST['loader']=='minify');

        if ( $forceRebuild || !file_exists($cachepath) || $lastmodified>filemtime($cachepath) ) {
            $this->build($files, $cachepath, !isset($_REQUEST['loader']) || $_REQUEST['loader'] != 'nominify');
        }

        return $ETag;
    }

    /**
     * compile, minify, save
     **/
    private function build($files, $cachepath, $compressor) {
        foreach ($files as $path) {
            $contents[] = file_get_contents(APP_DIR."./$this->mode/$path");
        }
        // use ";" to concat js file
        $contents = implode($this->mode == 'js' ? ';' : '', $contents);

        file_put_contents($cachepath, $contents);

        if ($compressor) {
            exec("java -jar ".dirname(__FILE__)."/yuicompressor-2.4.7.jar -o $cachepath $cachepath");
        }
    }

    /**
     * recursive call to solve dependency. The dependency info either defined by package conf
     * or from magic line, first line of file read as // require def1 | ...
     *
     * @return modify &$files in place
     **/
    private function depend($req_one, &$files, $visited) {
        $dependon = isset(self::$dependon[$req_one]) ? self::$dependon[$req_one] : array();

        // turn nick name into path / file name
        if (isset(self::$alias[$req_one])) $req_one = self::$alias[$req_one];

        // already required
        if (isset($visited[$req_one])) return;
        $visited[$req_one] = TRUE;

        $realfile = APP_DIR."{$this->mode}/{$req_one}";
        // internal dependency definition take over magic line
        if( count($dependon) == 0 && is_readable($realfile))  {
			// retrieve magic line
        	$handle = fopen($realfile, "r");
            $magic_line = fgets($handle, 4096);
            fclose($handle);

            foreach(array('/^\s*\/\/\s*require(.*)$/','/^\s*\/\*\s*require(.*?)\*\//') as $re) {
            	if (preg_match($re, $magic_line, $match)) {
            		foreach (preg_split('/\s*\|\s*/', trim($match[1]), null, PREG_SPLIT_NO_EMPTY) as $_) {
            			$dependon[] = $_;
            		}
            	}
            }
        }

        foreach(array_unique($dependon) as $_) $this->depend($_, $files, $visited);
        if (is_readable($realfile)) $files[$req_one] = TRUE;
    }

    public function build_html($assetFiles) {

        $assetUnit = array();

        foreach(array(
            'css' => '<link rel="stylesheet" type="text/css" href="/'.$this->cachedir.'/__ASSET__.css" />',
            'js' => '<script type="text/javascript" language="javascript" src="/'.$this->cachedir.'/__ASSET__.js"></script>'
        ) as $mode => $html) {
            $this->mode = $mode;

            // solve dependency
            $files = array();
            foreach($assetFiles[$mode] as $dep) {
                $this->depend($dep, $files, array());
            }
            if (!count($files)) continue;
            $files = array_keys($files);

            // determine lastest modification time
            $lastmodified = 0;
            foreach($files as $fi)
                if( ($modified = filemtime(APP_DIR."$mode/$fi")) > $lastmodified )
                    $lastmodified = $modified;

            $assetUnit[] = str_replace('__ASSET__', $this->load($files, $lastmodified),$html);

            // debug, show collected files
            if(isset($_REQUEST['loader']) && $_REQUEST['loader']=='collect') {
                $assetUnit[] = '<!-- '.print_r($files,TRUE).' -->';
            }
        }

        return implode("\n",$assetUnit);
    }
}
