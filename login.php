<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <style>
            #submit {
                background-color: #6fb;
                font-size: 20px;
                border: 0;
                border-radius: 4px;
                padding: 5px;
            }
            #submit:hover {
                background-color: #0f8;
            }
            #button {
                margin-top: 20px;
                text-align: right;
            }
            form {
                margin: 0;
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
                    <a href="registration.php">Create account</a>
                    <div id="button">
                        <button type="submit" id="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
        
    </body>

</html>