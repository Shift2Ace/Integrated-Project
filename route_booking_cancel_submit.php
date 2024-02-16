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
        if ($_SESSION['role'] != 'passenger'){
            header("Location: routes.php");
        }
    }

    if (!isset($_SESSION["delete_booking_id"])){
        header("Location: routes.php");
    } else {
        if ($_SESSION["delete_booking_id"] == ''){
            header("Location: routes.php");
        }
    }
    
    $delete_booking_id = $_SESSION["delete_booking_id"];
    $_SESSION["delete_booking_id"] = "";
    $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $user_id = $_SESSION['user_id'];
    $sql = "DELETE FROM booking WHERE booking_id = '$delete_booking_id' ";
    $result = $conn->query($sql);
    header("Location: routes_pas_booked.php");
?>