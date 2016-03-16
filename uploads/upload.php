<?php
$length = count($_FILES['uploaded']['name']);
if($length){
	for ($i=0; $i < $length; $i++) { 
		$target = "/var/www/html/FileUpload/upload/".basename($_FILES['uploaded']['name'][$i]);
		if(move_uploaded_file($_FILES['uploaded']['tmp_name'][$i], $target))
		{
			echo "The file ".basename($_FILES['uploaded']['name'])." has been uploaded";
			$dest = "/FileUpload/upload/".basename($_FILES['uploaded']['name'][$i]);
			echo "<br>";
			echo "you can access the file at ";
			echo "<a href='$dest'>Your File.<a>";
			echo "<br>";
		}
else
		{
			echo $_FILES['uploaded']['error'][$i];
			switch ($_FILES['uploaded']['error'][$i]) {
			case 1:
				print '<p>The file is bigger than the PHP installation allows</p>';
				break;
			case 2:
				print '<p>The file is bigger than this form allows</p>';
				break;
			case 3:
				print '<p>Only part of the file was uploaded.</p>';
				break;
			case 4:
				print '<p>No file was uploaded</p>';
				break;
			default:
				print '<p>Unknown error<p>';
				break;
	}
}

	}
}
else
	echo "Chutiyapa ho gya be";
if(!empty($_FILES['name'])){
	$tempFile = $_FILES['file']['tmp_name'];
	echo $tempFile;
}
?>

<!-- Problems 
:File name having ' as character are not properly read by basename function.
Bug recreate try uploading What they Don't teach in Manuals!!! (the name here is not exact as 
there was comment issue.) that is in /downloads/hacking stuff-->
