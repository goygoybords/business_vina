<?php 
	require '../class/user.php';
	require '../model/user_model.php';
	$user = new User();
	$user_model = new User_Model();
	$user->setId(htmlentities($_GET['id']));
	$user->setStatus(0);	
		
	$table  = "users";
	$fields = array('status');
	$where  = "WHERE id = ?"; 
	$params = array($user->getStatus(), $user->getId() );
	$result = $user_model->updateUser($table, $fields, $where, $params);
	header("location: ../user/user.php");
?>