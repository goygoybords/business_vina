<?php
	require '../class/database.php';
	require '../class/user.php';
	require '../model/user_model.php';
	$user = new User();
	$user_model = new User_Model(new Database());
	
	$table = "users";
	extract($_POST);
	if(isset($_POST['register_user']))
	{

		// user setters and getters
		$user->setFirstname(htmlentities($firstname));
		$user->setLastname(htmlentities($lastname));
		$user->setEmail(htmlentities($email));
		$user->setPassword(htmlentities(md5($password)));
		$user->setUsertypeid($user_type);
		$user->setDatecreated(strtotime(date('Y-m-d')));
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

		$fields = array('email');
		$where = "email = ?";
		$params = array($user->getEmail());

		$check = $user_model->checkUser($table, $fields, $where , $params  );
		if(count($check) == 1)
		{
			header("location: ../user/manage.php?msg=user_exist");
		}
		else
		{
			$result = $user_model->createUser($table, $data);
			header("location: ../user/manage.php?msg=inserted");
		}
	}

	if(isset($_POST['update_user']))
	{
		// user setters and getters
		$user->setId(htmlentities($id));
		$user->setFirstname(htmlentities($firstname));
		$user->setLastname(htmlentities($lastname));
		$user->setEmail(htmlentities($email));
		$user->setPassword(htmlentities(md5($password)));
		$user->setUsertypeid($user_type);

		$table  = "users";
		$fields = array('firstname' ,'lastname' ,'email' , 'password' , 'usertypeid');
		$where  = "WHERE id = ?";
		$params = array($user->getFirstname(), $user->getLastname(), $user->getEmail(),
				$user->getPassword(), $user->getUsertypeid(),   $user->getId() );
		$result = $user_model->updateUser($table, $fields, $where, $params);

		header("location: ../user/manage.php?id=".$user->getId()."&msg=inserted");
	}
	if(isset($_GET['del']))
	{
		$user->setId($_GET['id']);
		$user->setStatus(0);
		$table  = "users";
		$fields = array('status');
		$where  = "WHERE id = ?"; 
		$params = array($user->getStatus(), $user->getId() );
		$result = $user_model->updateUser($table, $fields, $where, $params);
		header("location: ../user/user.php?&msg=deleted");

	}
	
?>