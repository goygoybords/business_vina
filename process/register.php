<?php 
	session_start();
	require '../class/user.php';
	require '../model/user_model.php';
	$user = new User();
	$user_model = new User_Model();
	
	extract($_POST);
	if(isset($_POST['register']))
	{
	
		// user setters and getters
		$user->setFirstname(htmlentities($firstname));
		$user->setLastname(htmlentities($lastname));
		$user->setEmail(htmlentities($email));
		$user->setPassword(htmlentities(md5($password)));
		
		$user->setUsertypeid($user_type);
		$user->setDatecreated(strtotime(date('Y-m-d')));
		//$user->setDatelastlogin(0);
		$user->setStatus(1);

		$data = [
					'firstname' => $user->getFirstname()  , 
					'lastname'  => $user->getLastname()   ,
					'email'     => $user->getEmail()      ,
					'password'  => $user->getPassword()   ,
					'usertypeid' => $user->getUsertypeid() ,
					'datecreated' => $user->getDatecreated() ,
					'status' => $user->getStatus() ,
				];
	
	
		// connection to the user model
		print_r($data);

		// $check = $user_model->checkUser($email);
		// if($check == 1)
		// {
		// 	header("location: ../user/add.php?msg=user_exist");
		// }
		// else
		// 	
			$result = $user_model->createUser('users', $data);
	
			header("location: ../user/add.php?msg=inserted");
		// }

	}
?>