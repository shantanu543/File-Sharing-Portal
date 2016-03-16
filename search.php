<?php
	if($_SERVER["REQUEST_METHOD"] === "POST")
	{
		$search = $_POST["search"];

	$host = "localhost";
	$username = "root";
	$db_name = "user";
	$db_table = "files";

	mysql_connect("$host","$username") or die("Could not connect to MySql");
	mysql_select_db("$db_name") or die("can not connect to database");

	$query = 'SELECT * FROM files WHERE path LIKE "%$search%"';
	$result = mysql_query($query);
	$array = mysql_fetch_array($result);
	print_r($array);
	}
?>
<html>
	<head>
		<title>Search page</title>
	</head>
	<div></div>
	<form action="search.php" method="post">
		<input type="text" name="search">
		<input type="submit" value="search">
	<form>
		<div></div>
</html>
