<?php
session_start();
require_once 'db-con.php';
if (isset($_POST["submit"])) {

    $username = strtolower(mysqli_real_escape_string($con, $_POST['username']));
    $email = strtolower(mysqli_real_escape_string($con, $_POST['email']));
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
    if (empty($username) || empty($email) || empty($mobile) || empty($password) || empty($confirmPassword)) {
        $_SESSION['signup_error'] = "Fields are empty !";
        header('location:../index.php');
    } else {
        $pass = password_hash($password, PASSWORD_BCRYPT);

        $token = bin2hex(random_bytes(16));

        $emailQuery = "select * from members where email ='$email'";
        $query = mysqli_query($con, $emailQuery);
        $emailCount = mysqli_num_rows($query);

        if ($emailCount != 0) {
            $_SESSION['signup_error'] = "This email is already exist try with some other email !";
            header('location:../index.php');
        } else {
            if ($password == $confirmPassword) {
                // $toEmail = "To:$email";
                // $subject = "Email Activation";
                // $body = "Hi $username,Please click this link to activate your account at coolmaths.com\nhttp://localhost/coolmaths/security/activate.php?token=$token";
                // $header = "From:coolmathsofflicial@gmail.com";

                // if (mail($toEmail, $subject, $body, $header)) {
                $insertQuery = "insert into members (username, email, mobile,password,token,status,time)values('$username', '$email', '$mobile', '$pass','$token','inactive',current_timestamp());";
                $iquery = mysqli_query($con, $insertQuery);
                if ($iquery) {
                    $_SESSION['signup_success'] = "Check your mail to activate your account $email";
                    header("location:../index.php");
                } else {
                    $_SESSION['signup_error'] = "Unable to Register You, Sorry !";
                    header("location:../index.php");
                }
                // } else {
                //     $_SESSION['signup_error'] = "Invalid email !";
                //     header("location:../index.php");
                // }
            } else {
                $_SESSION['signup_error'] = "Password and Confirm Password didn't match !";
                header("location:../index.php");
            }
        }
    }
}
$con->close();
