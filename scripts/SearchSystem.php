<?php

	class SearchSystem {
	
		private $request      = "";
		private $searchsystem = ""; 
		private $results;
		
		public function __construct () {
			
			if (isset($_POST['textfield']) && isset($_POST['search_system'])) {
			
				if(!empty($_POST['textfield']) && !empty($_POST['search_system'])){
				    $this->request = htmlspecialchars($_POST['textfield']);
				    //$this->request = str_replace(' ', '+', $this->request);
				
			     	$this->searchsystem = htmlspecialchars($_POST['search_system']);
				    echo '<div class ="request-class"> Результаты по запросу: '.$this->request.'</div>';
				    $this->requestTo();
				}
		    }
			
		}	 
		
		public function requestTo(){
			
			if ($this->searchsystem == 'google'){
				$url = 'https://www.google.ru/search?complete=1&hl=ru&q='.urlencode($this->request);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_AUTOREFERER, true);
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

            $data = curl_exec($ch);
			
           
			preg_match_all("/<cite.+?>(.+?)<\/cite>/is", $data, $matches); 
			$result = $matches[0];
			for ($i = 0; $i < 5; $i++) {
				
				iconv("windows-1251","utf-8", $result[$i]);
			}
			
			for ($index = 0; $index < 5; $index++) {
                echo '<div class ="result-class">';
		        echo $result[$index];
		        echo '</div>';
	        }
             curl_close($ch);
			
			}
			
		}
		
	}