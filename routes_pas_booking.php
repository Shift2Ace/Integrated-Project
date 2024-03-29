<?php
    session_start();
    $route_id = "";
    if (isset($_GET["id"])){
        $route_id_input = $_GET["id"];
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

    #connect
    $conn = mysqli_connect("localhost", "default", "default", "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT route_list.route_id, route_list.route_date, route_list.route_time, route_list.route_start, route_list.route_end, route_list.route_car, route_list.route_description, route_list.route_price,route_list.route_capacity, route_booking_count.booking_count, route_list.route_status, route_list.driver_id, route_list.driver_name, route_list.driver_email FROM route_list, route_booking_count WHERE route_list.route_id = route_booking_count.route_id AND route_list.route_id = '$route_id_input' AND route_list.route_status = 'active';";
    if ($conn->multi_query($sql)){
        $result = $conn->store_result();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $route_id = $row["route_id"];
                $route_date = $row["route_date"];
                $route_time = $row["route_time"];
                $route_start = $row["route_start"];
                $route_end = $row["route_end"];
                $booking_count = $row["booking_count"];
                $route_capacity = $row["route_capacity"];
                $route_price = $row["route_price"];
                $route_description = $row["route_description"];
                $driver_name = $row["driver_name"];
                $driver_email = $row["driver_email"];
                $route_car = $row["route_car"];
                $driver_id = $row["driver_id"];
            }
            $result->free();
        } else {
            header("Location: routes.php");
        }
    }

    $_SESSION["booking_route_id"] =  $route_id;
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
                    <a href="routes_detail.php?id=<?php echo $route_id ?>" id="cancel" class="button bt_cancel">Cancel</a>
                    <a href="routes_pas_booking_submit.php" id="submit" class="button bt_apply">Confirm</a>
                </div>
                
            </div>
        </div>
        
    </body>

</html>