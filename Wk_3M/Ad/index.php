<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href=
"https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="login.css">
	<title>Login Page</title>
</head>

<body>
	<form action="validate.php" method="post">
		<div class="login-box">
			<h1>Login</h1>

			<div class="textbox">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input type="text" placeholder="Adminname" name="adminname" value="">
			</div>

			<div class="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" placeholder="Password" name="password" value="">
			</div>
			<?php
			include "config.php";
			$sql = "SELECT * FROM `adminlogin` ";
	$result = mysqli_query($link, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
	print_r($users);
	echo "<h1>".$adminname."</h1>";

	// print_r( "<script>alert('$users');</script>");
	

	?>
			<input class="button" type="submit"
					name="login" value="Sign In">
		</div>
	</form>
</body>

</html>
