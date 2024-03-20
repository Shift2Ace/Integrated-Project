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
        <link rel="stylesheet" href="header.css">

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
                            echo("<li id='log'><a href='logout.php'>logout</a></li>");
                        } else {
                            echo("<li id='log'><a href='login.php'>login</a></li>");
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div id="h_space">

        </div>
        
    </body>
</html>