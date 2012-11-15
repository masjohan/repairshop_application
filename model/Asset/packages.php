<?php
/*
 * array of package alias to their file name
 */
$alias = array(
    'jquery'            => 'core/jquery-1.3.2.min.js',
    'selectboxes'       => 'core/jquery.selectboxes.js',
    'tablesorter'       => 'core/jquery.tablesorter.min.js',
    'datepicker'        => 'core/jqueryui/ui.datepicker.js',
    'validate'          => 'core/validate.js',
    'uicore'            => 'core/jqueryui/ui.core.min.js',
    'tabs'              => 'core/jqueryui/ui.tabs.min.js',
    'stepcarousel'      => 'core/stepcarousel.js',
    'jcarousel'         => 'core/jcarousel.js',
    'tooltip'           => 'core/jquery.qtip-1.0.0-beta4.min.js',
    'region'            => 'core/region.js',
    'accordion'         => 'core/jqueryui/ui.accordion.1.7.2.min.js',
    'urlutil'           => 'core/urlutil.js',
    'multifile'         => 'core/jquery.MultiFile.pack.js',
    'maskedinput'       => 'core/jquery.maskedinput-1.2.2.min.js',
    'phpajax'           => 'core/jquery.php.js',
    'rw'                => 'core/util/rw.js',
    'cookie'            => 'core/util/cookie.js',
    'string'            => 'core/util/string.js',
    'function'          => 'core/util/function.js',
    'uievent'           => 'core/util/uievent.js',
    'popover'           => 'core/util/popover.js',
    'formval'           => 'core/util/formval.js',
);


/*
 * an alias name maped to their required dependency
 * if you register the alias its dependencies will automaticlly load
 */
$dependencies = array (
    'datepicker'    => array('jquery'),
    'validate'      => array('jquery'),
    'uicore'        => array('jquery'),
    'tabs'          => array('uicore'),
    'selectboxes'   => array('jquery'),
    'tablesorter'   => array('jquery'),
    'stepcarousel'  => array('jquery'),
    'jcarousel'     => array('jquery'),
    'tooltip'       => array('jquery'),
    'accordion'     => array('jquery','uicore'),
    'urlutil'       => array('jquery'),
    'multifile'     => array('jquery'),
    'maskedinput'   => array('jquery'),
    'phpajax'       => array('jquery'),
    'cookie'        => array('rw'),
    'uievent'       => array('rw'),
    'popover'       => array('uievent','function','string','jquery'),
    'formval'       => array('uievent','function','jquery'),
);

return array($alias,$dependencies);
?>