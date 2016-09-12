<?php
	
	class Parent extends Database
	{
		protected $db;
		public function __construct()
		{
			$this->db = new Database();
		}
	}

?>