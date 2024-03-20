<?php
    session_start();
    function generateToken() {
        return bin2hex(random_bytes(32));
    }
    function verifyToken($userToken) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $userToken);
    }
    if (!verifyToken($_POST['csrf_token'])) {
        die('CSRF token validation failed');
    }
    $s_user_ip = $_SERVER ['REMOTE_ADDR'];
    $login_check = 0;

    #exit if not from login.php
    if (!$_POST["email"] || !$_POST["password"]) {
        header("Location: login.php");
        die();
    }

    #connect
    $conn = mysqli_connect("localhost", "default", "default", "webserver",3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    

    $sql = "SELECT COUNT(*) FROM login_log WHERE login_ip = '$s_user_ip' AND login_time >= NOW()- INTERVAL 5 MINUTE;";
    if ($conn->multi_query($sql)){
        $result = $conn->store_result();
        if ($result) {
            $row = $result->fetch_assoc();
            $login_check =  $row["COUNT(*)"];
            $result->free();
        }
    }
    do {
        $conn->use_result();
    } while ($conn->more_results() && $conn->next_result());
    if ($login_check > 5) {
        echo "<script nonce='rAnd0m'>";
        $message = ("The number of logins has reached the limit. Try later.");
        echo "window.location = 'login.php?ms=$message';";
        echo "</script>";
    } else {
        #get data
        $email = $_POST["email"];
        $safeEmail = mysqli_real_escape_string($conn, $email);
        $password = $_POST["password"];
        $safePassword = mysqli_real_escape_string($conn, $password);
        $s_user_ip = $_SERVER ['REMOTE_ADDR'];
        $session_id = session_create_id("myprefix-");


        $sql = "CALL login_by_password('$safeEmail','$safePassword','$s_user_ip','$session_id');";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                #set to cookie
                setcookie("user_id", $row["uid"],time() + (10 * 365 * 24 * 60 * 60));
                setcookie("s_id", $row["sid"],time() + (10 * 365 * 24 * 60 * 60));
            }
            do {
                $conn->use_result();
            } while ($conn->more_results() && $conn->next_result());
            #delete record of login
            $sql = "DELETE FROM login_log WHERE login_ip = '$s_user_ip'";
            $result = $conn->query($sql);
            $conn->close();
            header("Location: routes.php");
        } else {
            #add record of login
            $sql = "INSERT INTO login_log (login_ip, login_time) VALUES ('$s_user_ip',NOW());";
            $result = $conn->query($sql);
            $conn->close();
            echo "<script nonce='rAnd0m'>";
            $message = ("User ID or password incorrect.");
            echo "window.location = 'login.php?ms=$message';";
            echo "</script>";
        }
    }
    


?>