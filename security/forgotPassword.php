<?php
if ($_GET['name'] == 'sendOTP') {
    echo checkEmail();
}

$OTP = '';
function checkEmail()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $email = $mydata['mail'];
    $email_check_query = "select * from members where email='$email' and status='active'";
    $query = mysqli_query($con, $email_check_query);
    $count_email = mysqli_num_rows($query);
    if ($count_email == 1) {
        $OTP = (int)(random_bytes(6));
        $toEmail = "To:$email";
        $subject = "Email Activation";
        $body = "Hi $username,Please enter this\n OTP = $OTP to proceed.";
        $header = "From:coolmathsofflicial@gmail.com";
        if (mail($toEmail, $subject, $body, $header)) {
            echo checkOTP();
        } else {
            echo "Email failed";
        }
    } else {

        echo "Please enter registered email !";
    }
}




function checkOTP()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $otp = $mydata['otp'];
    // select operation
    if (!empty($otp)) {
        if ($otp == $OTP) {
            echo resetPassword();
        } else {
            echo "incorrect OTP!!!";
        }
    } else {
        echo "Please enter the OTP!!!";
    }

    $con->close();
}

function resetPassword()
{
}
