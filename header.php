<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    
    $s_user_ip = $_SERVER ['REMOTE_ADDR'];


    if (!isset($_SESSION['login_status'])){
        $_SESSION['login_status'] = false;
    }
    
    # if user have session id in cookie & didn't login
    if (isset($_COOKIE["s_id"]) && isset($_COOKIE['user_id']) && $s_user_ip && !$_SESSION['login_status']){

        $conn = mysqli_connect("localhost", "default", "default", "webserver",3306);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $s_id = $_COOKIE['s_id'];
        $u_id = $_COOKIE['user_id'];
        $sql = "CALL login_by_session('$u_id','$s_user_ip','$s_id');";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            #set to session (user id and database password)
            $_SESSION['user_id'] = $row["user_id"];
            $_SESSION['db_psw'] = $row["user_psw_db"];

            $conn->close();


            $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM my_account;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                #set to session (role and login status)
                $_SESSION["role"] = $row["user_role"];
                $_SESSION['login_status'] = true;
            }

        } else {
            #delete cookie
            setcookie("s_id","");
            setcookie("user_id","");
        }
        
        

        
    }
?>


<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="main.css">
        <style>
            div.top {
                text-align: center;
                font-size: 30px;
                font-weight: 900;
                font-family: Georgia, 'Times New Roman', Times, serif;
                background-color: #222;
            }

            div.top a {
                display: block;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                color: #ccc;
            }

            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #333;
                }

            li {
                float: left;
                border-right:1px solid #222;
            }

            li:last-child {
                border-right: none;
            }

            li a {
                display: block;
                color: white;
                text-align: center;
                padding: 15px;
                text-decoration: none;
            }

            li a:hover:not(.active) {
                background-color: #111;
            }

            .active {
                background-color: #04AA6D;
            }
            body {
                margin: 0;
                width: 100%;
            }

            #header {
                width: 100%;
                position: fixed;
                top: 0;
                left: 0;
            }

            #h_space {
                height: 112px;
            }
            
        </style>
    </head>
    <body>
        
        <div id="header">
            <div class="top">
                <a href="routes.php">Ride Sharing System</a>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="routes.php">Routes</a></li>
                    <?php
                        if ($_SESSION['login_status']){
                            if ($_SESSION["role"] == 'passenger'){
                                echo("<li><a href='routes_pas_booked.php'>My Order</a></li>");
                            } elseif ($_SESSION["role"] == 'driver' ){
                                echo("<li><a href='routes_dri.php'>My Routes</a></li>");
                            }
                            echo("<li><a href='account.php'>Account</a></li>");
                            echo("<li style='float:right'><a href='logout.php'>logout</a></li>");
                        } else {
                            echo("<li style='float:right'><a href='login.php'>login</a></li>");
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div id="h_space">

        </div>
        
    </body>
</html>