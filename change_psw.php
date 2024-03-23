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
        <link rel="stylesheet" href="change_psw.css">
        <script type="text/javascript" src="change_psw.js"></script>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="login">
                <div class="header">
                    Change Password
                </div>
                <form action="change_psw_submit.php" id="cp_form" method="post">
                    <div class="input">
                        <div class="name">Old Password</div>
                        <input type="password" id="password_old" name="password_old" required>
                    </div>
                    <div class="input">
                        <div class="name">New Password</div>
                        <input type="password" id="password_new" name="password_new" required>
                        <br>
                        <br>
                        <div class="name">Confirm Password</div>
                        <input type="password" id="password_cof" name="password_cof" required>
                    </div>

                    <div id="button">
                        <a id="cancel" href="account.php" class="button bt_cancel">Cancel</a>
                        <button type="button" id="submit_bt" class="button bt_apply">Apply</button>
                        <script nonce="rAnd0m">
                            document.getElementById("submit_bt").addEventListener("click", check);
                        </script>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>