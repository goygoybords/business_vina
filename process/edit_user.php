<?php
	require '../class/database.php';
	require '../class/user.php';
	require '../model/user_model.php';
	$user = new User();
	$user_model = new User_Model(new Database());

	extract($_POST);
	if(isset($_POST['update']))
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
		header("location: ../user/edit.php?id=".$user->getId()."&msg=inserted");
	}
?>