<?php
class TW_Profile {
  private $_profile;

  public function __construct() {
  $this->_profile = array();
  $this->mark('::START::');
  }

  public function mark($name) {
  /* for dup name, just append an increment number */
  while(isset($this->_profile[$name])) {
    $name = preg_match('/^(.+?)(\d+)$/', $name, $match) ? ($match[1].($match[2]+1)) : "$name-1";
  }
  $this->_profile[$name] = microtime(TRUE);
  }

  public function as_html() {
  $this->mark('::END::');
  $html = $this->as_html_level(0, 700);
  return '<style>
    .profile-data {
    background-color:#E2FAFE;
    border:1px solid black;
    font-family:sans-serif;
    font-size:10px;
    padding:1em;
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
  </style>
    <div class="profile-data">'.
    implode('',$html)
    .'</div>';
  }

  private function as_html_level ($left, $width) {
  $start_time = $this->_profile['::START::'];
  $elapsed_time = $this->_profile['::END::'] - $start_time;

  $_unit_width = $width / $elapsed_time;
  $_colors = array('red','green','blue','orange','#8CF6FE');
  $duration = array();

  // calculate duration between each mark
  foreach($this->_profile as $name => $timemark) {
    if ($name != '::START::') {
    $duration[$prev_name] = $timemark - $prev_time;
    }
    $prev_name = $name;
    $prev_time = $timemark;
  }

  // total
  $html[] = '<div class="group-tick" style="margin-left:'.
      round($left)
      .'px;width:'.
      round($width)
      .'px;background-color:'
      .$_colors[0].';">'
      .'</div> Total: '.round($elapsed_time,6).'s<br/>';

  $i = 0;
  foreach($this->_profile as $name => $timemark) {
    if ($name == '::END::') {
    continue;
    }

    $color = $_colors[$i % 5];
    $left = ($timemark - $start_time) * $_unit_width;
    $length = $duration[$name] * $_unit_width;
    $perc = round($duration[$name] * 100.0 / $elapsed_time, 1);
    $i++;

    if ($name == '::START::' && !round($length)) continue;
    $html[] = '<div class="group-tick" style="margin-left:'.
      round($left)
      .'px;width:'.
      round($length)
      .'px;background-color:'
      .$color.';">'
      .'</div> '.($name == '::START::' ? 'start' : $name).' '.round($duration[$name],6)."s ($perc%)<br/>";
  }

  return $html;
  }
}