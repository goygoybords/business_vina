<?php 
	class Database 
	{

		protected $host = 'localhost';
    	protected $dbname = 'businessvinadb01';
    	protected $user = 'root';
    	protected $pass = '';
    	protected $db = "";
 	

 		public function connectDb()
 		{
 			try
 			{
 				$db = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->pass);
 				return $db;

 			}
 			catch(PDOException $e)
 			{
 				return $e->getMessage();

 			}
 		}
 		public function closeDb()
 		{
 			return $db = null;
 		}
	}
?>