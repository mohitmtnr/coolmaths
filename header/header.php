<?php
session_start();

// fuction for showing signup message
function showSignupError()
{
    if (!isset($_SESSION['signup_error'])) {

        return $_SESSION['signup_error'] = '';
    } else {
?>
        <script>
            document.getElementsByClassName('error')[0].style.display = "block";
        </script>
    <?php
        return $_SESSION['signup_error'];
    }
}

function showSignupSuccess()
{
    if (!isset($_SESSION['signup_success'])) {

        return $_SESSION['signup_success'] = '';
    } else {
    ?>
        <script>
            document.getElementsByClassName('success')[0].style.display = "block";
        </script>
    <?php
        return $_SESSION['signup_success'];
    }
}

// fuction for showing login message
function showLoginMsg()
{
    if (!isset($_SESSION['login_msg'])) {

        return $_SESSION['login_msg'] = '';
    } else {
    ?>
        <script>
            document.getElementsByClassName('error')[0].style.display = "block";
        </script>
    <?php
        return $_SESSION['login_msg'];
    }
}

// fuction for showing admin login message
function showAdminLoginMsg()
{
    if (!isset($_SESSION['admin_login_msg'])) {

        return $_SESSION['admin_login_msg'] = '';
    } else {
    ?>
        <script>
            document.getElementsByClassName('error')[0].style.display = "block";
        </script>
    <?php
        return $_SESSION['admin_login_msg'];
    }
}
function showLogoutMsg()
{
    if (!isset($_SESSION['logout_msg'])) {

        return $_SESSION['login_msg'] = '';
    } else {
    ?>
        <script>
            document.getElementsByClassName('success')[0].style.display = "block";
        </script>
<?php
        return $_SESSION['logout_msg'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="maths,class,9,10,11,12">
    <meta name="description" content="learn maths in cool way">
    <meta name="author" content="Mohit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="600">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (empty($_SESSION['username']) && !isset($_SESSION['username'])) {
            echo "coolmaths";
        } else {
            echo $_SESSION['username'];
        }
        ?>
    </title>
    <?php
    include 'security/db-con.php';
    $select_query = "select * from icon where status='active'";
    $sql = mysqli_query($con, $select_query);
    $output = "";
    if ($sql) {
        $row = mysqli_fetch_assoc($sql);
        $output .= "<link rel='icon' href='coolmaths-icon/" . $row['icon_name'] . "' type='image/x-icon'>";
        echo $output;
    } else {
        echo "Sorry, Connection error!!!";
    }
    $con->close();
    ?>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="footer/footer.css">
    <link rel="stylesheet" type="text/css" href="preloader/preloader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="index.js"></script>
</head>