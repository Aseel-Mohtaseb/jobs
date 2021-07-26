<?php
$servername = "localhost";
$username = "user_jobs";
$password = "userjobspw";
$database = "jobs";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Can't connect to database " . mysqli_connect_error());
}
echo "Connected to database server successfully </br>";

?>