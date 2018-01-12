<?php
	class Endpoint{

		private $data;

		public function __construct($data){
			$this->data = $data;
		}

		public function download(){
			if(!isset($this->data['url']))
				return ['error'=>'No url provided'];
			$dir = 'src/music/';
			if(!is_file($dir.$this->data['url'].'.mp3')){
				exec(YOUTUBE_DL.'youtube-dl --extract-audio --audio-format mp3 --output '.$dir.'"%(id)s.%(ext)s" https://youtu.be/'.$this->data['url']);
			}
			return array(['success'=>true]);
		}

		public function search(){
			if(!isset($this->data['search']))
				return ['error'=>'No search key word(s) provided'];

			$videosMem = array();
			$videos = array();
			$ch = curl_init('https://www.youtube.com/results?search_query='.urlencode($this->data['search']).'&pbj=1');
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
			return $videos;
		}

		public function loadPlaylist(){
			if(!isset($this->data['playlist_id']))
				return ['error'=>'No playlist id'];
			$playlist_id = $this->data['playlist_id'];
			$resp = array();
			$resp['playlistTitle'] = (new Playlist($playlist_id))->title;
			$playlist = array();
			foreach ((new PlaylistItem(['playlist_id'=>$playlist_id]))->get() as $item) {
				$playlist[$item['url']] = $item['title'];
			}
			$resp['playlist'] = $playlist;
			return [$resp];
		}
	}