<?php
#echo "Hello there <br>";

// DB Connection
$servername = "localhost";
$username = "root";
$password = "root";
$database = "crud";

// Creation
$link = MySQLi_connect($servername, $username, $password, $database);


#Die Function

if(!$link){
    die("Wrong pass <br>". MySQLi_connect_error());
}