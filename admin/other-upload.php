
<?php
if ($_GET['name'] == 'topic') {
    echo uploadTopics();
    exit(0);
} else if ($_GET['name'] == 'image') {
    echo uploadImages();
    exit(0);
} else if ($_GET['name'] == 'video') {
    echo uploadVideos();
    exit(0);
} else if ($_GET['name'] == 'pdf') {
    echo uploadPdfs();
    exit(0);
} else if ($_GET['name'] == 'service') {
    echo addServices();
    exit(0);
} else if ($_GET['name'] == 'book') {
    echo addBooks();
    exit(0);
} else if ($_GET['name'] == 'product') {
    echo addProducts();
    exit(0);
}
function uploadTopics()
{
    session_start();
    require_once '../security/db-con.php';
    $class_id = mysqli_real_escape_string($con, $_POST['classId']);
    $topic_name = mysqli_real_escape_string($con, $_POST['topicName']);
    if (empty($class_id) || empty($topic_name)) {
        echo "Fields are empty !";
    } else {
        $insertQuery = "insert into class_topic(topic,class_id) values('$topic_name','$class_id');";
        $sql = mysqli_query($con, $insertQuery);
        if ($sql) {
            echo "1";
        } else {
            echo "Unable to upload this topic, Sorry!!!";
        }
    }

    $con->close();
}
function uploadImages()
{
    session_start();
    require_once '../security/db-con.php';
    $error_msg = '';

    $topic_id = strtolower(mysqli_real_escape_string($con, $_POST['topicId']));
    if (empty($_FILES["file"]["name"])) {
        echo "Please, select a file!!!<br/>";
        exit(0);
    }
    $file_count = count($_FILES['file']['name']);
    if ($file_count > 10) {
        echo "Max 10 images can be selected at once!!!";
        exit(0);
    }

    $target_dir = "../coolmaths-classes/class-topic-images/";

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
            $insert_query = "insert into topic_img(img,topic_id) values('$file_name','$topic_id')";
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
function uploadVideos()
{
    session_start();
    require_once '../security/db-con.php';

    $id = mysqli_real_escape_string($con, $_POST['topicId']);
    $url = mysqli_real_escape_string($con, $_POST['videoUrl']);
    if (empty($url) ||  empty($id)) {
        echo "Fields are empty !";
    } else {
        $insertQuery = "insert into topic_vid(link,topic_id) values('$url','$id');";
        $iquery = mysqli_query($con, $insertQuery);
        if ($iquery) {
            echo "1";
        } else {
            echo "Operation Denied!!!";
        }
    }

    $con->close();
}
function uploadPdfs()
{

    session_start();
    require_once '../security/db-con.php';
    $error_msg = '';

    $topic_id = strtolower(mysqli_real_escape_string($con, $_POST['topicId']));
    if (empty($_FILES["file"]["name"])) {
        echo "Please, select a file!!!<br/>";
        exit(0);
    }
    $file_count = count($_FILES['file']['name']);
    if ($file_count > 2) {
        echo "Max 2 pdfs can be selected at once!!!";
        exit(0);
    }

    $target_dir = "../coolmaths-classes/class-topic-pdfs/";

    for ($i = 0; $i < $file_count; ++$i) {
        $target_file = $target_dir . basename($_FILES["file"]["name"][$i]);
        $file_name = $_FILES["file"]["name"][$i];
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            $error_msg .= "Sorry,$file_name already exists!!!<br/>";
            $uploadOk = 0;
            continue;
        }

        // Check file size
        if ($_FILES["file"]["size"][$i] > (20 * 1024 * 1024)) {
            $error_msg .= "Sorry, $file_name is too large!!!<br/>";
            $uploadOk = 0;
            continue;
        }

        // Allow certain file formats
        if (
            $imageFileType != "pdf"
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
            $insert_query = "insert into topic_pdf(link,topic_id) values('$file_name','$topic_id')";
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
function  addServices()
{
    session_start();
    require_once '../security/db-con.php';

    $class_id = mysqli_real_escape_string($con, $_POST['classId']);
    $service_name = strtolower(mysqli_real_escape_string($con, $_POST['serviceName']));
    $link = mysqli_real_escape_string($con, $_POST['serviceUrl']);
    $file_name = $_FILES["file"]["name"][0];
    $file_count = count($_FILES["file"]["name"]);
    if ($file_count > 1) {
        echo "Max 1 image can be selected at once!!!";
        exit(0);
    }

    if (empty($service_name) || empty($class_id) || empty($file_name) || empty($link)) {
        echo "Fields are empty !";
    } else {
        $target_dir = "../services/";
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
            $selectQuery = "select name from services where class_id!={$class_id} and name='$service_name'";
            $sql = mysqli_query($con, $selectQuery);
            $bookCount = mysqli_num_rows($sql);

            if ($bookCount != 0) {
                echo "This class already exists!!!";
            } else {
                $insertQuery = "insert into services(img,name,link,status,class_id,time) values('$file_name','$service_name','$link','inactive','$class_id',current_timestamp());";
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
function addBooks()
{
    session_start();
    require_once '../security/db-con.php';

    $class_id = mysqli_real_escape_string($con, $_POST['classId']);
    $book_name = strtolower(mysqli_real_escape_string($con, $_POST['bookName']));
    $book_text = strtolower(mysqli_real_escape_string($con, $_POST['bookText']));
    $link = mysqli_real_escape_string($con, $_POST['bookUrl']);
    $file_name = $_FILES["file"]["name"][0];
    $file_count = count($_FILES["file"]["name"]);
    if ($file_count > 1) {
        echo "Max 1 image can be selected at once!!!";
        exit(0);
    }

    if (empty($book_name) || empty($book_text) || empty($class_id) || empty($file_name) || empty($link)) {
        echo "Fields are empty !";
    } else {
        $target_dir = "../books/";
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
            $selectQuery = "select name from books where class_id!={$class_id} and name='$book_name'";
            $sql = mysqli_query($con, $selectQuery);
            $bookCount = mysqli_num_rows($sql);

            if ($bookCount != 0) {
                echo "This class already exists!!!";
            } else {
                $insertQuery = "insert into books(img,name,content,link,status,class_id,time) values('$file_name','$book_name','$book_text','$link','inactive','$class_id',current_timestamp());";
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
function  addProducts()
{
    session_start();
    require_once '../security/db-con.php';

    $class_id = mysqli_real_escape_string($con, $_POST['classId']);
    $product_name = strtolower(mysqli_real_escape_string($con, $_POST['productName']));
    $product_text = strtolower(mysqli_real_escape_string($con, $_POST['productText']));
    $link = mysqli_real_escape_string($con, $_POST['productUrl']);
    $file_name = $_FILES["file"]["name"][0];
    $file_count = count($_FILES["file"]["name"]);
    if ($file_count > 1) {
        echo "Max 1 image can be selected at once!!!";
        exit(0);
    }

    if (empty($product_name) || empty($product_text) || empty($class_id) || empty($file_name) || empty($link)) {
        echo "Fields are empty !";
    } else {
        $target_dir = "../products/";
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
            $selectQuery = "select name from products where class_id!={$class_id} and name='$product_name'";
            $sql = mysqli_query($con, $selectQuery);
            $bookCount = mysqli_num_rows($sql);

            if ($bookCount != 0) {
                echo "This class already exists!!!";
            } else {
                $insertQuery = "insert into products(img,name,about,link,status,class_id,time) values('$file_name','$product_name','$product_text','$link','inactive','$class_id',current_timestamp());";
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
