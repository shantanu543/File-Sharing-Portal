<?php
session_start();
$link = $_POST["link"]; // of course find the exact filename....   
$host = "localhost";
$username = "root";
$db_name = "user";
$db_table = "files";
$password = $_POST["password"];

mysql_connect("$host","$username") or die("Could not connect to MySql");
mysql_select_db("$db_name") or die("can not connect to database");

if(strlen($link) >= 10)
{
	$path = $link;
	$query = "SELECT * FROM files WHERE path = '$path' AND password = '$password'";
	$result = mysql_query($query);
	$count = mysql_num_rows($result);
	$array = mysql_fetch_array($result);
	$filename = $array["path"];
}
else
{
	$shortlink = $link;
	$query = "SELECT * FROM files WHERE shorted = '$shortlink' AND password = '$password'";
	$result = mysql_query($query);
	$count = mysql_num_rows($result);
	$array = mysql_fetch_array($result);
	$filename = $array["path"];
}
if(isset($_SESSION["username"]))
	
	$current_user = $_SESSION["username"];
	$nameList = $array["shared"];
	$names = explode(",",$nameList);
	if(in_array($current_user, $names))
	{
		$count = 1;
	}
	else
	{
		echo "You are not authorised";
	}

if($count > 0)
{

header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false); // required for certain browsers 
header('Content-Type: application/pdf');

header('Content-Disposition: attachment; filename="'. basename($filename) . '";');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($filename));

readfile($filename);	

}

?>