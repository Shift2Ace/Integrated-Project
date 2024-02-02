<?php

    ini_set('display_errors',1);
    error_reporting(-1);

    session_start();

    #exit if not from registration.php
    if (!$_POST["email"] || !$_POST["password"]) {
        header("Location: login.php");
        die();
    }

    #connect
    $conn = mysqli_connect("localhost", "default", "default", "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    #get data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $s_user_ip = $_SERVER ['REMOTE_ADDR'];
    $session_id = session_create_id("myprefix-");


    $sql = "CALL login_by_password('$email','$password','$s_user_ip','$session_id');";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                #set to cookie
                setcookie("user_id", $row["uid"],time() + (10 * 365 * 24 * 60 * 60));
                setcookie("s_id", $row["sid"],time() + (10 * 365 * 24 * 60 * 60));
            }
            $conn->close();
            header("Location: routes.php");
        } else {
            $conn->close();
            echo "<script>";
            echo "alert('Login Failed');";
            echo "window.location = 'login.php';";
            echo "</script>";
        }


?>