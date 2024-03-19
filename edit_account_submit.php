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
    #exit if not from registration.php
    if (!$_POST["user_name"] || !$_POST["age"] || !$_POST["gender"]) {
        header("Location: account.php");
        die();
    }

    #connect
    $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    

    #get data
    $name = $_POST["user_name"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];


        
    #sql add user
    $safeName = mysqli_real_escape_string($conn,$name);
    
    $sql = "UPDATE my_account SET user_name = '$safeName', user_age = $age, user_gender = '$gender' ";
    if ($conn->multi_query($sql)){
        $result = $conn->store_result();
        header("Location: account.php");
    }         

?>