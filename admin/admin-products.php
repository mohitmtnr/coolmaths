<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header('location:../index.php');
    session_destroy();
}
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
    <title>Admin</title>
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
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/admin-product.js"></script>
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
    <div id="message-screen">
        <div id="error-message"></div>
        <div id="success-message"></div>
        <div id="loading"></div>
    </div>
    <!-- full screen image -->
    <div id="image-display-container">
        <span class="close-image" onclick="this.parentElement.style.display='none'; document.body.style.overflow = 'visible';document.getElementById('full-screen-image').style.display='none'">&times;</span>
        <img id="full-screen-image" src="../coolmaths-icon/256x256.ico" alt="image">
    </div>
    <!-- side bar -->

    <div id="side-bar">
        <center>
            <h1 style="color:rgb(200, 170, 0); background-color:transparent;margin-top:20px;margin-bottom:30px;
            font-weight:bolder; letter-spacing:2px">Coolmaths</h1>
            <h3 style="margin:20px auto;font-weight:bolder"> Navigation </h3>
        </center>

        <div class="side-bar-card home">
            <ul class="side-bar-elements active-side-bar-elements">
                <?php
                include '../security/db-con.php';
                $select_query = "select * from classes order by id asc";
                $sql = mysqli_query($con, $select_query);
                $active_class = "class='item active-element'";
                $output = "";
                if ($sql) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($sql)) {
                        if ($i == 1) {
                            $i = 0;
                            $output .= "<li " . $active_class . "data-cid=" . $row['id'] . ">" . $row['class'] . "</li>";
                        } else {
                            $output .= "<li class='item'" . "data-cid=" . $row['id'] . ">" . $row['class'] . "</li>";
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
                <a href="admin.php">
                    <li title="Edit home">
                        <i class="fa fa-home"></i>
                    </li>
                </a>
                <a href="admin-services.php">
                    <li title="Edit services">
                        <i class="fa-solid fa-briefcase"></i>
                    </li>
                </a>
                <a href="admin-books.php">
                    <li title="Edit books">
                        <i class="fa-solid fa-book"></i>
                    </li>
                </a>
                <a href="admin-products.php" style="border-bottom:4px solid rgb(200,170,0);color: rgb(200,170,0)">
                    <li title="edit coolmaths' products">
                        <i class="fa-brands fa-product-hunt" style="color: rgb(200,170,0)"></i>
                    </li>
                </a>
                <a href="admin-classes.php">
                    <li title="edit coolmaths' classes">
                        <i class="fa-solid fa-user-tie"></i>
                    </li>
                </a>
                <span class="userContainer" title="Logout"><a href="admin.php"><i class="fa fa-user"></i></a>
                </span>
            </ul>
        </nav>

        <div id="main-body-content">

            <!-- Coolmaths' Products -->
            <div class="card active-card">
                <div id="add-products-button">
                    <span class="add product" onclick="showForm(0)">
                        <h1 style="padding-right:10px">+</h1> Products
                    </span>
                </div>
                <div class="admin-data-table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PREVIEW</th>
                                <th>NAME</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="products-tbody"></tbody>
                        <br />
                    </table>
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
        <!-- form 0 -->
        <div class="form product-upload" id="0">
            <center>
                <div class="form-header">Upload Pdfs <span class="close-form" onclick="closeForm(0)">&times;</span></div>
            </center>
            <form id="product-upload-form" class="upload-form">
                <i class="fa fa-id-card">
                    <input type="text" placeholder="class Id" name="classId" maxlength="10" autocomplete="off" required readonly autofocus="on" /></i>
                <i class="fa fa-envelope-open-text">
                    <input type="text" placeholder="Product Name" maxlength="30" name="productName" required /></i>
                <i class="fa fa-envelope-open-text">
                    <input type="text" placeholder="Type Text About The Product" maxlength="30" name="productText" required /></i>
                <i class="fa fa-link">
                    <input id="product-url" placeholder="Product URL" name="productUrl" type="url" multiple accept="video/*" required /></i>
                <input id="choose-product-image" name="file[]" type="file" multiple accept="img/jpg, img/png, img/jpeg, img/gif" required />
                <div class="upload-button">
                    <button type="submit" name="submit" id="upload-product">
                        UPLOAD
                    </button>
                </div>
            </form>
        </div>
        <!-- preloader ends -->
        <script>
            var loader = document.querySelector(".pre-loader");
            window.addEventListener("load", vanish);

            function vanish() {
                loader.classList.add("disappear");
            }
        </script>
</body>

</html>