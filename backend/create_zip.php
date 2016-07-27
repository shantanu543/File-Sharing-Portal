<?php
	session_start();
	if(isset($_SESSION["username"]))
	{
       $path = '/var/www/html/Test/uploads/'.$_SESSION["username"]."/";
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
	$file = $path.$_SESSION["username"].".zip";
	$z->open($file,ZipArchive::CREATE);
	folderToZip($path,$z);
	$z->close();
?>