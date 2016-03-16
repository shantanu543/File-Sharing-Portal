<?php
session_start();
echo("you are ".$_SESSION["username"]);
$target = "/var/www/html/Test/uploads/".$_SESSION["username"];
echo "<br>";
if(is_dir($target))
	echo("you have got a dir");
else
	echo "got no dir";
?>