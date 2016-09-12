<?php 
	class User_Model 
	{
        //require '../class/database.php';
		
		private $connection = "";
        private $db = "";
	 	public function __construct($connection)
    	{
    		$this->connection = $connection;
    	}


    
    	public function createUser($user)
    	{
    		try
    		{

    			$sql = "INSERT INTO users VALUES (DEFAULT, ?,?,?,?,?,?,?,?)";
    			$cmd = $this->connection->prepare($sql);
    			$res = $cmd->execute(array($user->getFirstname(), $user->getLastname(), $user->getEmail(), 
				$user->getPassword(),  $user->getUsertypeid() , $user->getDatecreated(), $user->getDatelastlogin(),$user->getStatus() ));
    			return $res;
    		}
    		catch(Exception $e)
    		{
    			echo $e->getMessage();
    		}
    	}
 		public function login($email, $password)
 		{
 			$sql = "SELECT firstname, lastname, usertypeid 
 					FROM users 
 					WHERE email = ? AND password = ?";
			$cmd = $this->connection->prepare($sql);
			$cmd->execute(array($email , md5($password)));
			$result = $cmd->fetchAll();
			return $result;
 		}
 		public function checkUser($email)
 		{
 			$sql = "SELECT email FROM users WHERE email = ? ";
			$cmd = $this->connection->prepare($sql);
			$cmd->execute(array($email));
			$result = $cmd->fetchAll();
			return count($result);
 		}
	}
?>