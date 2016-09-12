<?php 
	class Database 
	{

		protected $host = 'localhost';
    	protected $dbname = 'businessvinadb01';
    	protected $user = 'root';
    	protected $pass = '';
    	protected $db = "";
 	
    	public function __construct()
    	{
    		$this->db = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->pass);
    	}
 	
 		public function dynamicInsert($table , $data)
 		{
 			try
 			{
 				//$db = $this->connectDb();
 				$columnString = implode(',', array_keys($data));
	 			$valueString = implode(',', array_fill(0, count($data), '?'));
	 			$sql = "INSERT INTO {$table} ({$columnString}) VALUES ({$valueString}) ";
	 			$cmd = $this->db->prepare($sql);
	 			$result = $cmd->execute(array_values($data));
	 			return $result;
 			}
 			catch(Exception $e)
 			{
 				echo $e->getMessage();
 			}
 			
 		}
 		public function view_by($table,$fields,$id,$spec_field)
   		{
        	// $stmt = $this->_dbh->prepare('SELECT ' . $fields . ' FROM ' . $table .  ' WHERE ' . $spec_field . ' = ' . $id);
        	// $stmt->execute();
        	// $record = $stmt->fetch(PDO::FETCH_ASSOC);
        	// return $record;
    	}
 		public function closeDb()
 		{
 			return $db = null;
 		}
	}
?>