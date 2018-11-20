<?php

    class GoogleParse {
		
	    private $url;
        
		public function __construct($request) {
		    $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://google.ru/search?q=".urlencode($request)."&ie=UTF-8");
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36");
            curl_setopt($ch, CURLOPT_FAILONERROR, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
 

            curl_setopt($ch, CURLOPT_REFERER, "http://google.ru/search"); 
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
           // $page = get_cpage($url, "", $uagent);
            curl_setopt($ch, CURLOPT_POST, 0);
	
            $data = curl_exec($ch);
            preg_match_all("/<cite>(.+?)<\/cite>/is", $data, $matches);
            $result = $matches[1];
			for ($index = 0; $index < 5; $index++) {
                echo '<p>'.$index;
		        echo iconv("windows-1251","utf-8", $result[$index]);
		        echo '</p>';
	        }
		}
		
    }