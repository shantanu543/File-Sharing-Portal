<?php
	session_start();

	$host = "localhost";
	$username = "root";
	$password = "MySql";
	$db_name = "user";
	$db_table = "login";

	mysql_connect("$host","$username","$password") or die("Could not connect to MySql");
	mysql_select_db("$db_name") or die("can not connect to database");

	$myusername = $_POST["username"];
	$mypassword = $_POST["password"];

	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
	
	$sql = "SELECT * FROM $db_table WHERE userName = '$myusername' AND passWord = '$mypassword'";
	$result = mysql_query($sql);

	$count = mysql_num_rows($result);

	if($count == 1)
	{
		$_SESSION["username"]=$myusername;
		header("location:index.php");
	}
	else
		echo "Wrong Password or username";
?>

<!-- set session at this page and retrieve at login_success.php for knowing whose directory is to be opened. -->