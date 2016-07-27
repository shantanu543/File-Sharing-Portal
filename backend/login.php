<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
</head>
<body>
	<form action="check_login.php" method="POST">
		Username: <input type="text" name="username"></input><br>
		Password: <input type="password" name="password"></input><br>
		<input type="submit" name="submit" value="Login">
	</form>
	<a href="register.php">Register</a>
	<a href="../index.php">Home</a>
</body>
</html>