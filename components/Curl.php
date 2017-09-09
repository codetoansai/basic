<?php
//@class: CURL
//@author: sans_amour, thuongtin@gmail.com, dom@clnase.org
//@date: June, 10, 2010
//@last update: Apr, 17,2012
namespace app\components;


class Curl {
    var $contents;
    var $_header;
    var $headers;
    var $hlist = array();
    var $body;
    var $url="";
    var $realm;
    var $ua;
    var $proxy;
    var $prtype;
    var $tout = 10;
    var $uploadArr = array();
    var $opts = false;
    var $cookiefile = "cookie.txt";
    var $auth = false;
    var $error_code = 0;
    var $error_error = "";
    var $info = "";
    var $h = true;
    var $errorStr;
    var $stopWhenError = false;


    function exec($method, $url, $vars="", $referer="", $ua="Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/45.0 Chrome/39.0.2171.103 Safari/537.36", $realm="") {
        $this->hlist[] = 'Expect:';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, $this->h);
        //curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, true);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        if(is_array($realm) && !is_array($this->realm)){
            $this->realm = $realm;
        }

        if(is_array($this->realm)){
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_USERPWD ,$this->realm[0].':'.$this->realm[1]);
        }
        if(is_array($this->auth)){
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_USERPWD ,$this->auth[0].':'.$this->auth[1]);
        }

        if($this->proxy!=""){
            if(strstr($this->proxy,"@")){
                $t = explode("@",$this->proxy);
                $up = $t[0];
                $ip = $t[1];
            }
            curl_setopt($ch, CURLOPT_PROXY, ($ip)?$ip:$this->proxy);
            curl_setopt($ch, CURLOPT_PROXYTYPE, $this->prtype);
            if($up){
                curl_setopt($ch,CURLOPT_PROXYAUTH,CURLAUTH_NTLM);
                curl_setopt($ch,CURLOPT_PROXYUSERPWD,$up);
            }
        }

        //var_dump($this->realm);

        if (!$this->ua) {
            if($ua) $this->ua = $ua;
        }
        if($this->ua) curl_setopt($ch, CURLOPT_USERAGENT, $this->ua);
        if($referer || $this->url) curl_setopt($ch, CURLOPT_REFERER, $referer?$referer:$this->url);

        //curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if(strncmp($url,"https",6)) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookiefile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookiefile);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->tout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->hlist);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->tout);
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        }
        if(is_array($this->opts) && $this->opts != false) {
            foreach ($this->opts as $k => $v) {
                curl_setopt($ch, $k, $v);
            }
        }
        $data = curl_exec($ch);
        $this->error_code = curl_errno($ch);
        $this->error_error = curl_error($ch);
        $this->info = curl_getinfo($ch);
        unset($this->uploadArr);
        $this->url=$url;

        if ($this->stopWhenError && $this->error_code != 0) {
            @unlink($this->cookiefile);
            eval($this->errorStr);
            curl_close($ch);
            exit;
        }

        if ($data) {
            if ($this->h) {
                $arr = explode("\r\n\r\n", $data);
                $hrt = "";
                $drt = "";
                foreach ($arr as $v) {
                    if (preg_match('@^HTTP\/@s', $v)) {
                        $hrt .= $v . "\r\n\r\n";
                    }
                    else {
                        $drt .= $v . "\r\n\r\n";
                    }
                }

                $this->headers = $hrt;
                return $drt;
                curl_close($ch);
            }
            else {
                return $data;
                curl_close($ch);
            }
        } else {
            return false;
            curl_close($ch);
        }

    }

    function realm($url, $u2, $p2){
        //$realm array $u2,$p2
        return $this->exec('GET', $url, "", $url, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1) Gecko/20061010 Firefox/2.0", array($u2,$p2));
    }

    function proxy($proxy, $prtype=CURLPROXY_SOCKS5){//CURLPROXY_SOCKS5
        $this->proxy = $proxy;
        $this->prtype = $prtype;
    }
    function settimeout($timeout)
    {
        $this->tout = $timeout;
    }
    function get($url, $referer="") {
        return $this->exec('GET', $url, "", $referer);
    }
    function post($url, $vars, $referer="") {
        return $this->exec('POST', $url, $vars, $referer);
    }
    function upload($url, $file_arr = false, $text_arr = false, $referer="") {
        if(is_array($file_arr) && $file_arr != false) {
            foreach ($file_arr as $fileName => $fileValue) {
                $this->uploadArr[$fileName] = "@".$fileValue;
            }
        }
        if(is_array($text_arr) && $text_arr != false) {
            foreach ($text_arr as $fieldName => $fieldValue) {
                $this->uploadArr[$fieldName] = $fieldValue;
            }
        }
        return $this->exec('POST', $url, $this->uploadArr, $referer);
    }
    function setopt($opt, $value=true) {
        $this->opts[$opt] = $value;
    }
    function setUrl($url){
        $this->url=$url;
    }

    function clearCookies() {
        try {

            $fh = fopen( $this->cookiefile, 'w' );
            fclose($fh);
        }
        catch (Exception $e) {
            @unlink($this->cookiefile);
        }
    }

    function setHeader($v) {
        $this->hlist[] = trim($v);
    }

    function get_string_between($string, $start, $end)
    {
        $string = " " . $string;
        $ini = strpos($string, $start);
        if ($ini == 0)
            return "";
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    function get_string_between_all($string, $start, $end) {
        $start = preg_quote($start);
        $end = preg_quote($end);
        $pattern = "~$start\s*(.*?)$end\s*~";
        $match = preg_match_all($pattern, $string, $matches);
        if ($match) {
            return $matches[1];
        }
    }
}

//$x = new CURL;
//$x->proxy("76.225.186.63:56363");//user:pass@1.1.1.1:22
//$x->proxy("89.39.236.92:5623",CURLPROXY_SOCKS5);
//echo $x->get("http://myip.dk/");
?>