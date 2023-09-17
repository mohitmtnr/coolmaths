<?php
if ($_GET['name'] == "up-topic") {
    updateTopic();
} else if ($_GET['name'] == "topic") {
    showTopic();
} else if ($_GET['name'] == "up-book") {
    updateBook();
} else if ($_GET['name'] == "up-product") {
    updateProduct();
} else if ($_GET['name'] == "up-service") {
    updateService();
}


function updateTopic()
{
    session_start();
    require_once '../security/db-con.php';
    $id = mysqli_real_escape_string($con, $_POST['classId']);
    $topic_name = strtolower(mysqli_real_escape_string($con, $_POST['topicName']));
    if (empty($topic_name) || empty($id)) {
        echo "Fields are empty !";
    } else {
        // update operation
        if (!empty($id)) {
            $update_query = "update class_topic set topic='$topic_name' where id='$id'";
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

function showTopic()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // select operation
    if (!empty($id)) {
        $select_query = "select topic, id from class_topic where id={$id}";
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

function updateBook()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // select operation
    if (!empty($id)) {
        $select_query = "select status from books where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if ($sql) {
            $row = $sql->fetch_assoc();
            if ($row['status'] == "active") {
                $update_query = "update books set status='inactive' where id='$id'";
                $sql = mysqli_query($con, $update_query);
                if ($sql) {
                    echo "1";
                } else {

                    echo "Operation Denied!!!";
                }
            } else {
                $update_query = "update books set status='active' where id='$id'";
                $sql = mysqli_query($con, $update_query);
                if ($sql) {
                    echo "1";
                } else {

                    echo "Operation Denied!!!";
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

function updateProduct()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // select operation
    if (!empty($id)) {
        $select_query = "select status from products where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if ($sql) {
            $row = $sql->fetch_assoc();
            if ($row['status'] == "active") {
                $update_query = "update products set status='inactive' where id='$id'";
                $sql = mysqli_query($con, $update_query);
                if ($sql) {
                    echo "1";
                } else {

                    echo "Operation Denied!!!";
                }
            } else {
                $update_query = "update products set status='active' where id='$id'";
                $sql = mysqli_query($con, $update_query);
                if ($sql) {
                    echo "1";
                } else {

                    echo "Operation Denied!!!";
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

function updateService()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    // select operation
    if (!empty($id)) {
        $select_query = "select status from services where id={$id}";
        $sql = mysqli_query($con, $select_query);
        if ($sql) {
            $row = $sql->fetch_assoc();
            if ($row['status'] == "active") {
                $update_query = "update services set status='inactive' where id='$id'";
                $sql = mysqli_query($con, $update_query);
                if ($sql) {
                    echo "1";
                } else {

                    echo "Operation Denied!!!";
                }
            } else {
                $update_query = "update services set status='active' where id='$id'";
                $sql = mysqli_query($con, $update_query);
                if ($sql) {
                    echo "1";
                } else {

                    echo "Operation Denied!!!";
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
