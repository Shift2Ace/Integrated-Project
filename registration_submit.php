<?php
    ini_set('display_errors',1);
    error_reporting(-1);

    #exit if not from registration.php
    if (!$_POST["user_name"] || !$_POST["age"] || !$_POST["gender"] || !$_POST["email"] || !$_POST["role"] || !$_POST["password"]) {
        header("Location: registration.php");
        die();
    }

    #connect
    $conn = mysqli_connect("localhost", "default", "default", "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    

    #get data
    $name = $_POST["user_name"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = $_POST["password"];

    
    $email_check = 1;
    $user_id = 0;
    $db_psw = '';

    #sql check email
    $sql = "CALL check_email('$email');";
    if ($conn->multi_query($sql)){
        $result = $conn->store_result();
        if ($result) {
            $row = $result->fetch_assoc();
            $email_check =  $row["COUNT(*)"];
            $result->free();
        }
    }
    do {
        $conn->use_result();
    } while ($conn->more_results() && $conn->next_result());
    


    if ($email_check >= 1){
        $conn->close();
        echo "<script>";
        echo "alert('Your email has been used');";
        echo "window.location = 'registration.php';";
        echo "</script>";
    }else if ($email_check == 0) {
        try {
            #sql add user
            $sql = "CALL create_account('$name','$email','$gender',$age,'$role','$password');";
            if ($conn->multi_query($sql)){
                $result = $conn->store_result();
                $email_check = 1;
                if ($result) {
                    $row = $result->fetch_assoc();
                    $db_psw =  $row["(psw_db)"];
                    $result->free();
                }
            }

            do {
                $conn->use_result();
            } while ($conn->more_results() && $conn->next_result());

            #sql get user id
            $sql = "CALL get_id('$email');";
            if ($conn->multi_query($sql)){
                $result = $conn->store_result();
                if ($result) {
                    $row = $result->fetch_assoc();
                    $user_id =  $row["user_id"];
                    $result->free();
                }
            }
            
            do {
                $conn->use_result();
            } while ($conn->more_results() && $conn->next_result());

            #sql create database account
            $sql = "CREATE USER '$user_id' IDENTIFIED BY '$db_psw';";
            if ($conn->multi_query($sql)){
                $result = $conn->store_result();
                if ($result) {
                    $result->free();
                }
            }

            do {
                $conn->use_result();
            } while ($conn->more_results() && $conn->next_result());

            #sql grant role
            $sql = "GRANT $role TO '$user_id';";
            if ($conn->multi_query($sql)){
                $result = $conn->store_result();
                if ($result) {
                    $result->free();
                }
            }

            do {
                $conn->use_result();
            } while ($conn->more_results() && $conn->next_result());

            #sql set default role
            $sql = "SET DEFAULT ROLE $role TO '$user_id';";
            if ($conn->multi_query($sql)){
                $result = $conn->store_result();
                if ($result) {
                    $result->free();
                }
            }

            $conn->close();
            echo "<script>";
            echo "alert('Successfully');";
            echo "window.location = 'login.php';";
            echo "</script>";

        }catch (Exception $e){
            $conn->close();
            echo "<script>";
            echo "alert('Failed: $e');";
            echo "window.location = 'registration.php';";
            echo "</script>";
        }
    }
?>