<html>
	<head>
		<title>SaveIt</title>
	</head>
	<body>
		<form method="post">
			<p>Username:<input type="text" name="username"/></p>
			<p>Password:<input type="text" name="password"/></p>
			<p><input type="submit" name="reg" value="Register"/></p>
		</form>
		<form action="index.php" method="post">

			<p><input type="submit" name="login" value="Get back"/></p>
		</form>
	</body>
</html>

<?php
if (isset($_POST["username"]) || isset($_POST["password"])){
	if (empty($_POST["username"]) || empty($_POST["password"])){
		echo"Please fill both fields";
	} else {
		if (file_exists ("accs/".$_POST["username"].".txt")){
			echo"Username taken";
		} else {
			$uf=fopen("accs/".$_POST["username"].".txt","w");
			fwrite($uf, $hash=hash('sha256',$_POST["password"]));
			fclose($uf);
			echo"You are registered";
		}
	}
}
?>