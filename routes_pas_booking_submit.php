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

    if (!isset($_SESSION["booking_route_id"])){
        header("Location: routes.php");
    } else {
        if ($_SESSION["booking_route_id"] == ''){
            header("Location: routes.php");
        }
    }
    
    $booking_route_id = $_SESSION["booking_route_id"];
    $_SESSION["booking_route_id"] = "";
    $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "CALL create_booking($booking_route_id)";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            switch ($row['result']){
                case "0":
                    echo "<script>";
                    echo "alert('Successfully');";
                    echo "window.location = 'registration.php';";
                    echo "</script>";
                    break;
                case "1":
                    echo "<script>";
                    echo "alert('This route is full');";
                    echo "window.location = 'registration.php';";
                    echo "</script>";
                    break;
                case "2":
                    echo "<script>";
                    echo "alert('You have already booked');";
                    echo "window.location = 'registration.php';";
                    echo "</script>";
                    break;
            }
        }
      } 

?>