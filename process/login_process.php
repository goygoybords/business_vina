<?php 
	session_start();
	require '../class/database.php';
	require '../class/user.php';
	require '../model/user_model.php';
	
	$user = new User();
	$user_model = new User_Model(new Database());

	extract($_POST);
	
	if(isset($_POST['login']))
	{
		$user->setEmail(htmlentities($email));
		$user->setPassword(htmlentities($password));

		$user->setDatelastlogin(strtotime(date('Y-m-d')));

		$table = "users";
		$fields = array('id','first_name' , 'lastname', 'usertypeid');
		$where = "email = ? AND password = ? AND status = 1";
		$params = array($user->getEmail(), md5($user->getPassword()) );

		$login = $user_model->login($table, $fields, $where, $params);
		if(count($login) > 0)
		{
			foreach ($login as $l ) 
			{
				$_SESSION['id'] = $l['id'];
 				$_SESSION['firstname'] = $l['first_name'];
				$_SESSION['lastname'] = $l['lastname'];
				$_SESSION['user_type'] = $l['usertypeid'];
				$_SESSION['isLogin'] = true;
				$user_model->updateUser("users", array('datelastlogin'), "WHERE id = ?" , array($user->getDatelastlogin() , $l['id']));
				header("location: ../calendar/upcoming_events.php");
			}
		}
		else
		{
			header("location: ../index.php?error=invalid");
		}
	}
?>