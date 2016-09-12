<?php 
	session_start();
	if(isset($_SESSION['isLogin']) != true)
		header("location: ../index.php");
?>
<!DOCTYPE>
<html>
	<head></head>
	<body>
		<form method = "post" action = "../process/register.php">
		<table>
			<tr>
				<td>Firstname:</td>
				<td><input type = "text" name = "firstname" required></td>
			</tr>
			<tr>
				<td>Lastname:</td>
				<td><input type = "text" name = "lastname" required></td>
			</tr>	
			<tr>
				<td>Email:</td>
				<td><input type = "email" name = "email" required></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type = "password" name = "password" required ></td>
			</tr>
	
			<tr>
				<td>User Type:</td>
				<td>
					<select name = "user_type" required>
						<option value = "1">Agent</option>
						<option value = "2">Admin</option>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type = "submit" name = "register" value = "Register"></td>
			</tr>		
		</table>
		</form>
		<?php 
			if(isset($_GET['msg']))
			{
				$msg = $_GET['msg'];
				if($msg == 'user_exist')
					echo "User Already Exists!";
				else if($msg == 'inserted')
					echo "User Record Stored";
			}
		?>
	</body>	
</html>