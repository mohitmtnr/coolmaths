<?php
if ($_GET['name'] == 'icon') {
    echo showIcon();
    exit(0);
} else if ($_GET['name'] == 'carousel') {
    echo showCarouselImage();
    exit(0);
} else if ($_GET['name'] == 'gallery') {
    echo showGalleryImages();
    exit(0);
} else if ($_GET['name'] == 'admin') {
    echo showAdmins();
    exit(0);
} else if ($_GET['name'] == 'member') {
    echo showMembers();
    exit(0);
} else if ($_GET['name'] == 'class') {
    echo showClasses();
    exit(0);
}

function showAdmins()
{
    session_start();
    require_once '../security/db-con.php';

    $select_query = "select * from admins";
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
function showMembers()
{
    session_start();
    require_once '../security/db-con.php';

    $select_query = "select * from members";
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
function showIcon()
{
    session_start();
    require_once '../security/db-con.php';

    $select_query = "select * from icon";
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
function showCarouselImage()
{
    session_start();
    require_once '../security/db-con.php';

    $select_query = "select * from carousel";
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
function showGalleryImages()
{
    session_start();
    require_once '../security/db-con.php';

    $select_query = "select * from gallery";
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

function showClasses()
{
    session_start();
    require_once '../security/db-con.php';

    $select_query = "select * from classes";
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
