<?php
    session_start();
    

    $_SESSION["booking_route_id"] =  "";
    $_SESSION["delete_route_id"] =  "";


    #connect
    $conn = mysqli_connect("localhost", "default", "default", "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $route_id = "";
    if (isset($_GET["id"])){
        $route_id_input = $_GET["id"];
        $safe_route_id_input = mysqli_real_escape_string($conn, $route_id_input);
    } else {
        header("Location: routes.php");
    }

    $sql = "SELECT route_list.route_id, route_list.route_date, route_list.route_time, route_list.route_start, route_list.route_end, route_list.route_car, route_list.route_description, route_list.route_price,route_list.route_capacity, route_booking_count.booking_count, route_list.route_status, route_list.driver_id, route_list.driver_name, route_list.driver_email, route_list.route_status FROM route_list, route_booking_count WHERE route_list.route_id = route_booking_count.route_id AND route_list.route_id = '$safe_route_id_input';";
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
                $route_status = $row["route_status"];
            }
            $result->free();
        } else {
            header("Location: routes.php");
        }
    }

    do {
        $conn->use_result();
    } while ($conn->more_results() && $conn->next_result());

?>

<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="routes_detail.css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="content" id="d1">
                <div class="header">
                    Detail Information
                </div>
                <div id="d2"> 
                    <div class="item" id="d3">
                        <table>
                            <tr>
                                <td>Route ID</td>
                                <td> : </td>
                                <td><?php echo "$route_id"?></td>
                            </tr>
                            <tr>
                                <td>Starting Location</td>
                                <td> : </td>
                                <td><?php echo "$route_start"?></td>
                            </tr>
                            <tr>
                                <td>Destination</td>
                                <td> : </td>
                                <td><?php echo "$route_end"?></td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td> : </td>
                                <td><?php echo "$route_date"?></td>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <td> : </td>
                                <td><?php echo "$route_time"?></td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td> : </td>
                                <td><?php echo "$route_price"?></td>
                            </tr>
                        </table>
                    </div>
                    <div id="d4">
                        <div class="item" id="d5">
                            <table>
                                <tr>
                                    <td>Driver Name</td>
                                    <td> : </td>
                                    <td><?php echo "$driver_name"?></td>
                                </tr>
                                <tr>
                                    <td>Driver Email</td>
                                    <td> : </td>
                                    <td><?php echo "$driver_email"?></td>
                                </tr>
                                <tr>
                                    <td>Car model</td>
                                    <td> : </td>
                                    <td><?php echo "$route_car"?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="item">
                            <table>
                                <tr>
                                    <td>Number of passenger</td>
                                    <td> : </td>
                                    <td><?php echo "$booking_count / $route_capacity"?></td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                    
                </div>
                <div class="item" id="description">
                    Description <br><br>
                    <?php echo nl2br($route_description)?>
                </div>
                <?php
                    if ($_SESSION['login_status'] && $_SESSION['role']=="driver" && $driver_id == $_SESSION["user_id"]){
                        echo "<h2> Passenger </h2>";
                        echo "<div class='item' id='description'>";
                        echo "<table cellspacing='0'>";
                        $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
                        $sql = "CALL get_passenger($route_id);";
                        
                        echo "<tr>";
                        echo "<td class='cl1 hd'>User ID</td>";
                        echo "<td class='cl2 hd'>User Name</td>";
                        echo "<td class='cl3 hd'>Gender</td>";
                        echo "<td class='cl4 hd'>Age</td>";
                        echo "<td class='cl5 hd'>Email</td>";
                        echo "</tr>";

                        if ($conn->multi_query($sql)){
                            $result = $conn->store_result();
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $user_id = $row["user_id"];
                                    $user_name = $row["user_name"];
                                    $user_gender = $row["user_gender"];
                                    $user_age = $row["user_age"];
                                    $user_email = $row["user_email"];
                                    
                                    echo "<tr>";
                                    echo "<td class='cl1'>"."$user_id"."</td>";
                                    echo "<td class='cl2'>"."$user_name"."</td>";
                                    echo "<td class='cl3'>"."$user_gender"."</td>";
                                    echo "<td class='cl4'>"."$user_age"."</td>";
                                    echo "<td class='cl5'>"."$user_email"."</td>";
                                    echo "</tr>";
                                    
                                }
                                $result->free();
                            }
                        }
                        do {
                            $conn->use_result();
                        } while ($conn->more_results() && $conn->next_result());
                        echo "</table>";
                        echo "</div>";
                    }
                ?> 
                <div id="button">
                    <a id="cancel" href="routes.php" class="button bt_cancel">Cancel</a>
                    <?php
                        if ($route_status == "active"){
                            #book button
                            if ($_SESSION['login_status'] && $_SESSION['role']=="passenger"){
                                $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }
                                $sql = "SELECT * FROM my_booking WHERE route_id = '$route_id';";
                                if ($conn->multi_query($sql)){
                                    $result = $conn->store_result();
                                    if ($result->num_rows > 0) {
                                        if (isset($_GET["bk"])){
                                            $booking_id = $_GET["bk"];
                                            echo "<a href='routes_booking_cancel.php?id=$route_id&bk=$booking_id' id='submit' class='button bt_delete'>Remove</a>";
                                        }
                                        $result->free();
                                    } else {
                                        echo "<a href='routes_pas_booking.php?id=$route_id' id='submit' class='button bt_apply'>Book</a>";
                                    }
                                }
                            }
                            if ($_SESSION['login_status'] && $_SESSION['role']=="driver" && $driver_id == $_SESSION["user_id"]){
                                echo "<a href='route_delete.php?id=$route_id' id='Delete' class='button bt_delete'>Delete</a>";
                            }
                        }
                    ?>
                </div>
                
            </div>
        </div>
        
    </body>

</html>