<?php
if ($_GET['name'] == 'topic') {
    echo removeTopics();
    exit(0);
} else if ($_GET['name'] == 'image') {
    echo removeImages();
    exit(0);
} else if ($_GET['name'] == 'video') {
    echo removeVideos();
    exit(0);
} else if ($_GET['name'] == 'pdf') {
    echo removePdfs();
    exit(0);
} else if ($_GET['name'] == 'service') {
    echo removeServices();
    exit(0);
} else if ($_GET['name'] == 'book') {
    echo removeBooks();
    exit(0);
} else if ($_GET['name'] == 'product') {
    echo removeProducts();
    exit(0);
}

function removeTopics()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // delete operation
    if (!empty($id)) {
        $delete_query = "delete from class_topic where id={$id};";
        $delete_query .= "delete from topic_img where topic_id={$id};";
        $delete_query .= "delete from topic_vid where topic_id={$id};";
        $delete_query .= "delete from topic_pdf where topic_id={$id};";
        $sql = mysqli_multi_query($con, $delete_query);
        if ($sql) {
            echo "1";
        } else {
            echo "Operation Denied!!!";
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
function removeImages()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // delete operation
    if (!empty($id)) {
        $select_query = "select * from topic_img where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if (!$sql) {
            echo "Operation Denied!!!";
        } else {
            $image_name = mysqli_fetch_assoc($sql)['img'];
            $target_dir = "../coolmaths-classes/class-topic-images/";
            //get image path
            $imageUrl = $target_dir . $image_name;
            //check if image exists
            if (file_exists($imageUrl)) {
                unlink($imageUrl);
            }
            $delete_query = "delete from topic_img where id={$id};";
            $sql = mysqli_multi_query($con, $delete_query);
            if ($sql) {
                echo "1";
            } else {
                echo "Operation Denied!!!";
            }
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
function removeVideos()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // delete operation
    if (!empty($id)) {
        $delete_query = "delete from topic_vid where id={$id};";
        $sql = mysqli_multi_query($con, $delete_query);
        if ($sql) {
            echo "1";
        } else {
            echo "Operation Denied!!!";
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
function removePdfs()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // delete operation
    if (!empty($id)) {
        $select_query = "select * from topic_pdf where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if (!$sql) {
            echo "Operation Denied!!!";
        } else {
            $pdf_name = mysqli_fetch_assoc($sql)['link'];
            $target_dir = "../coolmaths-classes/class-topic-pdfs/";
            //get image path
            $pdfUrl = $target_dir . $pdf_name;
            //check if image exists
            if (file_exists($pdfUrl)) {
                unlink($pdfUrl);
            }
            $delete_query = "delete from topic_pdf where id={$id};";
            $sql = mysqli_multi_query($con, $delete_query);
            if ($sql) {
                echo "1";
            } else {
                echo "Operation Denied!!!";
            }
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
function removeServices()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // delete operation
    if (!empty($id)) {
        $select_query = "select * from services where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if (!$sql) {
            echo "Operation Denied!!!";
        } else {
            $image_name = mysqli_fetch_assoc($sql)['img'];
            $target_dir = "../services/";
            //get image path
            $imageUrl = $target_dir . $image_name;
            //check if image exists
            if (file_exists($imageUrl)) {
                if (strcmp("default-service-image.jpg", $image_name)) {
                    unlink($imageUrl);
                }
            }
            $delete_query = "delete from services where id={$id};";
            $sql = mysqli_multi_query($con, $delete_query);
            if ($sql) {
                echo "1";
            } else {
                echo "Operation Denied!!!";
            }
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
function removeBooks()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // delete operation
    if (!empty($id)) {
        $select_query = "select * from books where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if (!$sql) {
            echo "Operation Denied!!!";
        } else {
            $image_name = mysqli_fetch_assoc($sql)['img'];
            $target_dir = "../books/";
            //get image path
            $imageUrl = $target_dir . $image_name;
            //check if image exists
            if (file_exists($imageUrl)) {
                if (strcmp("default-book-image.jpg", $image_name)) {
                    unlink($imageUrl);
                }
            }
            $delete_query = "delete from books where id={$id};";
            $sql = mysqli_multi_query($con, $delete_query);
            if ($sql) {
                echo "1";
            } else {
                echo "Operation Denied!!!";
            }
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
function removeProducts()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // delete operation
    if (!empty($id)) {
        $select_query = "select * from products where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if (!$sql) {
            echo "Operation Denied!!!";
        } else {
            $image_name = mysqli_fetch_assoc($sql)['img'];
            $target_dir = "../products/";
            //get image path
            $imageUrl = $target_dir . $image_name;
            //check if image exists
            if (file_exists($imageUrl)) {
                if (strcmp("default-product-image.jpg", $image_name)) {
                    unlink($imageUrl);
                }
            }
            $delete_query = "delete from products where id={$id};";
            $sql = mysqli_multi_query($con, $delete_query);
            if ($sql) {
                echo "1";
            } else {
                echo "Operation Denied!!!";
            }
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
