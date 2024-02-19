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



    if (!isset($_SESSION["delete_account"])){
        header("Location: account.php");
    } else {
        if (!$_SESSION["delete_account"]){
            header("Location: account.php");
        }
    }
    
    $_SESSION["delete_account"] = false;
    $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "CALL delete_account();";
    $result = $conn->query($sql);
    $conn->close();
    header("Location: logout.php");
?>