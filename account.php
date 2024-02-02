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
    
    $user_id = '';
    $user_email = '';
    $user_name = '';
    $user_gender = '';
    $user_age = '';
    $user_role = '';

    $icon_id = '';
    $icon_path = '';

    $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
    $sql = "SELECT * FROM my_account";

    if ($conn->multi_query($sql)){
        $result = $conn->store_result();
        if ($result) {
            $row = $result->fetch_assoc();
            $user_id =  $row["user_id"];
            $user_email =  $row["user_email"];
            $user_name =  $row["user_name"];
            $user_gender =  $row["user_gender"];
            $user_age =  $row["user_age"];
            $user_role =  $row["user_role"];
            $result->free();
        }
    }

    do {
        $conn->use_result();
    } while ($conn->more_results() && $conn->next_result());


    $sql = "CALL get_icon($user_id);";
    if ($conn->multi_query($sql)){
        $result = $conn->store_result();
        if ($result) {
            $row = $result->fetch_assoc();
            $icon_id =  $row["result"];
            $result->free();
        }
    }

    #get icon file path
    $dir = "icon";
    $pattern = "$icon_id*.*";
    $files = glob($dir . "/" . $pattern);
    if (count($files) > 0) {
        // Get the first file
        $icon_path = $files[0];
        
    }
 

?>

<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <style>
            .cl1 {
                width: 50px;
            }
            .cl2 {
                width: 50%;
            }
            .item {
                min-width: 300px;
            }
            div#icon {
                height: auto;
                min-width: 30px;
                background-image: url(image/edit.jpg);
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                margin: 5px;
                height: 150px;
                width: 150px;
                border-radius: 6px;
                
            }

            div#icon img {
                height: 150px;
                width: 150px;
                border-radius: 6px;
                background-color: #333;
                object-fit: cover;
                object-position: center;
            }

            div#icon img:hover {
                opacity: 0.3;
            }
        </style>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="content">
                <div class="header">
                    My Account
                </div>
                <div style="display: flex; ">
                    <a href="edit_icon.php">
                        <div id="icon">
                            <img src="<?php echo($icon_path) ?>">
                        </div>
                    </a>
                    <div class="item">
                        <table>
                            <tr>
                                <td>User ID</td>
                                <td> : </td>
                                <td><?php echo($user_id) ?></td>
                            </tr>
                            <tr>
                                <td>User Name</td>
                                <td> : </td>
                                <td><?php echo($user_name) ?></td>
                            </tr>
                            <tr>
                                <td>Age</td>
                                <td> : </td>
                                <td><?php echo($user_age) ?></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td> : </td>
                                <td>
                                    <?php echo($user_gender) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> : </td>
                                <td><?php echo($user_email) ?></td>
                            </tr>
                            
                            <tr>
                                <td>Account Type</td>
                                <td> : </td>
                                <td>
                                    <?php echo($user_role) ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="item">
                    <a href="editAc.php" class="bt_text">Edit account</a>
                    <br>
                    <a href="resetPassword.php" class="bt_text">Reset password</a>
                    <br>
                    <br>
                    <a href="deleteAc.php" class="bt_text_red">Delete account</a>
                </div>
            </div>
        </div>
    </body>
</html>