<?php
    ini_set('display_errors',1);
    error_reporting(-1);

    session_start();
    if (isset($_GET["bk"])){
        $booking_id_input = $_GET["bk"];
    } else {
        header("Location: routes.php");
    }

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
    $_SESSION["delete_booking_id"] = "";

    #connect
    $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT my_booking.booking_id, my_booking.route_id, my_booking.route_date, my_booking.route_time, my_booking.route_start, my_booking.route_end, my_booking.route_car, my_booking.route_description, my_booking.route_price, my_booking.route_status FROM my_booking WHERE my_booking.booking_id = '$booking_id_input' AND my_booking.route_status = 'active'";
    if ($conn->multi_query($sql)){
        $result = $conn->store_result();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $booking_id = $row["booking_id"];
                $route_id = $row["route_id"];
                $route_date = $row["route_date"];
                $route_time = $row["route_time"];
                $route_start = $row["route_start"];
                $route_end = $row["route_end"];
                $route_price = $row["route_price"];
                $route_description = $row["route_description"];
                $route_car = $row["route_car"];
            }
            $result->free();
            $_SESSION["delete_booking_id"] =  $booking_id;
        } else {
            header("Location: routes.php");
        }
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="content">
                <div class="header">
                    Confirmation
                </div>
                <div class="item">
                    <table>
                        <tr>
                            <td>Booking ID</td>
                            <td> : </td>
                            <td><?php echo "$booking_id" ?></td>
                        </tr>
                        <tr>
                            <td>Route ID</td>
                            <td> : </td>
                            <td><?php echo "$route_id" ?></td>
                        </tr>
                        <tr>
                            <td>Starting Location</td>
                            <td> : </td>
                            <td><?php echo "$route_start" ?></td>
                        </tr>
                        <tr>
                            <td>Destination</td>
                            <td> : </td>
                            <td><?php echo "$route_end" ?></td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td> : </td>
                            <td><?php echo "$route_date" ?></td>
                        </tr>
                        <tr>
                            <td>Time</td>
                            <td> : </td>
                            <td><?php echo "$route_time" ?></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td> : </td>
                            <td><?php echo "$route_price" ?></td>
                        </tr>
                    </table>
                </div>
                <div id="button">
                    <a href="routes_pas_booked.php" id="cancel" class="button bt_cancel">Cancel</a>
                    <a href="routes_booking_cancel_submit.php" id="submit" class="button bt_delete">Remove</a>
                </div>
                
            </div>
        </div>
        
    </body>

</html>