<?php
class Asset_cssmin{
  /**
   * Minifies stylesheet definitions
   *
   * @param   string  $v  Stylesheet definitions as string
   * @return   string  Minified stylesheet definitions
   */
  public static function minify($v) {
  return trim(preg_replace(
    array("/\/\*.*?\*\//s",'/\s*([{}:,;])\s*/', "/\s{2,}/"),
    array(null, '$1', ' '),
    $v
  ));
  }
}