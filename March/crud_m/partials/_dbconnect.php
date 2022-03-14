<?php

$server = "localhost";
$username = "root";
$password = "root";
$database = "crud";

$link = mysqli_connect($server, $username, $password, $database);
if (!$link){

    die("Error". mysqli_connect_error());
}

?>
