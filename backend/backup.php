<?php
	session_start();
	if(isset($_SESSION["username"]))
	{
       $path = 'C:/xampp/htdocs/Test/Project/uploads/'.$_SESSION["username"]."/";
	}
	else
	{
		header("location:index.php");
	}

	function folderToZip($folder, &$zipFile, $subfolder = null) {
    if ($zipFile == null) {
        // no resource given, exit
        return false;
    }
    // we check if $folder has a slash at its end, if not, we append one
    $folder .= end(str_split($folder)) == "/" ? "" : "/";
    $subfolder .= end(str_split($subfolder)) == "/" ? "" : "/";
    // we start by going through all files in $folder
    $handle = opendir($folder);
    while ($f = readdir($handle)) {
        if ($f != "." && $f != "..") {
            if (is_file($folder . $f)) {
                // if we find a file, store it
                // if we have a subfolder, store it there
                if ($subfolder != null)
                    $zipFile->addFile($folder . $f, $subfolder . $f);
                else
                    $zipFile->addFile($folder . $f);
            } elseif (is_dir($folder . $f)) {
                // if we find a folder, create a folder in the zip
                $zipFile->addEmptyDir($f);
                // and call the function again
                folderToZip($folder . $f, $zipFile, $f);
         	   }
        	}
    	}
	}

	$z = new ZipArchive();
	$file = $path.$_SESSION["username"]."backup".time().".zip";
	$z->open($file,ZipArchive::CREATE);
	folderToZip($path,$z);
	$z->close();

    $host = "localhost";
    $username = "root";
    $db_name = "user";
    $db_table = "login";

    mysql_connect("$host","$username") or die("Could not connect to MySql");
    mysql_select_db("$db_name") or die("can not connect to database");

    $shared = "";
    $id = rand(10000,99999);
    $shorted = base_convert($id, 20, 36);
    $password = "";
    $path = $file;

    $sql = "INSERT INTO files (`path`,`shorted`,`password`,`shared`) VALUES ('$path','$shorted','$password','$shared')";
    $query = mysql_query($sql);
    

    $filename = $file;
    $_SESSION["message"] = "Your whole data has been backupped";
    $_SESSION["backupLink"] = $file; 
    if(isset($_SESSION["message"]))
    {
        header("location:index.php");
    } 
?>