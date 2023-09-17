
<?php
if ($_GET['name'] == 'icon') {
    echo uploadIcons();
    exit(0);
} else if ($_GET['name'] == 'carousel') {
    echo uploadCarouselImages();
    exit(0);
} else if ($_GET['name'] == 'gallery') {
    echo uploadGalleryImages();
    exit(0);
} else if ($_GET['name'] == 'admin') {
    echo addAdmins();
    exit(0);
} else if ($_GET['name'] == 'member') {
    echo addMembers();
    exit(0);
} else if ($_GET['name'] == 'class') {
    echo addClasses();
    exit(0);
}
function uploadIcons()
{
    session_start();
    require_once '../security/db-con.php';

    if (empty($_FILES["file"]["name"])) {
        echo "Please, select a file";
        exit(0);
    }
    $file_count = count($_FILES['file']['name']);
    if ($file_count > 1) {
        echo "Max 1 image can be selected at once!!!";
        exit(0);
    }
    $target_dir = "../coolmaths-icon/";
    $target_file = $target_dir . basename($_FILES["file"]["name"][0]);
    $file_name = $_FILES["file"]["name"][0];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["file"]["tmp_name"][0]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
        exit(0);
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        exit(0);
    }

    // Check file size
    if ($_FILES["file"]["size"][0] > (5 * 1024 * 1024)) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        exit(0);
    }

    // Allow certain file formats
    if (
        $imageFileType != "ico" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only .ico file is allowed!";
        $uploadOk = 0;
        exit(0);
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        $insert_query = "insert into icon(icon_name,status,time) values('$file_name','inactive',current_timestamp())";
        $sql = mysqli_query($con, $insert_query);
        if (move_uploaded_file($_FILES["file"]["tmp_name"][0], $target_file) && $sql) {
            echo "1";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $con->close();
}




function uploadCarouselImages()
{
    session_start();
    require_once '../security/db-con.php';
    $error_msg = '';
    if (empty($_FILES["file"]["name"])) {
        echo "Please, select a file!!!<br/>";
        exit(0);
    }
    $file_count = count($_FILES['file']['name']);
    if ($file_count > 10) {
        echo "Max 10 images can be selected at once!!!";
        exit(0);
    }

    $target_dir = "../carousel-images/";

    for ($i = 0; $i < $file_count; ++$i) {
        $target_file = $target_dir . basename($_FILES["file"]["name"][$i]);
        $file_name = $_FILES["file"]["name"][$i];
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["file"]["tmp_name"][$i]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error_msg .= "$file_name is not an image.";
            $uploadOk = 0;
            continue;
        }


        // Check if file already exists
        if (file_exists($target_file)) {
            $error_msg .= "Sorry,$file_name already exists!!!<br/>";
            $uploadOk = 0;
            continue;
        }

        // Check file size
        if ($_FILES["file"]["size"][$i] > (5 * 1024 * 1024)) {
            $error_msg .= "Sorry, $file_name is too large!!!<br/>";
            $uploadOk = 0;
            continue;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $error_msg .= "Sorry, $file_name is not allowed!!!<br/>";
            $uploadOk = 0;
            continue;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error_msg .= "Sorry, $file_name was not uploaded!!!<br/>";
            // if everything is ok, try to upload file
        } else {
            $insert_query = "insert into carousel(img) values('$file_name')";
            $sql = mysqli_query($con, $insert_query);
            if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file) && $sql) {
                echo "1";
            } else {
                $error_msg .= "Sorry, there was an error uploading $file_name!!!<br/>";
            }
        }
    }
    echo $error_msg;

    $con->close();
}

function uploadGalleryImages()
{
    session_start();
    require_once '../security/db-con.php';
    $error_msg = "";
    if (empty($_FILES["file"]["name"])) {
        echo "Please, select a file!!!<br/>";
        exit(0);
    }
    $file_count = count($_FILES['file']['name']);
    if ($file_count > 10) {
        echo "Max 10 images can be selected at once!!!";
        exit(0);
    }

    $target_dir = "../gallery-images/";
    for ($i = 0; $i < $file_count; ++$i) {
        $target_file = $target_dir . basename($_FILES["file"]["name"][$i]);
        $file_name = $_FILES["file"]["name"][$i];
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["file"]["tmp_name"][$i]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error_msg .= "$file_name is not an image.";
            $uploadOk = 0;
            continue;
        }


        // Check if file already exists
        if (file_exists($target_file)) {
            $error_msg .= "Sorry, $file_name already exists!!!<br/>";
            $uploadOk = 0;
            continue;
        }

        // Check file size
        if ($_FILES["file"]["size"][$i] > (5 * 1024 * 1024)) {
            $error_msg .= "Sorry,$file_name is too large!!!<br/>";
            $uploadOk = 0;
            continue;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $error_msg .= "Sorry,$file_name is not allowed!!!<br/>";
            $uploadOk = 0;
            continue;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error_msg .= "Sorry, $file_name was not uploaded!!!<br/>";
            // if everything is ok, try to upload file
        } else {
            $insert_query = "insert into gallery(img_name) values('$file_name')";
            $sql = mysqli_query($con, $insert_query);
            if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file) && $sql) {
                echo "1";
            } else {
                $error_msg .= "Sorry, there was an error uploading $file_name!!!<br/>";
            }
        }
    }
    echo $error_msg;
    $con->close();
}

function addAdmins()
{
    session_start();
    require_once '../security/db-con.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $username = strtolower(mysqli_real_escape_string($con, $_POST['username']));
    $email = strtolower(mysqli_real_escape_string($con, $_POST['email']));
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
    $status =  mysqli_real_escape_string($con, $_POST['status']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    if (empty($username) || empty($email) || empty($mobile) || empty($password) || empty($confirmPassword) || empty($id) || empty($status) || empty($designation)) {
        echo "Fields are empty !";
    } else {
        $pass = password_hash($password, PASSWORD_BCRYPT);

        $token = bin2hex(random_bytes(16));

        $emailQuery = "select * from admins where email ='$email'";
        $query = mysqli_query($con, $emailQuery);
        $emailCount = mysqli_num_rows($query);

        if ($emailCount != 0) {
            echo "This email already exists try with some other email !";
        } else {
            if ($password == $confirmPassword) {
                // $toEmail = "To:$email";
                // $subject = "Email Activation";
                // $body = "Hi $username,Please click this link to activate your account at coolmaths.com\nhttp://localhost/coolmaths/security/activate.php?token=$token";
                // $header = "From:coolmathsofflicial@gmail.com";

                // if (mail($toEmail, $subject, $body, $header)) {
                $insertQuery = "insert into admins(id,username,designation,email, mobile,password,token,status) values('$id','$username', '$designation','$email', '$mobile', '$pass','$token','$status');";
                $iquery = mysqli_query($con, $insertQuery);
                if ($iquery) {
                    echo "1";
                } else {
                    echo "Unable to Register You, Sorry !";
                }
                // } else {
                //     echo "Invalid email !";
                // }
            } else {
                echo "Password and Confirm Password didn't match !";
            }
        }
    }

    $con->close();
}

function addMembers()
{
    session_start();
    require_once '../security/db-con.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $username = strtolower(mysqli_real_escape_string($con, $_POST['username']));
    $email = strtolower(mysqli_real_escape_string($con, $_POST['email']));
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
    $status =  mysqli_real_escape_string($con, $_POST['status']);
    $classId = mysqli_real_escape_string($con, $_POST['classId']);
    if (empty($username) || empty($email) || empty($mobile) || empty($password) || empty($confirmPassword) || empty($id) || empty($status)) {
        echo "Fields are empty !";
    } else {
        $pass = password_hash($password, PASSWORD_BCRYPT);

        $token = bin2hex(random_bytes(16));

        $emailQuery = "select * from members where email ='$email'";
        $query = mysqli_query($con, $emailQuery);
        $emailCount = mysqli_num_rows($query);

        if ($emailCount != 0) {
            echo "This email already exists try with some other email !";
        } else {
            if ($password == $confirmPassword) {
                // $toEmail = "To:$email";
                // $subject = "Email Activation";
                // $body = "Hi $username,Please click this link to activate your account at coolmaths.com\nhttp://localhost/coolmaths/security/activate.php?token=$token";
                // $header = "From:coolmathsofflicial@gmail.com";

                // if (mail($toEmail, $subject, $body, $header)) {
                $insertQuery = "insert into members(id,username,email,mobile,password,token,status,class_id) values('$id','$username', '$email', '$mobile', '$pass','$token','$status','$classId');";
                $iquery = mysqli_query($con, $insertQuery);
                if ($iquery) {
                    echo "1";
                } else {
                    echo "Unable to Register You, Sorry !";
                }
                // } else {
                //     echo "Invalid email !";
                // }
            } else {
                echo "Password and Confirm Password didn't match !";
            }
        }
    }

    $con->close();
}

function addClasses()
{
    session_start();
    require_once '../security/db-con.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $class_name = strtolower(mysqli_real_escape_string($con, $_POST['className']));
    $class_text = strtolower(mysqli_real_escape_string($con, $_POST['classText']));
    $file_name = $_FILES["file"]["name"][0];
    $file_count = count($_FILES["file"]["name"]);
    if ($file_count > 1) {
        echo "Max 1 image can be selected at once!!!";
        exit(0);
    }

    if (empty($class_name) || empty($class_text) || empty($id) || empty($file_name)) {
        echo "Fields are empty !";
    } else {
        $target_dir = "../coolmaths-classes/";
        $target_file = $target_dir . basename($_FILES["file"]["name"][0]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 0;
        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["file"]["tmp_name"][0]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
            exit(0);
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
            exit(0);
        }

        // Check file size
        if ($_FILES["file"]["size"][0] > (5 * 1024 * 1024)) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
            exit(0);
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "Sorry, only this file is allowed!";
            $uploadOk = 0;
            exit(0);
        }
        if ($uploadOk == 1) {
            $selectQuery = "select class from classes where id!={$id} and class='$class_name'";
            $sql = mysqli_query($con, $selectQuery);
            $classCount = mysqli_num_rows($sql);

            if ($classCount != 0) {
                echo "This class already exists!!!";
            } else {
                $insertQuery = "insert into classes(id,class,img,content) values('$id','$class_name', '$file_name', '$class_text');";
                $sql = mysqli_query($con, $insertQuery);
                if (move_uploaded_file($_FILES["file"]["tmp_name"][0], $target_file) && $sql) {
                    echo "1";
                } else {
                    echo "Unable to Register You, Sorry !";
                }
            }
        } else {
            echo "Something went wrong!!!";
        }
    }

    $con->close();
}
