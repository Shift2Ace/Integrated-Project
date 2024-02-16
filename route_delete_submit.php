<?php
    ini_set('display_errors',1);
    error_reporting(-1);

    session_start();

    if (!isset($_SESSION['login_status'])){
        header("Location: routes.php");
    }else{
        if (!$_SESSION['login_status']){
            header("Location: routes.php");
        }
    }

    if (!isset($_SESSION['role'])){
        header("Location: routes.php");
    } else {
        if ($_SESSION['role'] != 'driver'){
            header("Location: routes.php");
        }
    }

    if (!isset($_SESSION["delete_route_id"])){
        header("Location: routes.php");
    } else {
        if ($_SESSION["delete_route_id"] == ''){
            header("Location: routes.php");
        }
    }
    
    $delete_route_id = $_SESSION["delete_route_id"];
    $_SESSION["delete_route_id"] = "";
    $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "UPDATE my_route SET route_status = 'cancelled' WHERE route_id = '$delete_route_id'";
    $result = $conn->query($sql);
    header("Location: routes.php");
?>