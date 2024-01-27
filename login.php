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
                <form>
                    <div class="input">
                        <div class="name">Email</div>
                        <input type="email">
                    </div>
                    <div class="input">
                        <div class="name">Password</div>
                        <input type="password">
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