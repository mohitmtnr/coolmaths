<?php
if ($_GET['name'] == 'gallery') {
    echo selectGalleryImages();
    exit(0);
} else if ($_GET['name'] == 'admin') {
    echo selectAdmins();
    exit(0);
} else if ($_GET['name'] == 'member') {
    echo selectMembers();
    exit(0);
} else if ($_GET['name'] == 'class') {
    echo selectClasses();
    exit(0);
} else if ($_GET["name"] == 'up-admin') {
    echo updateAdmins();
    exit(0);
} else if ($_GET["name"] == 'up-member') {
    echo updateMember();
    exit(0);
} else if ($_GET["name"] == 'up-icon') {
    echo updateIcon();
    exit(0);
} else if ($_GET["name"] == 'up-carousel') {
    echo updateCarousel();
    exit(0);
} else if ($_GET["name"] == 'up-gallery') {
    echo updateGallery();
    exit(0);
} else if ($_GET["name"] == 'up-class') {
    echo updateClasses();
    exit(0);
}
function selectAdmins()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // select operation
    if (!empty($id)) {
        $select_query = "select id,username,designation,email,mobile,status from admins where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if ($sql) {
            $row = $sql->fetch_assoc();
            echo json_encode($row);
        } else {
            echo "Data Cannot be fetched!!!";
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}

function updateAdmins()
{
    session_start();
    require_once '../security/db-con.php';
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $username = strtolower(mysqli_real_escape_string($con, $_POST['username']));
    $email = strtolower(mysqli_real_escape_string($con, $_POST['email']));
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    if (empty($username) || empty($email) || empty($mobile) || empty($id) || empty($status) || empty($designation)) {
        echo "Fields are empty !";
    } else {
        $token = bin2hex(random_bytes(16));
        $emailQuery = "select * from admins where email ='$email' and id !='$id'";
        $query = mysqli_query($con, $emailQuery);
        $emailCount = mysqli_num_rows($query);

        if ($emailCount != 0) {
            echo "This email already exists try with some other email!";
            exit(0);
        }
        // update operation
        if (!empty($id)) {
            $update_query = "update admins set username='$username',designation='$designation',email='$email',mobile='$mobile',status='$status' where id='$id'";
            $sql = mysqli_query($con, $update_query);
            if ($sql) {
                echo "1";
            } else {
                echo "Operation Denied!!!";
            }
        } else {
            echo "No Element Found!!!";
        }
    }
    $con->close();
}
function selectMembers()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // select operation
    if (!empty($id)) {
        $select_query = "select id,username,email,mobile,status from members where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if ($sql) {
            $row = $sql->fetch_assoc();
            echo json_encode($row);
        } else {
            echo "Data Cannot be fetched!!!";
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
function updateMember()
{
    session_start();
    require_once '../security/db-con.php';
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $username = strtolower(mysqli_real_escape_string($con, $_POST['username']));
    $email = strtolower(mysqli_real_escape_string($con, $_POST['email']));
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $classId = mysqli_real_escape_string($con, $_POST['classId']);
    if (empty($username) || empty($email) || empty($mobile) || empty($id) || empty($status)) {
        echo "Fields are empty !";
    } else {
        $token = bin2hex(random_bytes(16));
        $emailQuery = "select * from admins where email ='$email' and id !='$id'";
        $query = mysqli_query($con, $emailQuery);
        $emailCount = mysqli_num_rows($query);

        if ($emailCount != 0) {
            echo "This email already exists try with some other email!";
            exit(0);
        }

        // update operation
        if (!empty($id)) {
            $update_query = "update members set username='$username',email='$email',mobile='$mobile',status='$status',class_id='$classId' where id='$id'";
            $sql = mysqli_query($con, $update_query);
            if ($sql) {
                echo "1";
            } else {
                echo "Operation Denied!!!";
            }
        } else {
            echo "No Element Found!!!";
        }
    }
    $con->close();
}

// to be continued in different way
function updateIcon()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // select operation
    if (!empty($id)) {
        $select_query = "select status from icon where icon_id={$id}";
        $sql = mysqli_query($con, $select_query);
        if ($sql) {
            $row = $sql->fetch_assoc();
            if ($row['status'] == "active") {
                $update_query = "update icon set status='inactive' where icon_id='$id'";
                $sql = mysqli_query($con, $update_query);
                if ($sql) {
                    echo "1";
                } else {

                    echo "Operation Denied!!!";
                }
            } else {
                $select_status_query = "select * from icon where status='active'";
                $sql = mysqli_query($con, $select_status_query);
                if ($sql) {
                    $count = mysqli_num_rows($sql);
                    if ($count > 0) {
                        echo "Only One Icon Can Be Active!!!";
                    } else {
                        $update_query = "update icon set status='active' where icon_id='$id'";
                        $sql = mysqli_query($con, $update_query);
                        if ($sql) {
                            echo "1";
                        } else {

                            echo "Operation Denied!!!";
                        }
                    }
                }
            }
        } else {
            echo "Data Cannot be fetched!!!";
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}

function updateCarousel()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // select operation
    if (!empty($id)) {
        $select_query = "select status from carousel where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if ($sql) {
            $row = $sql->fetch_assoc();
            if ($row['status'] == "active") {
                $update_query = "update carousel set status='inactive' where id='$id'";
                $sql = mysqli_query($con, $update_query);
                if ($sql) {
                    echo "1";
                } else {

                    echo "Operation Denied!!!";
                }
            } else {
                $select_status_query = "select * from carousel where status='active'";
                $sql = mysqli_query($con, $select_status_query);
                if ($sql) {
                    $count = mysqli_num_rows($sql);
                    if ($count > 10) {
                        echo "Only One Icon Can Be Active!!!";
                    } else {
                        $update_query = "update carousel set status='active' where id='$id'";
                        $sql = mysqli_query($con, $update_query);
                        if ($sql) {
                            echo "1";
                        } else {

                            echo "Operation Denied!!!";
                        }
                    }
                }
            }
        } else {
            echo "Data Cannot be fetched!!!";
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
function selectGalleryImages()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // select operation
    if (!empty($id)) {
        $select_query = "select * from gallery where img_id={$id}";
        $sql = mysqli_query($con, $select_query);
        if ($sql) {
            $row = $sql->fetch_assoc();
            echo json_encode($row);
        } else {
            echo "Data Cannot be fetched!!!";
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}
function updateGallery()
{
    session_start();
    require_once '../security/db-con.php';
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $about_img = strtolower(mysqli_real_escape_string($con, $_POST['aboutImage']));
    // select operation
    if (!empty($id)) {
        $update_query = "update gallery set about_img='$about_img' where img_id={$id}";
        $sql = mysqli_query($con, $update_query);
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

function selectClasses()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // select operation
    if (!empty($id)) {
        $select_query = "select * from classes where id=$id";
        $sql = mysqli_query($con, $select_query);
        if ($sql) {
            $row = $sql->fetch_assoc();
            echo json_encode($row);
        } else {
            echo "Data Cannot be fetched!!!";
        }
    } else {
        echo "No Element Found!!!";
    }

    $con->close();
}

function updateClasses()
{
    session_start();
    require_once '../security/db-con.php';
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $class_name = strtolower(mysqli_real_escape_string($con, $_POST['className']));
    $class_text = strtolower(mysqli_real_escape_string($con, $_POST['classText']));
    if (empty($class_name) || empty($class_text) || empty($id)) {
        echo "Fields are empty !";
    } else {
        $classQuery = "select * from classes where class ='$class_name' and id !='$id'";
        $sql = mysqli_query($con, $classQuery);
        $classCount = mysqli_num_rows($sql);

        if ($classCount != 0) {
            echo "This class already exists !!!";
            exit(0);
        }
        // update operation
        if (!empty($id)) {
            $update_query = "update classes set class='$class_name',content='$class_text' where id='$id'";
            $sql = mysqli_query($con, $update_query);
            if ($sql) {
                echo "1";
            } else {
                echo "Operation Denied!!!";
            }
        } else {
            echo "No Element Found!!!";
        }
    }
    $con->close();
}
