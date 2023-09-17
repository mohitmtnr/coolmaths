<?php
session_start();
//database connection
include '../security/db-con.php';
if (isset($_POST['submit'])) {
    $email = strtolower($_POST['email']);
    $password =  strtolower($_POST['password']);
    if (empty($email) || empty($password)) {
        $_SESSION['login_msg'] = "fields are empty !";
        header('location:index.php');
    } else {
        $emailSearch = "select * from members where email='$email' and status='active'";
        $query = mysqli_query($con, $emailSearch);
        $emailCount = mysqli_num_rows($query);
        if ($emailCount) {
            $emailRow = mysqli_fetch_assoc($query);
            $pass = $emailRow['password'];
            $verifyPassword = password_verify($password, $pass);
            if ($verifyPassword) {
                $_SESSION['username'] = $emailRow['username'];
                $_SESSION['id'] = $emailRow['id'];
                $_SESSION['login_msg'] = "Login Successful";
                header('location:../user/user-dashboard.php');
            } else {
                $_SESSION['login_msg'] = 'Incorrect Password !';
                header('location:../index.php');
            }
        } else {
            $_SESSION['login_msg'] = 'Incorrect Email !';
            header('location:../index.php');
        }
    }
}
$con->close();
