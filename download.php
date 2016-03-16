<!doctype html>
<html>
<head>
	<title>Download page</title>
	<style type="text/css">
	div
	{
		position: absolute;
		top: 300px;
		left: 40%;
	}
	label
	{
		margin: 30px;
	}
	input
	{
		margin: 5px;
	}
	</style>
</head>
<body>
	<div>
	<form action="download_pop.php" method="POST">
		<label>Paste Link here </label><input type="text" name="link" id="link" value=""><br>
		<label>password </label><input type="password" name="password"  value=""><br>
		<input type="submit" value="download" id="download">
	</form>
	</div>
</body>
</html>