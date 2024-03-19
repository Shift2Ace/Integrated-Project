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
    if (!$_POST["password_old"] || !$_POST["password_new"] || !$_POST["password_cof"]) {
        header("Location: account.php");
        die();
    }

    #connect
    $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    

    #get data
    $password_old = $_POST["password_old"];
    $safePassword_old = mysqli_real_escape_string($conn, $password_old);
    $password_new = $_POST["password_new"];
    $safePassword_new = mysqli_real_escape_string($conn, $password_new);


        
    #sql add user
    $user_id = $_SESSION['user_id'];
    $sql = "Call change_psw('$safePassword_old','$safePassword_new');";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        switch ($row['result']){
            case "0":
                echo "<script>";
                echo "alert('Successfully');";
                echo "window.location = 'account.php';";
                echo "</script>";
                break;
            case "1":
                echo "<script>";
                echo "alert('Wrong password');";
                echo "window.location = 'change_psw.php';";
                echo "</script>";
                break;
        }
        

    }

            

?>