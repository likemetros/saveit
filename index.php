<!DOCTYPE html>
<html>
	<head>
		<title>SaveIt</title>
	</head>
	<body>
		<form method="post">
			<p>Username:<input type="text" name="username"/></p>
			<p>Password:<input type="text" name="password"/></p>
			<p><input type="submit" name="submit" value="Log in"/></p>
		</form>
		
		<form action="register.php" method="post">
			<p><input type="submit" name="register" value="Sign in"/></p>
		</form>
	</body>
</html>

<?php
	if (isset($_POST["username"]) || isset($_POST["password"])){
	if (empty($_POST["username"]) || empty($_POST["password"])){
		echo"Please fill both fields";
	} else {
		if (file_exists ("accs/".$_POST["username"].".txt")){
			if($hash=hash('sha256',$_POST["password"]===$pass[0]=file("accs/".$_POST["username"].".txt"))){
				echo"You are logged in :)";
			}
			else{
				echo"Try your password again";
			}
		} 
		else {
			echo"Account not found. Please register";
		}
	}
}
?>