<?php
require_once "header/header.php";
?>

<body>
    <?php
    require_once "preloader/preloader.php";
    ?>

    <div id="overlay">
        <center>
            <div class="error">
                <?php
                echo showSignupError();
                echo showLoginMsg();
                echo  showAdminLoginMsg();
                ?>
            </div>
        </center>
        <center>
            <div class="success">
                <?php
                echo showSignupSuccess();
                echo showLogoutMsg();
                ?>
            </div>
        </center>
    </div>
    <div id="image-display-container">
        <span class="close-image" onclick="this.parentElement.style.display='none'; document.body.style.overflow = 'visible';document.getElementById('full-screen-image').style.display='none'">&times;</span>
        <img id="full-screen-image" src="" alt="image">
    </div>
    <div id="readingMode"></div>
    <span id="readingMode2"><input type="checkbox" title="Reading Mode" onclick="readingMode()" id="read"></span>
    <!--main and right gouped-->
    <div id="main">
        <!--header-->
        <header>
            <?php
            include 'security/db-con.php';
            $select_query = "select * from icon where status='active'";
            $sql = mysqli_query($con, $select_query);
            $output = "";
            if ($sql) {
                // small edit
                $row = mysqli_fetch_assoc($sql);
                $output .= "<a href='index.php'><img id='img2' src='coolmaths-icon/1024x256.png' alt='coolmaths' />
                </a>";
                echo $output;
            } else {
                echo "<h1 style='color:rgb(108, 114, 147);'>Sorry, Connection error!!!</h1>";
            }
            $con->close();
            ?>
        </header>

        <!--navigation bar-->
        <nav>
            <ul>
                <a href="index.php" style="border-bottom:4px solid rgb(200,170,0);color: rgb(200,170,0)">
                    <li title="coolmaths home">
                        <i class="fa fa-home" style="color: rgb(200,170,0)"></i>
                    </li>
                </a>
                <a href="services/services.php">
                    <li title="what we service">
                        <i class="fa-solid fa-briefcase"></i>
                    </li>
                </a>
                <a href="books/books.php">
                    <li title="buy books">
                        <i class="fa-solid fa-book"></i>
                    </li>
                </a>
                <a href="products/products.php">
                    <li title="our products">
                        <i class="fa-brands fa-product-hunt"></i>
                    </li>
                </a>

                <a href="coolmaths-classes/classes.php">
                    <li title="coolmaths classes">
                        <i class="fa-solid fa-user-tie"></i>
                    </li>
                </a>
                <?php
                if (isset($_SESSION['username']) || !empty($_SESSION['username'])) {
                ?>
                    <span class="userContainer"><a href="user/user-dashboard.php"><i class="fa fa-user"></i>
                        </a></span>
                <?php
                } else {
                ?>
                    <span class="userContainer" title="Login" onclick="showLoginForm();hideMessages('error',0);hideMessages('success',0); getFocus('loginEmail');"><i class="fa fa-user"></i>
                    </span>
                <?php
                }
                ?>
            </ul>
        </nav>

        <!--main contents-->
        <div id="main-contents">
            <div class="main-contents-card carousel">
                <div class="slider-box">
                    <div id="slider">
                        <?php
                        include 'security/db-con.php';
                        $select_query = "select * from carousel where status='active' order by time desc";
                        $sql = mysqli_query($con, $select_query);
                        $output = "";
                        if ($sql) {
                            while ($row = mysqli_fetch_assoc($sql)) {
                                $output .= " <img class='myslide' src='carousel-images/" . $row['img'] . "' alt='img' />";
                            }
                            echo $output;
                        } else {
                            echo "<h1 style='color:rgb(108, 114, 147);'>Sorry, Connection error!!!</h1>";
                        }
                        $con->close();
                        ?>
                    </div>
                </div>
                <div class="indicators">
                    <?php
                    include 'security/db-con.php';
                    $select_query = "select * from carousel where status='active'";
                    $sql = mysqli_query($con, $select_query);
                    $output = "";
                    $n = mysqli_num_rows($sql);
                    if ($sql) {
                        for ($i = 0; $i < $n; $i++) {
                            if ($i == 0) {
                                $output .= "<span class='dot active'></span>";
                            } else {
                                $output .= "<span class='dot'></span>";
                            }
                        }
                        echo $output;
                    } else {
                        echo "<h1 style='color:rgb(108, 114, 147);'>Sorry, Connection error!!!</h1>";
                    }
                    $con->close();
                    ?>
                </div>
                <script>
                    carousel();
                </script>
            </div>
            <svg style="background-color:rgb(13, 23, 33);display:block" width="100%" height="70" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path id="wavepath" d="M0,0  L110,0C35,150 35,0 0,100z" fill="#282A35" style="fill: rgb(0,0,0);"></path>
            </svg>

            <div id="coolmaths-classes" style="background-color:rgb(13, 23, 33);width:100%;height:100%;display:block">
                <center>
                    <h1 style="color:white; padding:30px" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="3000">Learn With Us</h1>
                </center>
                <div class="classes">
                    <div class="swiper" style="margin-bottom:20px">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper" style="width:100%">
                            <!-- Slides -->
                            <?php
                            include 'security/db-con.php';
                            $select_query = "select * from classes order by id asc";
                            $sql = mysqli_query($con, $select_query);
                            $var = "onclick='<?php $" . "_SESSION['classId'] = 10; ?>'";
                            $output = "";
                            if ($sql) {
                                while ($row = mysqli_fetch_assoc($sql)) {
                                    $output .= "<div class='swiper-slide' data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'><div class='coolmaths-class-card'><img src='coolmaths-classes/" . $row['img'] . "' alt='img'  />" . "<a href='coolmaths-classes/classes.php?classId=" . $row['id'] . "'><center style='text-transform: capitalize;'>" . "<h2 style='padding-top:10px'>" . $row['class'] . "</h2></center><br/><h3>" . $row['content'] . "</h3></a></div></div>";
                                }
                                echo $output;
                            } else {
                                echo "<h1 style='color:rgb(108, 114, 147);'>Sorry, Connection error!!!</h1>";
                            }
                            $con->close();
                            ?>
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class=" swiper-button-prev" style="color:white"></div>
                        <div class="swiper-button-next" style="color:white"></div>
                    </div>
                    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js">
                        const swiper = new Swiper(".swiper", {
                            // If we need pagination
                            pagination: {
                                el: ".swiper-pagination",
                            },

                            // Navigation arrows
                            navigation: {
                                nextEl: ".swiper-button-next",
                                prevEl: ".swiper-button-prev",
                            },
                            slidesPerView: 3,
                            spaceBetween: 0,
                            autoplay: {
                                delay: 5000,
                            },
                        });
                    </script>
                </div>
            </div>
            <svg style="background-color:rgb(217, 238, 225);display:block" width="100%" height="70" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path id="wavepath" d="M0,0  L110,0C35,150 35,0 0,100z" fill="#282A35" style="fill: rgb(13, 23, 33);"></path>
            </svg>


            <div id="coolmaths-gallery" style="background-color:rgb(217, 238, 225);width:100%;height:740px;overflow:hidden">
                <center>
                    <h1 style="color:black; padding:30px;" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="3000">Coolmaths Gallery</h1>
                </center>
                <div class="gallery">
                    <?php
                    include 'security/db-con.php';
                    $select_query = "select * from gallery order by time desc";
                    $sql = mysqli_query($con, $select_query);
                    $output = "";
                    if ($sql) {
                        while ($row = mysqli_fetch_assoc($sql)) {
                            $output .= "<div class='coolmaths-gallery-card' data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>" . "<img src='gallery-images/" . $row['img_name'] . "' alt='img' onclick='fullScreenImage(this);' /></div>";
                        }
                        echo $output;
                    } else {
                        echo "<h1 style='color:rgb(108, 114, 147);'>Sorry, Connection error!!!</h1>";
                    }
                    $con->close();
                    ?>
                </div>
            </div>

            <svg style="background-color:rgb(100, 145, 145);display:block;" width="100%" height="70" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path id="wavepath" d="M0,0  L110,0C35,150 35,0 0,100z" fill="#282A35" style="fill:rgb(217, 238, 225);"></path>
            </svg>

            <div id="coolmaths-services-books-products" style="background-color:rgb(100,145,145);width:100%;height:100%">
                <center>
                    <h1 style="color:black; padding:30px;" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="3000">Explore Coolmaths</h1>
                </center>
                <div class="service-books-products" style="margin: 0px;">
                    <!-- services-books-products-card -->
                    <?php
                    include 'security/db-con.php';
                    $select_query = "select * from services order by time desc";
                    $sql = mysqli_query($con, $select_query);
                    $output = "";
                    if ($sql) {
                        $row = mysqli_fetch_assoc($sql);
                        $output .= "<div class='services-books-products-card' data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>" . "<img src='services/" . $row['img'] . "' alt='img'  />" . "<a href='services/services.php'>" . "<h2 style='padding-top:10px'>What We Service</h2></a></div>";
                        echo $output;
                    } else {
                        echo "<h1 style='color:rgb(108, 114, 147);'>Sorry, Connection error!!!</h1>";
                    }
                    $con->close();
                    ?>
                    <?php
                    include 'security/db-con.php';
                    $select_query = "select * from books order by time desc";
                    $sql = mysqli_query($con, $select_query);
                    $output = "";
                    if ($sql) {
                        $row = mysqli_fetch_assoc($sql);
                        $output .= "<div class='services-books-products-card' data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>" . "<img src='books/" . $row['img'] . "' alt='img'  />" . "<a href='books/books.php'>" . "<h2 style='padding-top:10px'>Buy Books</h2 style='padding-top:10px'></a></div>";
                        echo $output;
                    } else {
                        echo "<h1 style='color:rgb(108, 114, 147);'>Sorry, Connection error!!!</h1>";
                    }
                    $con->close();
                    ?>
                    <?php
                    include 'security/db-con.php';
                    $select_query = "select * from products order by time desc";
                    $sql = mysqli_query($con, $select_query);
                    $output = "";
                    if ($sql) {
                        $row = mysqli_fetch_assoc($sql);
                        $output .= "<div class='services-books-products-card' data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>" . "<img src='products/" . $row['img'] . "' alt='img'  />" . "<a href='products/products.php'>" . "<h2 style='padding-top:10px'>Our Products</h2></a></div>";
                        echo $output;
                    } else {
                        echo "<h1 style='color:rgb(108, 114, 147);'>Sorry, Connection error!!!</h1>";
                    }
                    $con->close();
                    ?>
                </div>
            </div>
            <svg style="background-color:rgb(13, 23, 33);display:block;" width="100%" height="70" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path id="wavepath" d="M0,0  L110,0C35,150 35,0 0,100z" fill="#282A35" style="fill:rgb(100, 145, 145);"></path>
            </svg>
            <div id="about-coolmaths" style="background-color:rgb(13, 23, 33);width:100%;height:100%">
                <center>
                    <h1 style="color:white; padding:30px;" data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>About Us</h1>
                    <div class="coolmaths-about-card">
                        <h1 style="margin:10px;letter-spacing:10px;line-height:50px;color:rgb(200, 170, 0);font-weight:900" data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>COOLMATHS </h1>
                        <p style="margin:10px;word-spacing: 5px;line-height:50px;color: rgb(108, 114, 147);" data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>Welcome to the coolmaths website, a startup by a BCA student. This website basically provides the material related to Maths subject. We try to provide notes in more simpler and enjoyable manner where you will not get the monotonous feeling while studying. We are here to help each and every student who strugles to get proper notes and videos. We hope this website will improve all your learning experience. </p>
                        <div class="about-content">
                            <div data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>
                                <img src="idea.png" alt="idea" />
                                <h2 style="color:rgb(200, 170, 0);margin:10px;">The Idea</h2>
                                <p> We offer mathematics in an enjoyable and easy-to-learn manner, because we believe that mathematics is fun.</p>
                            </div>
                            <div data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>
                                <img src="general.png" alt="idea" />
                                <h2 style="color:rgb(200, 170, 0);margin:10px;">General</h2>
                                <p> The site aims to cover the full Kindergarten to Year 12 curriculum.</p>
                            </div>
                            <div data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>
                                <img src="quality.png" alt="idea" />
                                <h2 style="color:rgb(200, 170, 0);margin:10px;">Quality</h2>
                                <p> Quality is important to us and we will regularly improve it.</p>
                            </div>
                            <div data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>
                                <img src="commitement.png" alt="idea" />
                                <h2 style="color:rgb(200, 170, 0);margin:10px;">Our Commitment</h2>
                                <p>The site will continue to grow over time. Keep coming back to find out what has been added.</p>
                            </div>
                            <div data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>
                                <img src="feedback.png" alt="idea" />
                                <h2 style="color:rgb(200, 170, 0);margin:10px;"> Feedback</h2>
                                <p>If you like the site or would like to make comments or even contributions then contact us.</p>
                            </div>
                            <div data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>
                                <img src="maintenance.png" alt="idea" />
                                <h2 style="color:rgb(200, 170, 0);margin:10px;"> Maintained By</h2>
                                <p> Coolmaths is maintained by a expert group of students with contributions from many others.</p>
                            </div>
                        </div>
                    </div>
                </center>
            </div>

            <div id="coolmaths-team" style="background-color: rgb(217, 238, 225);width:100%;height:100%">
                <center>
                    <h1 style="color:black; padding:30px;" data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'>Our Team</h1>

                    <!-- Slider main container -->
                    <div class="team">
                        <div class="swiper" style="margin-bottom:20px">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <?php
                                include 'security/db-con.php';
                                $select_query = "select * from admins where status='active'";
                                $sql = mysqli_query($con, $select_query);
                                $output = "";
                                if ($sql) {
                                    while ($row = mysqli_fetch_assoc($sql)) {
                                        $output .= "<div class='swiper-slide' data-aos='fade-up' data-aos-anchor-placement='top-bottom' data-aos-duration='3000'><div class='coolmaths-team-card'>
                                            <img src='user-profile/" . $row['img'] . "' alt=' image'/>
                                            <center style='width:100%;text-transform: capitalize;'><h3 style=' color: white;'>" . $row['username'] . "</h3> <p style='margin:10px auto;'>" . $row['designation'] . "</p>
                                            <a href='https://wa.me/" . $row['mobile'] . "'>WhatsApp us</a>
                                            </center></div></div>";
                                    }
                                    echo $output;
                                } else {
                                    echo "<h1 style='color:rgb(108, 114, 147);'>Sorry, Connection error!!!</h1>";
                                }
                                $con->close();
                                ?>
                            </div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev" style="color:black"></div>
                            <div class="swiper-button-next" style="color:black"></div>
                        </div>
                        <script>
                            const swiper = new Swiper(".swiper", {
                                // If we need pagination
                                pagination: {
                                    el: ".swiper-pagination",
                                },

                                // Navigation arrows
                                navigation: {
                                    nextEl: ".swiper-button-next",
                                    prevEl: ".swiper-button-prev",
                                },
                                slidesPerView: 3,
                                spaceBetween: 0,
                                autoplay: {
                                    delay: 5000,
                                },
                            });
                        </script>
                    </div>
                </center>
            </div>
        </div>
        <?php
        require_once "footer/footer.php";
        ?>
    </div>
    <!--login form-->
    <div id="loginForm">
        <div class="headingContainer">
            <p>Login</p><span onclick="closeLoginForm()">X</span>
        </div><br>
        <form action="http://localhost/coolmaths/security/login.php" enctype="multipart/form-data" method="POST">
            <i class="fa fa-user"></i>
            <input id="loginEmail" type="email" placeholder="Email Address" name="email" maxlength="30" autocomplete="off" required autofocus="on" /><br>
            <i class="fa fa-lock"></i>
            <input id="login-password" type="password" placeholder="Password" name="password" maxlength="30" required /><br><br>
            <button type="submit" name="submit">Login</button><br>
            <span id="forgot" onclick="showForgotPasswordForm();getFocus('registeredEmail');hideMessages('error',0);hideMessages('success',0)">Forgot Password?</span><br>
            <label for="signup">No Account?</label>
            <span id="signup" onclick="showSignUpForm();hideMessages('error',0);hideMessages('success',0);getFocus('signupUser')">Sign Up</span><br>
            <label for="login">Are you an admin?</label>
            <span id="adminLogin" onclick="showAdminLoginForm();hideMessages('error',0);hideMessages('success',0);getFocus('adminId')">Login here</span>
        </form>
    </div>

    <!-- admin login -->
    <div id="adminLoginForm">
        <div class="headingContainer">
            <p>Admin Login</p><span onclick="closeAdminLoginForm();">X</span>
        </div><br>
        <form action="http://localhost/coolmaths/admin/adminLogin.php" enctype="multipart/form-data" method="POST">
            <i class="fa fa-id-card"></i>
            <input id="adminId" type="text" placeholder="Enter your ID" name="id" maxlength="30" autocomplete="off" required autofocus="on" /><br>
            <i class="fa fa-user"></i>
            <input id="adminEmail" type="email" placeholder="Email Address" name="email" maxlength="30" autocomplete="off" required /><br>
            <i class="fa fa-lock"></i>
            <input id="adminPassword" type="password" placeholder="Password" name="password" maxlength="30" required /><br><br>
            <button type="submit" name="submit">Login</button><br><br>
            <label for="login">Are you a student?</label>
            <span id="studentLogin" onclick="showLoginForm();hideMessages('error',0);hideMessages('success',0);getFocus('loginEmail')">Login here</span>
        </form>
    </div>


    <!--forgot password-->
    <div id="forgotPassword">
        <div class="headingContainer">
            <p>Forgot password</p><span onclick="closeForgotPasswordForm()">X</span>
        </div><br>
        <form method="$_POST">
            <i class="fa fa-at"></i>
            <input id="registeredEmail" type="text" placeholder="Registered Email" name="email" maxlength="30" autocomplete="off" required autofocus="on" /><br>
            <button id="sendOtpButton" type="button" onclick="checkEmail()">Send OTP</button><br>
            <input id="otpInput" type="text" placeholder="Confirm OTP" name="OTP" required maxlength="6" /><br>
            <button id="otpButton" type="button" onclick="showResetPasswordForm(); checkOtp();">Submit</button>
        </form>
    </div>

    <!-- Reset Password-->
    <div id="resetPassword">
        <div class="headingContainer">
            <p>Reset password</p><span onclick="closeResetPasswordForm()">X</span>
        </div><br>
        <form method="$_POST">
            <i class="fa fa-lock"></i>
            <input id="newPassword" type="password" placeholder="New Password" maxlength="30" name="Newpassword" required /><br>
            <i class="fa fa-lock"></i>
            <input id="confirmNewPassword" type="password" placeholder="Confirm Password" maxlength="30" name="confirmNewPassword" required /><br>
            <button type="button" onclick="showLoginForm()">Reset</button>
        </form>
    </div>

    <!--sign up form-->
    <div id="signupForm">
        <div class="headingContainer">
            <p>Sign up</p><span onclick="closeSignUpForm()">X</span>
        </div><br>
        <form action="http://localhost/coolmaths/security/signup.php" enctype="multipart/form-data" method="POST">
            <i class="fa fa-user"></i>
            <input id="signupUser" type="text" placeholder="Username" name="username" maxlength="30" autocomplete="off" required autofocus="on" /><br>
            <i class="fa fa-at"></i>
            <input id="signupEmail" type="email" placeholder="Email Address" name="email" maxlength="30" autocomplete="off" required /><br>
            <i class="fa fa-mobile" aria-hidden="true"></i>
            <input id="signupMobile" type="tel" placeholder="Mobile No." name="mobile" pattern="[0-9]{10}" autocomplete="off" required maxlength="10" /><br>
            <i class="fa fa-lock"></i>
            <input id="password" type="password" placeholder="Password" maxlength="30" name="password" required><br>
            <i class="fa fa-lock"></i>
            <input id="confirmPassword" type="password" placeholder="Confirm Password" maxlength="30" name="confirmPassword" required /><br>
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>

    <?php
    if (!empty($_SESSION['signup_error'])) {
    ?>
        <script>
            showOverlay();
            showSignUpForm();
        </script>
    <?php
    } else if (!empty($_SESSION['admin_login_msg'])) {
    ?>
        <script>
            showOverlay();
            showAdminLoginForm();
        </script>
    <?php
    } else if (isset($_SESSION['username']) || !empty($_SESSION['username'])) {
    } else {
    ?>

        <script>
            showLoginForm();
        </script>
    <?php
    }
    ?>


    <!-- preloader ends -->
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


<?php
unset($_SESSION['signup_success']);
unset($_SESSION['login_msg']);
unset($_SESSION['signup_error']);
unset($_SESSION['admin_login_msg']);
unset($_SESSION['logout_msg']);
?>