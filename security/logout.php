<?php
session_start();
session_destroy();
session_start();
$_SESSION['logout_msg'] = "successfully logged out !";
header('location:../index.php');
