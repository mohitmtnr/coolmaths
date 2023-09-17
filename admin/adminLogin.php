<?php
session_start();
//database connection
include '../security/db-con.php';
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email) || empty($password) || empty($id)) {
        $_SESSION['admin_login_msg'] = "fields are empty !";
        header('location:../index.php');
    } else {
        $emailSearch = "select * from admins where email='$email' and id='$id' and status='active'";
        $query = mysqli_query($con, $emailSearch);
        $emailCount = mysqli_num_rows($query);
        if ($emailCount) {
            $emailRow = mysqli_fetch_assoc($query);
            $pass = $emailRow['password'];
            $verifyPassword = password_verify($password, $pass);
            if ($verifyPassword) {
                $_SESSION['username'] = $emailRow['username'];
                $_SESSION['id'] = $emailRow['id'];
                $_SESSION['admin_login_msg'] = "Login Successful";
                header('location:admin.php');
            } else {
                $_SESSION['admin_login_msg'] = 'Incorrect Password !';
                header('location:../index.php');
            }
        } else {
            $_SESSION['admin_login_msg'] = 'Incorrect Email or ID !';
            header('location:../index.php');
        }
    }
}
$con->close();
