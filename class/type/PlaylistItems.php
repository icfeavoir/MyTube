<?php
	require_once('Table.php');

	class PlaylistItems extends Table{
		public $item_id;
		public $playlist_id;
		public $creator;
		public $title;
		public $url;
		public $added;

		public function __construct($val = []){
			parent::__construct('PlaylistItems', $val);
		}
	}