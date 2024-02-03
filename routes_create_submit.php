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

    #get data
    $date = $_POST['date'];
    $time = $_POST['time'];
    $start = $_POST['start_region'].','.$_POST['start_district'].','.$_POST['start_street'];
    $end = $_POST['end_region'].','.$_POST['end_district'].','.$_POST['end_street'];
    $car = $_POST['car'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $description = $_POST['description'];


    if (strtotime($date) < time()) {
        $console = "Invalid Date";
        echo "<script>alert('$console');</script>";
        echo "<script>window.location = 'routes_create.php';</script>";
    }else {
        $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
        $sql = "CALL create_route('$date', '$time', '$start', '$end', '$car', $capacity, $price, '$description')";
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $result = $conn->query($sql);
        $conn -> close();

        if ($result){
            header('Location: routes_dri.php');
        }
    }
?>