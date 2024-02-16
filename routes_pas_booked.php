<?php
    session_start();

    ini_set('display_errors',1);
    error_reporting(-1);

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

    $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $_SESSION["delete_booking_id"] = "";
?>

<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <style>
            .cl1 {
                width: 100px;
            }
            .cl2 {
                width: 130px;
            }
            .cl3 {
                width: 100px;
            }
            .cl4 {
                width: 300px;
            }
            .cl5 {
                width: auto;
            }
            .cl6 {
                width: 120px;
            }

            .topHeader{
                background-color: #004C99;
                color: #FFF;
                margin: 2px;
                padding: 3px;
                border-radius: 3px;
                display: block;
            }

            .list .topHeader table{
                width: 100%;
                color: #FFF;
            }

            a.detail {
                text-decoration: none;
            }

            div.item:hover {
                background-color: #c8daeb;
            }

        </style>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="list">
                <div class="header">
                    My Order
                </div>
                <div class='topHeader'>
                    <table>
                    <tr>
                        <td class='cl1'>Booking ID</td>
                        <td class='cl1'>Route ID</td>
                        <td class='cl2'>Date</td>
                        <td class='cl3'>Time</td>
                        <td class='cl4'>Start Location</td>
                        <td class='cl5'>End Location</td>
                        <td class='cl6'>Status</td>
                    </tr>
                    </table>
                </div>
                <?php
                    $today = date('Y-m-d');
                    $sql = "SELECT booking_id, route_id, route_date, route_time, route_start, route_end, route_status FROM my_booking;";
                    if ($conn->multi_query($sql)){
                        $result = $conn->store_result();
                        while($row = $result->fetch_assoc()) {
                            $booking_id = $row["booking_id"];
                            $route_id = $row["route_id"];
                            $route_date = $row["route_date"];
                            $route_time = $row["route_time"];
                            $temp_start = $row["route_start"];
                            $temp_end = $row["route_end"];
                            $route_start = explode(",", $temp_start)[1];
                            $route_end = explode(",", $temp_end)[1];
                            $route_status = $row["route_status"];
                            echo "<a href='routes_detail.php?id=$route_id&bk=$booking_id' class='detail'>";
                            echo "<div class='item'>";
                            echo "<table>";
                            echo "<tr>";
                            echo "<td class='cl1'>"."$booking_id"."</td>";
                            echo "<td class='cl1'>"."$route_id"."</td>";
                            echo "<td class='cl2'>"."$route_date"."</td>";
                            echo "<td class='cl3'>"."$route_time"."</td>";
                            echo "<td class='cl4'>"."$route_start"."</td>";
                            echo "<td class='cl5'>"."$route_end"."</td>";
                            if (strtotime($route_date) < strtotime($today)) {
                                echo "<td class='cl6'>Expired</td>";
                            } else {
                                echo "<td class='cl6'>"."$route_status"."</td>";
                            }
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