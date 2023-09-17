<?php
if ($_GET['name'] == 'topic') {
    echo selectClassTopic();
    exit(0);
} else if ($_GET['name'] == 'image') {
    echo selectTopicImage();
    exit(0);
} else if ($_GET['name'] == 'video') {
    echo selectTopicVideo();
} else if ($_GET['name'] == 'pdf') {
    echo selectTopicPdf();
    exit(0);
}

function selectClassTopic()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    $select_query = "select * from class_topic where class_id={$id}";
    $sql = mysqli_query($con, $select_query);
    if ($sql) {
        $data = array();
        while ($row = $sql->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo "NO DATA !";
    }

    $con->close();
}

function selectTopicImage()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    $select_query = "select * from topic_img where topic_id={$id}";
    $sql = mysqli_query($con, $select_query);
    if ($sql) {
        $data = array();
        while ($row = $sql->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo "NO DATA !";
    }

    $con->close();
}

function selectTopicVideo()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    $select_query = "select * from topic_vid where topic_id={$id}";
    $sql = mysqli_query($con, $select_query);
    if ($sql) {
        $data = array();
        while ($row = $sql->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo "NO DATA !";
    }

    $con->close();
}

function selectTopicPdf()
{
    session_start();
    require_once '../security/db-con.php';
    $data = stripcslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $id = $mydata['data_id'];
    $select_query = "select * from topic_pdf where topic_id={$id}";
    $sql = mysqli_query($con, $select_query);
    if ($sql) {
        $data = array();
        while ($row = $sql->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo "NO DATA !";
    }

    $con->close();
}
