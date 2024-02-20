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
            br {
                height: 1px;
            }
            form div.input input, form div.input select{
                border-bottom: 1px solid #888;
            }
        </style>
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
                        <button type="button" id="submit_bt" class="button bt_apply" onclick="check()">Apply</button>
                        <script>
                            function check() {
                                var old_psw = document.getElementById('password_old').value;
                                var psw1 = document.getElementById('password_new').value;
                                var psw2 = document.getElementById('password_cof').value;

                                // check if the password is at least 8 characters long
                                if (psw1.length < 8) { // if the password is shorter than 8 characters
                                    alert("The password is too short. It should be at least 8 characters long."); // show an alert message
                                    return; // stop the function
                                }else if (old_psw == psw1) { // if the passwords are not equal
                                    alert("The passwords is same."); // show an alert message
                                    return; // stop the function
                                }else if (psw1 != psw2) { // if the passwords are not equal
                                    alert("The passwords do not match."); // show an alert message
                                    return; // stop the function
                                }else {
                                    document.getElementById('cp_form').submit();
                                    console.log('Form submitted')
                                }
                            }
                        </script>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>