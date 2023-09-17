<?php
session_start();
include 'db-con.php';
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    if (isset($_SESSION['signup_success'])) {
        $updateQuery = "update members set status='active' where token='$token' and status='inactive'";
        $query = mysqli_query($con, $updateQuery);
        if ($query) {
            $_SESSION['signup_success'] = 'Account is activated successfully';
            header('location:../index.php');
        } else {
            $_SESSION['signup_error'] = 'Token or status not matched!';
            header('location:../index.php');
        }
    } else {
        $_SESSION['signup_error'] = 'Signup Again!';
        header('location:../index.php');
    }
} else {
    $_SESSION['signup_error'] = 'Token is not set!';
    header('location:../index.php');
}
$con->close();
header('location:../index.php');
