<?php
class TW_Profile_Group extends TW_Profile {
  private static $_profile;
  private static $_stack;

  public function __construct() {

  self::$_profile = array();
  self::$_stack = array();
  $this->mark('start');
  }

  // leave a named time marker on current profile
  // when notExisting, do marker only if $name does not exist
  public function mark($name) {
  $array = &$this->current_array();
  if($name) {
    $this->_pick_name($name, $array);
    $array[$name] = microtime(true);
  } else {
    $array[] = microtime(true);
  }
  }

  // start a new profile group
  public function start($name) {
  $array = &$this->current_array();

  $this->_pick_name($name, $array);
  $array[$name] = array();
  self::$_stack[] = $name;

  $this->mark('start');
  }

  // wrap up a named profile group; name must in stach; wrap up all the groups until
  // named group pop up from stack top
  public function end($name) {
  if(!in_array($name, self::$_stack)) return;
  while(1) {
    $this->mark('end');
    # exit when find from the stack top
    if($name == array_pop(self::$_stack)) break;
  }
  }

  // make sure name is not defined in hash by auto increment name_#
  private function _pick_name (&$name, &$hash) {
  while(isset($hash[$name])) {
    if(preg_match('/_(\d+)$/',$name,$match)) {
    $name = str_replace($match[0], '_'.(intval($match[1])+1), $name);
    } else {
    $name .= '_1';
    }
  }
  }

  // return reference to an array on the top of stack. So any modification
  // on that array will also be applied on _profile
  private function &current_array() {
  $array = &self::$_profile;
  foreach(self::$_stack as $merge_point) {
    $array = &$array[$merge_point];
  }
  return $array;
  }

  private function _clear_group() {
  while(count(self::$_stack)) $this->finish();
  if(!isset(self::$_profile['end'])) $this->mark('end');
  }

  public function print_r() {
  $this->_clear_group();
  return print_r(self::$_profile, TRUE);
  }

  public function as_html() {
  $this->_clear_group();
  $this->as_html_level($html, self::$_profile,'Profile',0.0, 700.0);
  return '<style>
    .profile-data {
    background-color:#E2FAFE;
    border:1px solid black;
    font-family:sans-serif;
    font-size:10px;
    padding:1em;
    width:8200px;
    }
    .group-tick {
    float:left;
    clear:left;
    height:3px;
    position:relative;
    top:5px;
    margin-right:6px;
    border-top:1px solid #000;
    border-bottom:1px solid #000;
    }
    .mark-tick {
    float:left;
    clear:left;
    width:1px;
    height:7px;
    position:relative;
    top:4px;
    margin-right:6px;
    }
  </style>
    <div class="profile-data">'.
    implode('',$html)
    .'</div>';
  }

  private function as_html_level (&$html, &$array, $name,$left, $width) {
  static $count = 0;

  $start_time = $array['start'];
  $elapsed_time = $array['end'] - $start_time;

  if(!isset($this->_unit_width)) {
    $this->_unit_width = $width / $elapsed_time;
    $this->_profile_start = $start_time;
    $this->_elapsed_time = $elapsed_time;
    $this->_colors = array('red','green','blue','orange','#8CF6FE');
  }
  $color = $this->_colors[$count++ % 5];

  $perc = round($elapsed_time * 100.0 / $this->_elapsed_time, 1);
  $perctage = $perc>1 && $perc<99 ? " ($perc%)" : '';
  $html[] = '<div class="group-tick" style="margin-left:'.
      round($left)
      .'px;width:'.
      round($width)
      .'px;background-color:'
      .$color.';">'
      .'</div> '.$name.' '.round($elapsed_time,4)."$perctage<br/>";

  foreach($array as $mark => $value) {
    if ( is_array($value) ) {
    $this->as_html_level($html, $value, $mark,
      $left + ($value['start'] - $start_time) * $this->_unit_width,
      ($value['end'] - $value['start']) * $this->_unit_width
    );
    } else if ( is_float($value) ) {
    $html[] = '<div class="mark-tick" style="margin-left:'.
      round($left + ($value - $start_time) * $this->_unit_width)
      .'px;background-color:#000;">'
      .'</div>'.$mark.' '.round($value-$this->_profile_start,4)."<br/>";
    }
  }
  }


}