<!DOCTYPE html>
<html>
<head>
	<title>Register Page</title>
</head>
<body>
	<form action="register.php" method="POST">
		Enter Username:<input type="text" name="username"><br>
		Enter Password:<input type="password" name="password"><br>
		<input type="submit" value="Register">
	</form>
	<a href="login.php">login</a>
	<a href="../index.php">Home</a>
</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] === "POST")
{

	$host = "localhost";
	$username = "root";
	$password = "MySql";
	$db_name = "user";
	$db_table = "login";

	mysql_connect("$host","$username","$password") or die("Could not connect to MySql");
	mysql_select_db("$db_name") or die("can not connect to database");
	
	$myusername = $_POST["username"];
	$mypassword = $_POST["password"];

	$sql = "SELECT * FROM login WHERE userName = '$myusername'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count > 0)
	{
		echo "Username already exists";
	}
	else
	{
		$sql = "INSERT INTO login (`userName`,`passWord`) VALUES ('$myusername','$mypassword')";
		$result = mysql_query($sql);
		if($result)
		{
			echo "You are registered";
			$target = "/var/www/html/Test/uploads/".$myusername."";
			mkdir($target,0777);
		}
		else
		{
			echo "Try again.";
		}
	}
}
?>