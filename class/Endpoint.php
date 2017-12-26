<?php
	class Endpoint{

		private $data;

		public function __construct($data){
			$this->data = $data;
		}

		public function download(){
			if(!isset($this->data['url']))
				return ['error'=>'No url provided'];
			if(!is_file($_POST['url'].'.mp3')){
				exec('/usr/local/bin/youtube-dl --extract-audio --audio-format mp3 --output "%(id)s.%(ext)s" https://youtu.be/'.$_POST['url']);
			}
			return ['success'=>true];
		}

		public function search(){
			if(!isset($this->data['search']))
				return  ['error'=>'No search key word(s) provided'];

			$videosMem = array();
			$videos = array();
			$ch = curl_init('https://www.youtube.com/results?search_query='.$this->data['search'].'&pbj=1');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$res = curl_exec($ch);
			$res = explode('/watch?v=', $res);
			unset($res[0]);
			foreach ($res as $key => $value) {
				if(strpos($value, 'yt-uix-tile-link') !=  false){
					$videoId = explode('"', $value)[0];
					$title = explode('title="', $value)[1];
					$title = explode('"', $title)[0];
					if(!isset($videosMem[$videoId])){
						$videosMem[$videoId] = $title;
						array_push($videos, array('id'=>$videoId, 'title'=>$title));
					}
				}
			}
			return [$videos];
		}
	}