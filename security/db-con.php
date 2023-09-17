<?php
//database connection
$server = "localhost";
$username = "root";
$password = "";
$db = "coolmaths";
$con = mysqli_connect($server, $username, $password, $db);

if (!$con) {
    $_SESSION['con_msg'] = "Unable to connect to the database now!";
    header('location:../index.php');
}
