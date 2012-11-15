<?php
Class TW_Session {
    public function __construct() {
        session_start();
    }

    public function login() {

    }

    public function is_login() {

    }

    public function log_out() {

    }

    const SIGN_URL = '__s_h';   // jus make it weired
    const SIGN_URL_SALT = 'kl78qw45ew5^$%&RSfas90dfg8q34ASDFLDRYBWY^ER%^WTQW%$Q#5qwioruvqwrupqwv34%E^&%Eysdhawetw$%V^QW%V@#5';

    public function signUrl($url = NULL, $isMatch = FALSE) {
        if (!$url) $url = $_SERVER["REQUEST_URI"];

        $parts = parse_url($url);
        parse_str($parts['query'], $output);

        if ($output[self::SIGN_URL]) unset($output[self::SIGN_URL]);
        $signBase = $parts['path']. ($output ? ("?".http_build_query($output)) : '');

        $output[self::SIGN_URL] = sha1($signBase.session_id().$_SERVER['REMOTE_ADDR'].self::SIGN_URL_SALT);

        return $isMatch
            ? ($output[self::SIGN_URL] == $_GET[self::SIGN_URL])
            : ($parts['path'].'?'.http_build_query($output));
    }

    /**
    * @param string $url
    * @return boolean
    */
    public function matchUrl($url = NULL) {
        return $this->signUrl($url, TRUE);
    }
}
