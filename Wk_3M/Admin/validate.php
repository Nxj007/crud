<?php

include_once('config.php');

function test_input($data) {
	
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if ($_SERVER["REQUEST_METHOD"]== "POST") {
	
	$adminname = test_input($_POST["adminname"]);
	echo "<h1>".$adminname."</h1>";
	// $adminname1 = ("admin2");
	$password = test_input($_POST["password"]);
	$utype = test_input($_POST["utype"]);
	echo "<h1>".$utype."</h1>";
	// $stmt = $link->prepare("SELECT * FROM `adminlogin` where utype = $utype ");
	$sql = "SELECT * FROM `adminlogin` where utype = $utype  ";
	$result = mysqli_query($link, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
	// print_r($users);
	// echo "<script>alert('$users');</script>";

	mysqli_free_result($result);
	// $stmt->execute();
	
	// $users = $stmt->fetchAll();
	
	foreach($users as $user) {
		print_r($user);
		print_r($user['utype']);
		
		if(($user['adminname'] == $adminname) ||
			($user['utype'] == $utype)) {
			// header("Location: \cr\index.php");
			header("Location: adminpage.php");
		}
		else {
			echo "<script language='javascript'>";
			echo "alert('WRONG INFORMATION')";
			// echo "alert("<h1>". $user['adminname'] . "</h1>")";
			echo "</script>";
			header("Location: ii.php");
			die();
		}
	}
}

?>
