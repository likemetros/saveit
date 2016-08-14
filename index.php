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
		$name=$_POST["username"];
		$name=$_SESSION["username"];
?>
<table width="100%">
	<tr>
		<td width="40%">
		<form method="post">
			<input type="hidden" name="logoutbag" value="1"/>
			<p align="right" valign="top"><input type="submit" name="logout" value="Log out"/></p>
		</form>
		<!--WRITING-->
		<form method="post">
			<p align="left" valign="top"><textarea name="text" rows="15" cols="80"></textarea></p>
			<p ><input type="submit" name="write" value="Submit text"/></p>
		</form>
		<form method="post">
			<input type="hidden" name="refresh" value="1"/>
			<p ><input type="submit" name="rfr" value="Refresh"/></p>
		</form>
		</td>
		<td width="60%">
			<p align="left" valign="top"><h2>Preview</h2></p>
			<?php
				$read=file("accs/".$name.".txt");
				$count=count($read);
				$i=1;
				$isFirst=true;
				foreach($read as $line) {
					if ($isFirst==true){
						$isFirst=false;
						continue;
					}
					else{
						echo $line;
						if ($i<$count){
							echo"\r\n";
						}
						$i++;
						echo"\r\n";
					}
				}
			?>
		</td>
	</tr>
</table>
<?php
		if ($_POST["logoutbag"]=="1"){
			session_destroy();
		}
		if ($_POST["rfr"]=="1"){
			header("Refresh:0");
		}
		$wf=fopen("accs/".$name.".txt","a");
		fwrite($wf,"\r\n".$_POST["text"]);
		fclose($wf);
	} else {
?>
		<div>
			<form method="post">
				<p>Username:<input type="text" name="username"/></p>
				<p>Password:<input type="text" name="password"/></p>
				<p><input type="submit" name="submit" value="Log in"/></p>
			</form>
			<form action="register.php" method="post">
				<p><input type="submit" name="register" value="Sign in"/></p>
			</form>
		</div>
<?php
		if (isset($_POST["username"]) || isset($_POST["password"]) ){
			if (empty($_POST["username"]) || empty($_POST["password"])){
				echo"Please fill both fields";
			} else{
				if (file_exists ("accs/".$_POST["username"].".txt")){
					$pass=file("accs/".$_POST["username"].".txt");
					$hash=hash('sha256',$_POST["password"]);
					if($hash== $pass[0]){
						echo"You are logged in";
						$_SESSION["username"]=$_POST["username"];
					} else {
						echo"Try your password again";
					}
				} else {
					echo"Account not found. Please register";
				}
			}
		}
	}
?>
	</body>
</html>