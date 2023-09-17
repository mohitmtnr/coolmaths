<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header('location:../index.php');
    session_destroy();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = "";
    function updateProfile()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        require_once '../security/db-con.php';

        if (empty($_FILES["file"]["name"])) {
            $error = "Please, select a file";
        }
        $file_count = count($_FILES['file']['name']);
        if ($file_count > 1) {
            $error = "Max 1 image can be selected at once!!!";
        }
        $target_dir = "../user-profile/";
        $target_file = $target_dir . basename($_FILES["file"]["name"][0]);
        $file_name = $_FILES["file"]["name"][0];
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["file"]["tmp_name"][0]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $error = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["file"]["size"][0] > (5 * 1024 * 1024)) {
            $error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            $error = "Sorry, only jpg/png/jpeg file is allowed!";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error = "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            $id = $_SESSION['id'];
            $update_query = "update admins set img='$file_name' where id='$id'";
            $sql = mysqli_query($con, $update_query);
            if (move_uploaded_file($_FILES["file"]["tmp_name"][0], $target_file) && $sql) {
                header('location:admin.php');
            } else {
                $error = "Something went wrong!!!";
                header('location:admin.php');
            }
        }
        $con->close();
    }
    updateProfile();
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
    <title> Admin </title>
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
    <script src="js/admin.js"></script>
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
                <li class="coolmaths-dashboard item active-element">Dashboard</li>
                <li class="coolmaths-member item ">Members</li>
                <li class="coolmaths-icon item ">Coolmaths' Icons</li>
                <li class="coolmaths-carousel item">Carousel Images</li>
                <li class="coolmaths-gallery item">Gallery Images</li>
                <li class="coolmaths-add-classes item">Add Classes</li>
            </ul>
        </div>
    </div>


    <!--main and right gouped-->
    <div id="main">
        <!--navigation bar-->
        <nav>
            <ul>
                <!-- toggle side bar -->
                <a id="toggle-button" title="toggle side bar">
                    <li>
                        <i class="fa-solid fa-bars"></i>
                    </li>
                </a>
                <a href="admin.php" style="border-bottom:4px solid rgb(200,170,0);color: rgb(200,170,0)">
                    <li title="Edit Index and Home page">
                        <i class="fa fa-home" style="color: rgb(200,170,0)"></i>
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
                <a href="admin-products.php">
                    <li title="edit coolmaths products">
                        <i class="fa-brands fa-product-hunt"></i>
                    </li>
                </a>
                <a href="admin-classes.php">
                    <li title="edit coolmaths' classes">
                        <i class="fa-solid fa-user-tie"></i>
                    </li>
                </a>
                <span class="userContainer" title="Logout" onclick="showLogoutForm()">
                    <?php
                    include '../security/db-con.php';
                    $user = $_SESSION['username'];
                    $id = $_SESSION['id'];
                    $select_query = "select img from admins where username='$user' and id='$id'";
                    $sql = mysqli_query($con, $select_query);
                    if ($sql) {
                        $row = mysqli_fetch_assoc($sql);
                        echo "<i><img src='../user-profile/" . $row['img'] . "'/ >";
                    } else {
                        echo "<i  class='fa fa-user'>";
                    }
                    $con->close();
                    ?>
                    </i>
                </span>
            </ul>
        </nav>

        <div id="main-body-content">

            <!-- Coolmaths' Dashboard -->
            <div class="card active-card">
                <div id="add-admin-button">
                    <span class="add admin" onclick="showForm(0)">
                        <h1 style="padding-right:10px">+</h1> Admin
                    </span>
                </div>
                <div class="admin-data-table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PROFILE</th>
                                <th>USERNAME</th>
                                <th>EMAIL</th>
                                <th>MOBILE</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="admin-tbody"></tbody>
                        <br />
                    </table>
                </div>
            </div>
            <!-- member -->
            <div class="card">
                <div id="add-member-button">
                    <span class="add member" onclick="showForm(1)">
                        <h1 style="padding-right:10px">+</h1>Member
                    </span>
                </div>
                <div class="admin-data-table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PROFILE</th>
                                <th>USERNAME</th>
                                <th>EMAIL</th>
                                <th>MOBILE</th>
                                <th>CLASS</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="member-tbody"></tbody>
                        <br />
                    </table>
                </div>
            </div>
            <!-- coolmath's icon -->
            <div class="card">
                <div id="add-icon-button">
                    <span class="add icon" onclick="showForm(2)">
                        <h1 style="padding-right:10px">+</h1> Icon
                    </span>
                </div>
                <div class="admin-data-table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PREVIEW</th>
                                <th>ICON</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="icon-tbody"></tbody>
                        <br />
                    </table>
                </div>
            </div>

            <!-- Carousel Images -->
            <div class=" card">
                <div id="add-carousel-image-button">
                    <span class="add carousel-images " onclick="showForm(3)">
                        <h1 style="padding-right:10px">+</h1>
                        Images
                    </span>
                </div>

                <div class="admin-data-table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PREVIEW</th>
                                <th>IMAGE</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="carousel-tbody"></tbody>
                        <br />
                    </table>
                </div>
            </div>

            <!-- Gallery Images -->
            <div class="card">
                <div id="add-gallery-image-button">
                    <span class="add gallery-images" onclick="showForm(4)">
                        <h1 style=" padding-right:10px">+</h1> Image
                    </span>
                </div>
                <div class="admin-data-table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PREVIEW</th>
                                <th>IMAGE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="gallery-tbody"></tbody>
                        <br />
                    </table>
                </div>
                <div>
                </div>
            </div>


            <!-- add class  -->
            <div class="card">
                <div id="add-class-button">
                    <span class="add class" onclick="showForm(5)">
                        <h1 style=" padding-right:10px">+</h1> Class
                    </span>
                </div>
                <div class="admin-data-table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PREVIEW</th>
                                <th>IMAGE</th>
                                <th>CLASS NAME</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="class-tbody"></tbody>
                        <br />
                    </table>
                </div>
                <div>
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
        <div class="form upload-admins-details" id="0">
            <center>
                <div class="form-header">Add Admins <span class="close-form" onclick="closeForm(0)">&times;</span></div>
            </center>
            <form id="upload-admins-details-form" class="upload-form" method="POST">
                <i class="fa fa-id-card">
                    <input type="text" placeholder="Id" name="id" maxlength="10" autocomplete="off" required autofocus="on" /></i>
                <i class="fa fa-user">
                    <input type="text" placeholder="Username" name="username" maxlength="20" autocomplete="off" required autofocus="on" /></i>
                <i class="fa fa-briefcase">
                    <input type="text" placeholder="Designation" name="designation" maxlength="60" autocomplete="off" required autofocus="on" /></i>
                <i class="fa fa-at">
                    <input type="email" placeholder="Email Address" name="email" maxlength="30" autocomplete="off" required /></i>
                <i class="fa fa-mobile" aria-hidden="true">
                    <input type="tel" placeholder="Mobile No." name="mobile" pattern="[0-9]{10}" autocomplete="off" required maxlength="10" /></i>
                <i class="fa fa-lock">
                    <input type="password" placeholder="Password" maxlength="30" name="password" required></i>
                <i class="fa fa-lock">
                    <input type="password" placeholder="Confirm Password" maxlength="30" name="confirmPassword" required /></i>
                <i class="fa fa-lightbulb">
                    <select name="status" name="status" autocomplete="off" required autofocus="on">
                        <option value="inactive">inactive</option>
                        <option value="active">active</option>
                    </select></i></i>
                <div class="upload-button">
                    <button type="submit" name="submit" id="upload-admins">
                        SUBMIT
                    </button>
                </div>
        </div>
        </form>
    </div>
    <!-- form 1 -->
    <div class="form upload-members-details" id="1">
        <center>
            <div class="form-header">Add members <span class="close-form" onclick="closeForm(1)">&times;</span></div>
        </center>
        <form id="upload-members-details-form" class="upload-form">
            <i class="fa fa-id-card">
                <input type="text" placeholder="Id" name="id" maxlength="10" autocomplete="off" required autofocus="on" /></i>
            <i class="fa fa-user">
                <input type="text" placeholder="Username" name="username" maxlength="20" autocomplete="off" required autofocus="on" /></i>
            <i class="fa fa-at">
                <input type="email" placeholder="Email Address" name="email" maxlength="30" autocomplete="off" required /></i>
            <i class="fa fa-mobile" aria-hidden="true">
                <input type="tel" placeholder="Mobile No." name="mobile" pattern="[0-9]{10}" autocomplete="off" required maxlength="10" /></i>
            <i class="fa fa-lock">
                <input type="password" placeholder="Password" maxlength="30" name="password" required></i>
            <i class="fa fa-lock">
                <input type="password" placeholder="Confirm Password" maxlength="30" name="confirmPassword" required /></i>
            <i class="fa fa-lightbulb">
                <select name="status" name="status" autocomplete="off" required autofocus="on">
                    <option value="inactive">inactive</option>
                    <option value="active">active</option>
                </select></i>
            <i class="fa fa-id-card">
                <input type="text" placeholder="Class Id" name="classId" maxlength="10" autocomplete="off" autofocus="on" /></i>
            <div class="upload-button">
                <button type="submit" name="submit" id="upload-members">
                    SUBMIT
                </button>
            </div>
    </div>
    </form>
    </div>
    <!-- form 2 -->
    <div class="form icon-upload" id="2">
        <center>
            <div class="form-header">Upload Icon <span class="close-form" onclick="closeForm(2)">&times;</span></div>
        </center>
        <form id="icon-upload-form" class="upload-form" method="POST">
            <input id="choose-icon" name="file[]" type="file" accept="img/jpg, img/png, img/jpeg, img/gif,img/.ico" required />
            <div class="upload-button">
                <button type="submit" name="submit" id="upload-icon">
                    UPLOAD
                </button>
            </div>
        </form>
    </div>
    <!-- form 3 -->
    <div class="form carousel-image-upload" id="3">
        <center>
            <div class="form-header">Upload Image <span class="close-form" onclick="closeForm(3)">&times;</span></div>
        </center>
        <form id="carousel-image-upload-form" class="upload-form">
            <input id="choose-carousel-image" name="file[]" type="file" multiple accept="img/jpg, img/png, img/jpeg, img/gif" required />
            <div class="upload-button">
                <button type="submit" name="submit" id="upload-carousel-image">
                    UPLOAD
                </button>
            </div>
        </form>
    </div>
    <!-- form 4-->
    <div class="form gallery-image-upload" id="4">
        <center>
            <div class="form-header">Upload Image <span class="close-form" onclick="closeForm(4)">&times;</span></div>
        </center>
        <form id="gallery-image-upload-form" class="upload-form">
            <input type="text" placeholder="Id" name="id" maxlength="10" autocomplete="off" required readonly autofocus="on" />
            <br />
            <input id="choose-gallery-image" name="file[]" type="file" multiple accept="img/jpg, img/png, img/jpeg, img/gif" required />
            <input type="text" placeholder="About Image...atmost(50 letters)" name="aboutImage" maxlength="50" autocomplete="off" autofocus="on" />
            <br />
            <div class="upload-button">
                <button type="submit" name="submit" id="upload-gallery-image">
                    UPLOAD
                </button>
            </div>
        </form>
    </div>
    <!-- form 5 -->
    <div class="form upload-class-details" id="5">
        <center>
            <div class="form-header">Add Class <span class="close-form" onclick="closeForm(5)">&times;</span></div>
        </center>
        <form id="upload-class-details-form" class="upload-form">
            <i class="fa fa-id-card">
                <input type="text" placeholder="Id" name="id" maxlength="10" autocomplete="off" required autofocus="on" /></i>
            <i class="fa fa-graduation-cap">
                <input type="text" placeholder="Class Name" name="className" maxlength="20" autocomplete="off" required autofocus="on" /></i>
            <i class="fa fa-envelope-open-text">
                <input type="text" placeholder="Type Text About The Class" maxlength="30" name="classText" required /></i>
            <input id="choose-class-image" name="file[]" type="file" accept="img/jpg, img/png, img/jpeg, img/gif" required />
            <div class="upload-button">
                <button type="submit" name="submit" id="upload-class">
                    SUBMIT
                </button>
            </div>
    </div>
    </form>
    </div>
    <!--logout form-->
    <div id="logoutForm">
        <div class="headingContainer">
            <p>Logout</p><span onclick="closeLogoutForm()">&times;</span>
        </div><br />
        <center>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="profileImage" class="userContainer" title="Choose Profile Image To Change">
                    <?php
                    include '../security/db-con.php';
                    $user = $_SESSION['username'];
                    $id = $_SESSION['id'];
                    $select_query = "select img from admins where username='$user' and id='$id'";
                    $sql = mysqli_query($con, $select_query);
                    if ($sql) {
                        $row = mysqli_fetch_assoc($sql);
                        echo "<i><img src='../user-profile/" . $row['img'] . "'/ >";
                    } else {
                        echo "<i  class='fa fa-user'>";
                    }
                    $con->close();
                    ?>
                    <input id="profileImage" name="file[]" type="file" accept="image/png, image/jpg, image/jpeg" /></i>
                </label>
                <button type="submit" name="submit" style="width:fit-content;background:black; padding: 5px 20px;">Change</button>
            </form>

            <br />
            <p style="color:rgb(108, 114, 147);font-size:18px;font-weight:bold;text-transform: capitalize;">
                <?php
                echo "Hi, ", $_SESSION['username'];
                ?>
            </p>
            <br />
            <!-- <div id="changePassword">Change Password</div> -->
        </center>

        <form action="http://localhost/coolmaths/security/logout.php" enctype="multipart/form-data" method="POST" id="logout">
            <button type="submit" name="submit">Logout</button>
        </form>
    </div>
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