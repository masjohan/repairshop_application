<?php
class TW_PassThru {
    static $mime = array (
        'ps'     => "application/postscript",
        'gz'     => "application/x-gzip",
        'tgz'    => "application/x-tgz",
        'tar'    => "application/x-tar",
        'zip'    => "application/zip",
        'swf'    => "application/x-shockwave-flash",
        'mp3'    => "audio/mpeg",
        'gif'    => "image/gif",
        'jpg'    => "image/jpeg",
        'jpeg'   => "image/jpeg",
        'png'    => "image/png",
        'css'    => "text/css",
        'html'   => "text/html",
        'htm'    => "text/html",
        'js'     => "text/javascript",
        'json'   => 'text/javascript',
        'txt'    => "text/plain",
        'xml'    => "text/xml",
        'htc'    => "text/x-component",
        'atom'   => 'application/atom+xml',
        'ical'   => 'text/calendar',
        'csv'    => 'text/csv'
    );

	public static function pass_exist_thru(){
		// map request to a path under web root
		$inSite = '.'.$_SERVER['SCRIPT_NAME'];

		// return false if not file or not supported file type
		if (!is_file($inSite) || !preg_match('/\.(\w+)$/', $inSite, $matches) || ! self::$mime[$matches[1]]) {
			return FALSE;
		}

		$mtime = filemtime($inSite);
		if(self::sendNoModify($mtime)) return TRUE;

		header("ETag: " . base64_encode($mtime));
		header("Last-Modified: " . gmdate('D, j M Y H:i:s T',$mtime));

		header("Content-Type: " . self::$mime[$matches[1]]);
		header("Content-Length: " . filesize($inSite));

		readfile($inSite);

		return TRUE;
	}

	// Send 304 if meet condition
	public static function sendNoModify($mtime) {
		$req = apache_request_headers();

		if(isset($req['If-None-Match']) && base64_decode($req['If-None-Match'])==$mtime){
            header("HTTP/1.1 304 Not Modified");
            return TRUE;
		}
		if(isset($req['If-Modified-Since'])){
			$dt = date_parse_from_format("D, j M Y H:i:s T", $req['If-Modified-Since']);
            if($dt['error_count']==0) {
				date_default_timezone_set($dt['tz_abbr']);
				$since = mktime($dt['hour'],$dt['minute'],$dt['second'],$dt['month'],$dt['day'],$dt['year']);
                if($mtime <= $since) {
                    header("HTTP/1.1 304 Not Modified");
					return TRUE;
				}
			}
		}

		return FALSE;
	}

}