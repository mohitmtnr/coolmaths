<?php
session_start();
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
        <?php
        if (empty($_SESSION['username']) && !isset($_SESSION['username'])) {
            echo "coolmaths";
        } else {
            echo $_SESSION['username'];
        }
        ?>
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
    <link rel="stylesheet" type="text/css" href="css/services.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/services.js"></script>
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
        <span id="close-side-bar" style="float:right;padding:5px 10px;font-weight:bolder">x</span>
        <div style="margin:10px 0px;font-weight:bolder;padding:0rem 3rem;width:100px;border-bottom:3px inset rgb(30, 35, 45);">
            <a id="coolmaths-icon" href="../index.php"><img src="../coolmaths-icon/256x256.ico" alt="logo"></a>
            <h4 style="margin:10px auto"> Navigation </h4>
        </div>

        <div class="side-bar-card">
            <ul class="side-bar-elements">
                <?php
                include '../security/db-con.php';
                if (isset($_GET['classId']) && !empty($_GET['classId'])) {
                    $class_id = $_GET['classId'];
                } else {
                    $class_id = 0;
                }

                $select_query = "select * from classes order by id asc";
                $sql = mysqli_query($con, $select_query);
                $active_class = "class='item active-item'";
                $output = "";
                if ($sql) {
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($sql)) {
                        ++$i;

                        if ($class_id == $row['id']) {
                            $output .= "<li " . $active_class . "data-cid='" . $row['id'] . "'>" . $row['class'] . "</li>";
                        } else {
                            if ($class_id == 0 && $i == 1) {
                                $output .= "<li " . $active_class . "data-cid=" . $row['id'] . ">" . $row['class'] . "</li>";
                            } else {
                                $output .= "<li class='item'" . "data-cid=" . $row['id'] . ">" . $row['class'] . "</li>";
                            }
                        }
                    }
                    echo $output;
                } else {
                    echo "Sorry, Connection error!!!";
                }
                $con->close();
                ?>
            </ul>
        </div>
    </div>


    <!--main and right gouped-->
    <div id="main">
        <!--navigation bar-->
        <nav>
            <ul>
                <!-- show side bar -->
                <a id="toggle-button" title="show side bar">
                    <li>
                        <i class="fa-solid fa-bars"></i>
                    </li>
                </a>
                <a href="../index.php">
                    <li title="home">
                        <i class="fa fa-home"></i>
                    </li>
                </a>
                <a href="../services/services.php" style="border-bottom:4px solid rgb(200,170,0);color: rgb(200,170,0)">
                    <li title="services">
                        <i class="fa-solid fa-briefcase" style="color: rgb(200,170,0)"></i>
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
                <a href="../coolmaths-classes/classes.php">
                    <li title="coolmaths classes">
                        <i class="fa-solid fa-user-tie"></i>
                    </li>
                </a>
                <?php
                if (isset($_SESSION['username']) || !empty($_SESSION['username'])) {
                ?>
                    <span class="userContainer"><a href="../user/user-dashboard.php" title="logout"><i class="fa fa-user"></i>
                        </a></span>
                <?php
                } else {
                ?>
                    <span class="userContainer"><a href="../index.php" title="login"><i class="fa fa-user"></i>
                        </a></span>
                <?php
                }
                ?>
            </ul>
        </nav>

        <div id="main-body-content">
            <div id="message-screen">
                <div id="loading"></div>
            </div>
            <!-- Coolmaths' services-->
            <div class="card active-card">
                <div id="coolmaths-services" style="background-color:rgb(25, 28, 36);width:100%;height:100%;display:block">
                    <center>
                        <h1 style="color:white; padding:30px" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="3000">Avail Our Services</h1>
                    </center>
                    <div class="services" id="service-content">

                    </div>
                </div>
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
    </div>

    <script>
        var loader = document.querySelector(".pre-loader");
        window.addEventListener("load", vanish);

        function vanish() {
            loader.classList.add("disappear");
        }
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</body>

</html>