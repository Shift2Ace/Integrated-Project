<?php
    session_start();
    if (!isset($_SESSION['login_status'])){
        header("Location: routes.php");
    }else{
        if (!$_SESSION['login_status']){
            header("Location: routes.php");
        }
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <style>
            form {
                margin: 0;
            }

            form div.input input, form div.input select{
                border-bottom: 0px solid;
            }
            
        </style>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="login">
                <div class="header">
                    Edit Icon
                </div>
                <form action="edit_icon_submit.php" method="post" enctype="multipart/form-data">
                    <div class="input">
                        <div class="name">File (Max: 10MB)</div>
                        <input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg,.jpeg,.png" required>
                    </div>
                    <div id="button">
                        <button type="submit" id="submit" class="button bt_apply">submit</button>
                    </div>
                </form>
            </div>
        </div>
        
    </body>

</html>