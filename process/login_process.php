<?php 
	session_start();
	require '../class/user.php';
	require '../model/user_model.php';
	
	$user = new User();
	$user_model = new User_Model();

	extract($_POST);
	
	if(isset($_POST['login']))
	{
		$user->setEmail(htmlentities($email));
		$user->setPassword(htmlentities($password));

		$table = "users";
		$fields = array('firstname' , 'lastname', 'usertypeid');
		$where = "email = ? AND password = ?";
		$params = array($user->getEmail(), md5($user->getPassword()) );
		$login = $user_model->login($table, $fields, $where, $params);
		if(count($login) > 0)
		{
			foreach ($login as $l ) 
			{
				$_SESSION['firstname'] = $l['firstname'];
				$_SESSION['lastname'] = $l['lastname'];
				$_SESSION['user_type'] = $l['usertypeid'];
				$_SESSION['isLogin'] = true;
				header("location: ../dashboard/main.php");
			}
		}
		else
		{
			header("location: ../index.php?error=invalid");
		}
	}
?>