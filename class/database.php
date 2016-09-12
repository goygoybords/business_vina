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
 		public function dynamicInsert($table , array $data)
 		{
 			try
 			{
 				$columnString = implode(',', array_keys($array));
	 			$valueString = implode(',', array_fill(0, count($array), '?'));
	 			$sql = "INSERT INTO {$table } ({$columnString}) VALUES ({$valueString}) ";
	 			$cmd = $this->db->prepare($sql);
	 			$result = $cmd->execute(array_values($array));
	 			return $sql;
 			}
 			catch(Exception $e)
 			{
 				echo $e->getMessage();
 			}
 			
 		}
 		public function closeDb()
 		{
 			return $db = null;
 		}
	}
?>