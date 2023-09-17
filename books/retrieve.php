<?php
session_start();
require_once '../security/db-con.php';
$data = stripcslashes(file_get_contents("php://input"));
$mydata = json_decode($data, true);
$null = null;
$id = $mydata['data_id'];
$select_query = "select * from books where class_id={$id} and link!='$null'";
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
