<?php
	require_once('Table.php');

	class Playlist extends Table{
		public $playlist_id;
		public $creator;
		public $title;
		public $created;

		public function __construct($val = []){
			parent::__construct('Playlist', $val);
		}
	}