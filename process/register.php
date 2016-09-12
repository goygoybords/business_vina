<?php 
	session_start();
	require '../class/user.php';
	require '../class/database.php';
	require '../model/user_model.php';
	
	$user = new User();
	$db = new Database();

	if(isset($_POST['register']))
	{
		extract($_POST);
	
		// user setters and getters
		$user->setFirstname(htmlentities($firstname));
		$user->setLastname(htmlentities($lastname));
		$user->setEmail(htmlentities($email));
		$user->setPassword(htmlentities(md5($password)));
		$user->setUserstatusid("1");
		$user->setUsertypeid($user_type);
		$user->setDatecreated(strtotime(date('Y-m-d')));
		$user->setDatelastlogin("0");

		// connection to the user model
		$user_model = new User_Model($db->connectDb());

		$check = $user_model->checkUser($email);
		if($check == 1)
		{
			header("location: ../dashboard/user_registration.php?msg=user_exist");
		}
		else
		{
			$result = $user_model->createUser($user );
			header("location: ../dashboard/user_registration.php?msg=inserted");
		}

	}
	
	
	






?>