<?php
    session_start();


    $conn = mysqli_connect("localhost", "default", "default", "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $_SESSION["booking_route_id"] =  "";
    $_SESSION["delete_route_id"] =  "";
    $_SESSION["delete_booking_id"] = "";
    $_SESSION["delete_account"] = false ;
?>

<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="routes.css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="list">
                <div class="header">
                    Routes
                </div>
                <div class='topHeader'>
                    <table>
                    <tr>
                        <td class='cl1'>ID</td>
                        <td class='cl2'>Date</td>
                        <td class='cl3'>Time</td>
                        <td class='cl4'>Start Location</td>
                        <td class='cl5'>End Location</td>
                        <td class='cl6'>Passenger</td>
                        <td class='cl7'>Price (HKD)</td>
                    </tr>
                    </table>
                </div>
                <?php
                    //$sql = "SELECT route_list.route_id, route_list.route_date, route_list.route_time, route_list.route_start, route_list.route_end, route_list.route_car, route_list.route_description, route_list.route_price,route_list.route_capacity, route_booking_count.booking_count, route_list.route_status, route_list.driver_id, route_list.driver_name, route_list.driver_email FROM route_list, route_booking_count WHERE route_list.route_id = route_booking_count.route_id AND route_list.route_status = 'active';";
                    $sql = "SELECT route_list.route_id, route_list.route_date, route_list.route_time, route_list.route_start, route_list.route_end, route_list.route_price,route_list.route_capacity, route_booking_count.booking_count FROM route_list, route_booking_count WHERE route_list.route_id = route_booking_count.route_id AND route_list.route_status = 'active';";
                    if ($conn->multi_query($sql)){
                        $result = $conn->store_result();
                        while($row = $result->fetch_assoc()) {
                            $route_id = $row["route_id"];
                            $route_date = $row["route_date"];
                            $route_time = $row["route_time"];
                            $temp_start = $row["route_start"];
                            $temp_end = $row["route_end"];
                            $route_start = explode(",", $temp_start)[1];
                            $route_end = explode(",", $temp_end)[1];
                            $booking_count = $row["booking_count"];
                            $route_capacity = $row["route_capacity"];
                            $route_price = $row["route_price"];
                            echo "<a href='routes_detail.php?id=$route_id' class='detail'>";
                            echo "<div class='item'>";
                            echo "<table>";
                            echo "<tr>";
                            echo "<td class='cl1'>"."$route_id"."</td>";
                            echo "<td class='cl2'>"."$route_date"."</td>";
                            echo "<td class='cl3'>"."$route_time"."</td>";
                            echo "<td class='cl4'>"."$route_start"."</td>";
                            echo "<td class='cl5'>"."$route_end"."</td>";
                            echo "<td class='cl6'>"."$booking_count/$route_capacity"."</td>";
                            echo "<td class='cl7'>"."$$route_price"."</td>";
                            echo "</tr>";
                            echo "</table>";
                            echo "</div>";
                            echo "</a>";
                        }
                        $result->free();
                    }
                    
                    do {
                        $conn->use_result();
                    } while ($conn->more_results() && $conn->next_result());
                ?>
            </div>
        </div>
    </body>
</html>