<?php 
	session_start();
	echo $_SESSION['firstname'];

	if($_SESSION['isLogin'] != true)
		header("location: ../index.php");

?>

<a href = "user_registration.php">User Registration</a>
<a href = "leads.php">User Registration</a>
<a href = "../logout.php">Logout</a>