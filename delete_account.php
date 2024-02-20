<?php
    session_start();

    if (!isset($_SESSION['login_status'])){
        header("Location: routes.php");
    }else{
        if (!$_SESSION['login_status']){
            header("Location: routes.php");
        }
    }

    if (!isset($_SESSION['role'])){
        header("Location: account.php");
    } else {
        if ($_SESSION['role'] != 'passenger'){
            header("Location: account.php");
        }
    }

    $_SESSION["delete_account"] = true ;
?>
<html>
    <head>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="content">
                <div class="header">
                    Confirmation
                </div>
                <div class="item">
                    <p style="padding: 10px;">
                        Are you sure you want to delete your account?
                    </p>
                </div>
                <div id="button">
                    <a href="account.php" id="cancel" class="button bt_cancel">Cancel</a>
                    <a href="delete_account_submit.php" id="submit" class="button bt_delete">Confirm</a>
                </div>
                
            </div>
        </div>
        
    </body>

</html>