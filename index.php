<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SaveIt</title>
	</head>
	<body>
		<?php
			if (isset($_SESSION["username"])){
		?>
				<form method="post">
					<input type="hidden" name="logoutbag" value="1"/>
					<p align="right" valign="top"><input type="submit" name="logout" value="Log out"/></p>
				</form>
		<?php
				if ($_POST["logoutbag"]="1"){
					session_destroy();
				}
			}
			else{
				?>
					<span>
						<form method="post">
							<p>Username:<input type="text" name="username"/></p>
							<p>Password:<input type="text" name="password"/></p>
							<p><input type="submit" name="submit" value="Log in"/></p>
						</form>
						<form action="register.php" method="post">
							<p><input type="submit" name="register" value="Sign in"/></p>
						</form>
					</span>
				<?php
			}
				if (isset($_POST["username"]) || isset($_POST["password"]) ){
		if (empty($_POST["username"]) || empty($_POST["password"])){
			echo"Please fill both fields";
		} 
		else{
			if (file_exists ("accs/".$_POST["username"].".txt")){
				$pass=file("accs/".$_POST["username"].".txt");
				$hash=hash('sha256',$_POST["password"]);
				if($hash== $pass[0]){
					echo"You are logged in";
					$_SESSION["username"]=$_POST["username"];
				}
				else{
					echo"Try your password again";
				}
			} 
			else{
				echo"Account not found. Please register";
			}
		}
	}
		?>
	</body>
</html>