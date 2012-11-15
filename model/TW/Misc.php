<?php

class TW_Misc {
    const CACHEDIR = 'static/cache/';

    public static function getYahooWeatherFeed() {
        $cachepath = self::CACHEDIR . "serialized.weather.feed";

        if (!is_file($cachepath) || (filemtime($cachepath) + 3600) < mktime()) {
            $channel = new Zend_Feed_Rss('http://weather.yahooapis.com/forecastrss?p=CAXX0523&u=c');
            foreach($channel as $item) break;

            $desc = $item->description();

            if (preg_match('/<img.*?\/>/i', $desc, $match)) {
                list($img) = $match;
            }
            $plain = preg_replace('/\s/', ' ', strip_tags($desc));
            if (preg_match('/Current Conditions:(.*?\d C)/im', $plain, $match)) {
                list($_, $brief) = $match;
                $brief = preg_replace('/ C$/', '&#176;C', $brief);
            }

            $result = array(
                'description'   => $desc,
                'short'         => $brief,
                'img'           => $img,
            );
            file_put_contents($cachepath , serialize($result));
        } else {
            $result = unserialize(file_get_contents($cachepath));
        }
        return $result;
    }

    public static function getGasPrice() {
        $cachepath = self::CACHEDIR . "serialized.gas.price";

        if (!is_file($cachepath) || (filemtime($cachepath) + 3600) < mktime()) {

            $fp = fsockopen("meridaup.dlinkddns.com", 80, $errno, $errstr, 30);
            if (!$fp) {
                echo "$errstr ($errno)<br />\n";
            } else {
                $out = "GET /vicnews/gasprice.aspx?pagekind=gas HTTP/1.1\r\n";
                $out .= "Host: meridaup.dlinkddns.com\r\n";
                $out .= "Connection: Close\r\n\r\n";
                fwrite($fp, $out);
                while (!feof($fp)) {
                    $content .= fgets($fp);
                }
                fclose($fp);
            }

            $result = array(
                'description'   => $content
            );
            file_put_contents($cachepath , serialize($result));
        } else {
            $result = unserialize(file_get_contents($cachepath));
        }
        return $result;
    }
}

?>
