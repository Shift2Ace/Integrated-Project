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

    $_SESSION["delete_account"] = false ;
    
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
    $imageFound = false;
    $iconFolderPath = '/../icon/';
    foreach (glob($iconFolderPath . $icon_id . '.*') as $file) {
        $fileType = pathinfo($file, PATHINFO_EXTENSION);
        if (in_array($fileType, ['jpg', 'jpeg'])) { // Add or remove file types as needed
            // Found the image file, now you can use it in your webpage
            $relativePathForWeb = str_replace($_SERVER['DOCUMENT_ROOT'], '', $file);
            $imageFound = true;
            break;
        }
    }
    if (!$imageFound) {
        $relativePathForWeb = "image.php?img=$icon_id.png";
    }



?>

<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="account.css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="content">
                <div class="header">
                    My Account
                </div>
                <div id="c1">
                    <a href="edit_icon.php">
                        <div id="icon">
                            <img src="image.php?img=<?php echo $icon_id ?>" />
                            
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
                    <a href="edit_account.php" class="bt_text">Edit account</a>
                    <br>
                    <a href="change_psw.php" class="bt_text">Change password</a>
                    
                    <?php 
                    if (isset($_SESSION['role'])){
                        if ($_SESSION['role'] == 'passenger'){
                            echo "<br>
                            <br><a href='delete_account.php' class='bt_text_red'>Delete account</a>";
                        }
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </body>
</html>