<?php 
	require '../class/database.php';
	require '../class/lead.php';
	require '../model/lead_model.php';
	$leads = new Leads();
	$lead_model = new Lead_Model(new Database());
	
	extract($_POST);
	if(isset($_POST['create_lead']))
	{
		print_r($_POST);
	
		// // user setters and getters
		// $user->setFirstname(htmlentities($firstname));
		// $user->setLastname(htmlentities($lastname));
		// $user->setEmail(htmlentities($email));
		// $user->setPassword(htmlentities(md5($password)));
		// $user->setUsertypeid($user_type);
		// $user->setDatecreated(strtotime(date('Y-m-d')));
		// $user->setStatus(1);

		// $data = [
		// 			'firstname' => $user->getFirstname()  , 
		// 			'lastname'  => $user->getLastname()   ,
		// 			'email'     => $user->getEmail()      ,
		// 			'password'  => $user->getPassword()   ,
		// 			'usertypeid' => $user->getUsertypeid() ,
		// 			'datecreated' => $user->getDatecreated() ,
		// 			'status' => $user->getStatus() ,
		// 		];

	
	
		// $result = $user_model->createUser('users', $data);
		// header("location: ../user/add.php?msg=inserted");
		

	}
?>