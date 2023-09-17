<?php
session_start();
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('location:../index.php');
    session_destroy();
}
?>
<?php


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="maths,class,9,10,11,12,BCA">
    <meta name="description" content="learn maths in cool way">
    <meta name="author" content="Mohit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="600">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $_SESSION['username'] ?>
    </title>
    <?php
    include '../security/db-con.php';
    $select_query = "select * from icon where status='active'";
    $sql = mysqli_query($con, $select_query);
    $output = "";
    if ($sql) {
        $row = mysqli_fetch_assoc($sql);
        $output .= "<link rel='icon' href='../coolmaths-icon/" . $row['icon_name'] . "' type='image/x-icon'>";
        echo $output;
    } else {
        echo "Sorry, Connection error!!!";
    }
    $con->close();
    ?>
    <link rel="stylesheet" type="text/css" href="css/user-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/user-dashboard.js"></script>
</head>

<body>

    <!-- preloader starts -->
    <center>
        <div class="pre-loader" style="display:flex;justify-content: center;align-items: center;">
            <span class="pre-loading"></span>
        </div>
    </center>

    <!-- overlay -->

    <div id="overlay"></div>

    <!-- side bar -->

    <div id="side-bar">
        <center>
            <h1 style="color:rgb(200, 170, 0); background-color:transparent;margin-top:20px;margin-bottom:30px;
            font-weight:bolder; letter-spacing:2px">Coolmaths</h1>
            <h3 style="margin:20px auto;font-weight:bolder"> Navigation </h3>
        </center>

        <div class="side-bar-card user-dashboard">
            <ul class="side-bar-elements active-side-bar-elements">
                <li class="dashboard item active-element">Dashboard</li>
                <li class="edit-profile item">Edit Profile</li>
                <li class="to-do-list item">To Do List</li>
                <li class="solve-problems item">Solve Problems</li>
                <li class="feedback item">Feedback</li>
            </ul>
        </div>
    </div>


    <!--main and right gouped-->
    <div id="main">
        <!--navigation bar-->
        <nav>
            <ul>
                <a href="../index.php">
                    <li title="coolmaths home">
                        <i class="fa fa-home"></i>
                    </li>
                </a>
                <a href="../services/services.php">
                    <li title="services">
                        <i class="fa-solid fa-briefcase"></i>
                    </li>
                </a>
                <a href="../books/books.php">
                    <li title="books">
                        <i class="fa-solid fa-book"></i>
                    </li>
                </a>
                <a href="../products/products.php">
                    <li title="coolmaths products">
                        <i class="fa-brands fa-product-hunt"></i>
                    </li>
                </a>
                <span class="userContainer" title="Logout" onclick="showLogoutForm()">
                    <?php
                    include '../security/db-con.php';
                    $user = $_SESSION['username'];
                    $id = $_SESSION['id'];
                    $select_query = "select img from members where username='$user' and id='$id'";
                    $sql = mysqli_query($con, $select_query);
                    if ($sql) {
                        $row = mysqli_fetch_assoc($sql);
                        echo "<i><img  src='../user-profile/" . $row['img'] . "'/ >";
                    } else {
                        echo "<i  class='fa fa-user'>";
                    }
                    $con->close();
                    ?></i>
                </span>
            </ul>
        </nav>

        <div id="main-body-content">

            <!-- Coolmaths' Icon -->
            <div class="card active-card">
                In progress
            </div>

            <!-- Side Bar Elements -->
            <div class="card">
                In progress
            </div>

            <!-- Carousel Images -->
            <div class="card">
                In progress
            </div>

            <!-- Gallery Images -->
            <div class="card">
                In progress
            </div>

            <!-- Other Elements -->
            <div class="card">
                In progress
            </div>
        </div>

        <!--footer-->
        <footer id="mainFooter">
            <div id="footer-elements">
                <div class="icons">
                    <center>
                        <h2>Join Us</h2>
                    </center>
                    <div class="social-media-icons">
                        <a href="#" title="Join us on Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" title="Join us on Twitter">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                        <a href="#" title="Join us on Linkedin">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="#" title="Join us on Youtube">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="#" title="Join us on Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <p><small>Copyright &copy;2021. All Rights Reserved.</small></p>
        </footer>

        <!--logout form-->
        <div id="logoutForm">
            <div class="headingContainer">
                <p>Logout</p><span onclick="closeLogoutForm()">X</span>
            </div><br>
            <center>
                <label for="profileImage" class="userContainer">
                    <?php
                    include '../security/db-con.php';
                    $user = $_SESSION['username'];
                    $id = $_SESSION['id'];
                    $select_query = "select img from members where username='$user' and id='$id'";
                    $sql = mysqli_query($con, $select_query);
                    if ($sql) {
                        $row = mysqli_fetch_assoc($sql);
                        echo "<i><img  src='../user-profile/" . $row['img'] . "'/ >";
                    } else {
                        echo "<i  class='fa fa-user'>";
                    }
                    $con->close();
                    ?>
                    <input id="profileImage" type="file" /> </i>
                </label>

                <br>
                <p style="color:rgb(108, 114, 147);font-size:18px;font-weight:bold;text-transform: capitalize;">
                    <?php
                    echo "hi, ", $_SESSION['username'];
                    ?>
                </p>
                <br>
                <!-- <div id="changePassword">Change Password</div> -->
            </center>

            <form action="http://localhost/coolmaths/security/logout.php" enctype="multipart/form-data" method="POST" id="logout">
                <button type="submit" name="submit">Logout</button>
            </form>
        </div>
    </div>
</body>

</html>