<?php
	require_once('Table.php');

	class PlaylistItem extends Table{
		public $item_id;
		public $playlist_id;
		public $creator;
		public $title;
		public $url;
		public $added;

		public function __construct($val = []){
			parent::__construct('PlaylistItem', $val);
		}
	}