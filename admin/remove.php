<?php
if ($_GET['name'] == 'icon') {
    echo removeIcon();
    exit(0);
} else if ($_GET['name'] == 'carousel') {
    echo removeCarouselImage();
    exit(0);
} else if ($_GET['name'] == 'gallery') {
    echo removeGalleryImages();
    exit(0);
} else if ($_GET['name'] == 'admin') {
    echo removeAdmins();
    exit(0);
} else if ($_GET['name'] == 'member') {
    echo removeMembers();
    exit(0);
} else if ($_GET['name'] == 'class') {
    echo removeClasses();
    exit(0);
}
function removeAdmins()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // delete operation
    if (!empty($id)) {
        $select_query = "select * from admins where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if (!$sql) {
            echo "Operation Denied!!!";
        } else {
            $image_name = mysqli_fetch_assoc($sql)['img'];
            $target_dir = "../user-profile/";
            //get image path
            $imageUrl = $target_dir . $image_name;
            //check if image exists
            if (file_exists($imageUrl)) {
                if (strcmp("default-user-profile.png", $image_name)) {
                    unlink($imageUrl);
                }
                // if ($imge_name != "default-user-profile.png") {
                //     unlink($imageUrl);
                // }
                $delete_query = "delete from admins where id={$id}";
                $sql = mysqli_query($con, $delete_query);
                if ($sql) {
                    echo "1";
                } else {
                    echo "Operation Denied!!!";
                }
            } else {
                echo "File do not exit!!!";
            }
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
function removeMembers()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // delete operation
    if (!empty($id)) {
        $select_query = "select * from members where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if (!$sql) {
            echo "Operation Denied!!!";
        } else {
            $image_name = mysqli_fetch_assoc($sql)['img'];


            $target_dir = "../user-profile/";
            //get image path
            $imageUrl = $target_dir . $image_name;
            //check if image exists
            if (file_exists($imageUrl)) {
                if (strcmp("default-user-profile.png", $image_name)) {
                    unlink($imageUrl);
                }
                $delete_query = "delete from members where id={$id}";
                $sql = mysqli_query($con, $delete_query);
                if ($sql) {
                    echo "1";
                } else {
                    echo "Operation Denied!!!";
                }
            } else {
                echo "File do not exist!!!";
                exit(0);
            }
        }
    } else {
        echo "No Element Found!!!";
    }
    $con->close();
}
function removeIcon()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // delete operation
    if (!empty($id)) {
        $select_query = "select * from icon where icon_id={$id}";
        $sql = mysqli_query($con, $select_query);
        if (!$sql) {
            echo "Operation Denied!!!";
        } else {
            $image_name = mysqli_fetch_assoc($sql)['icon_name'];


            $target_dir = "../coolmaths-icon/";
            //get image path
            $imageUrl = $target_dir . $image_name;
            //check if image exists
            if (file_exists($imageUrl)) {

                //delete the image
                unlink($imageUrl);

                //after deleting image you can delete the record
                $delete_query = "delete from icon where icon_id={$id}";
                $sql = mysqli_query($con, $delete_query);
                if ($sql) {
                    echo "1";
                } else {
                    echo "Operation Denied!!!";
                }
            } else {
                echo "File do not exit!!!";
            }
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
function removeCarouselImage()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // delete operation
    if (!empty($id)) {
        $select_query = "select * from carousel where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if (!$sql) {
            echo "Operation Denied!!!";
        } else {
            $image_name = mysqli_fetch_assoc($sql)['img'];


            $target_dir = "../carousel-images/";
            //get image path
            $imageUrl = $target_dir . $image_name;
            //check if image exists
            if (file_exists($imageUrl)) {

                //delete the image
                unlink($imageUrl);

                //after deleting image you can delete the record
                $delete_query = "delete from carousel where id={$id}";
                $sql = mysqli_query($con, $delete_query);
                if ($sql) {
                    echo "1";
                } else {
                    echo "Operation Denied!!!";
                }
            } else {
                echo "File do not exist!!!";
            }
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
function removeGalleryImages()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // delete operation
    if (!empty($id)) {
        $select_query = "select * from gallery where img_id={$id}";
        $sql = mysqli_query($con, $select_query);
        if (!$sql) {
            echo "Operation Denied!!!";
        } else {
            $image_name = mysqli_fetch_assoc($sql)['img_name'];
        }
        $target_dir = "../gallery-images/";
        //get image path
        $imageUrl = $target_dir . $image_name;
        //check if image exists
        if (file_exists($imageUrl)) {

            //delete the image
            unlink($imageUrl);

            //after deleting image you can delete the record
            $delete_query = "delete from gallery where img_id={$id}";
            $sql = mysqli_query($con, $delete_query);
            if ($sql) {
                echo "1";
            } else {
                echo "Operation Denied!!!";
            }
        } else {
            echo "File do not exist!!!";
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
function removeClasses()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // delete operation
    if (!empty($id)) {
        $select_query = "select * from classes where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if (!$sql) {
            echo "Operation Denied!!!";
        } else {
            $image_name = mysqli_fetch_assoc($sql)['img'];


            $target_dir = "../coolmaths-classes/";
            //get image path
            $imageUrl = $target_dir . $image_name;
            //check if image exists
            if (file_exists($imageUrl)) {
                if (strcmp("default-class-image.jpg", $image_name)) {
                    unlink($imageUrl);
                }
                $delete_query = "delete from classes where id={$id}";
                $sql = mysqli_query($con, $delete_query);
                if ($sql) {
                    echo "1";
                } else {
                    echo "Operation Denied!!!";
                }
            } else {
                $delete_query = "delete from classes where id={$id}";
                $sql = mysqli_query($con, $delete_query);
                if ($sql) {
                    echo "1";
                } else {
                    echo "Operation Denied!!!";
                }
            }
        }
    } else {
        echo "No Element Found!!!";
    }
    $con->close();
}
