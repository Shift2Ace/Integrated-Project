<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <style>
            form {
                margin: 0;
            }
            .bt_apply {
                width: 100%;
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
                    Login
                </div>
                <form action="login_submit.php" method="post">
                    <div class="input">
                        <div class="name">Email / ID</div>
                        <input type="text" name="email" required>
                    </div>
                    <div class="input">
                        <div class="name">Password</div>
                        <input type="password" name="password" required>
                    </div>
                    <a href="registration.php" class="bt_text">Create account</a>
                    <div id="button">
                        
                        <button type="submit" id="submit" class="button bt_apply">Login</button>
                    </div>
                </form>
            </div>
        </div>
        
    </body>

</html>