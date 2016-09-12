<?php 
	session_start();
	require '../class/user.php';
	require '../class/database.php';
	require '../model/user_model.php';
	
	$user = new User();
	$db = new Database();
	extract($_POST);
	
	$user_model = new User_Model($db->connectDb());

	$user->setEmail(htmlentities($email));
	$user->setPassword(htmlentities($password));

	$login = $user_model->login($user->getEmail(), $user->getPassword());
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
		header("location: ../index.php?err=1");
	}
		
	



?>