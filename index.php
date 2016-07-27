<?php
	session_start();
	if(isset($_SESSION["username"]))
	{
		echo "Hi ".$_SESSION["username"];
		echo "<a href='backend/logout.php'>Log out</a>";
		echo "<a href='backend/create_zip.php'>Zip</a>";
	}
	else
	{

	}
?>
<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8" />
	<title>Multiple File Upload with progress bar</title>

	<!-- styles -->
	<link rel="stylesheet" type="text/css" href="css/pure-min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<style>
	#imagePreview {
    width: 180px;
    height: 180px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
</style>

</head>
<body>
<div class="container">	

	<a href="backend/register.php">Sign Up</a>
	<a href="backend/login.php">Login</a>
	<!-- status message will be appear here -->
	<div class="status"></div>
	
	<!-- multiple file upload form -->
	<form action="backend/upload.php" method="POST" enctype="multipart/form-data" class="pure-form">
		<input type="file" name="files[]" multiple="multiple" id="files"><br>
		Add password for file<input type="password" name="password">*Optional<br>
		Do you want to compress file?<input type="checkbox" name="check"><br>
		<input type="submit" value="Upload" class="pure-button pure-button-primary">
	</form>
	
	<!-- progress bar -->
	<div class="progress">
		<div class="bar"></div >
		<div class="percent">0%</div >
	</div>

	<div id="imagePreview">
		<img src="image_thumbnail.png">
	</div>

</div><!-- end .container -->

	<!-- javascript dependencies -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.form.min.js"></script>
	
	<!-- main script -->
	<script type="text/javascript" src="js/script.js"></script>

</body>
<script type="text/javascript">
$(document).ready(function(){
	$(function() {
	$("#imagePreview").hide();
    $("#files").on("change", function()
    {
    	var file = $(this).val();
    	var ext = file.split('.').pop();
    	if((ext == "jpeg") || (ext == "png") || (ext == "jpg") || (ext == "gif"))
    		$("#imagePreview").show();
    });
});	
});
</script>
</html>
