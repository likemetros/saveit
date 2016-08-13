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
	</body>
</html>

<?php
	if (file_exists ("accs/".$_POST["username"].".txt");){
			echo"Username taken";
		}
	else {
		fopen("accs/".$_POST["username"].".txt","x+");
		fclose("accs/".$_POST["username"].".txt");
		}
?>