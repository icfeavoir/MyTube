<?php
	require_once('Table.php');

	class User extends Table{
		public $user_id;
		public $pseudo;
		public $created;
		public $firebase_id;

		public function __construct($val = []){
			parent::__construct('User', $val);
		}
	}