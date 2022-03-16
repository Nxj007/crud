<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "crud1";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
/*$sql = "CREATE DATABASE crud1";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}
*/
$conn->close();
?>
