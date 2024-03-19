<?php
    session_start();
    if (isset($_SESSION['login_status'])){
        if ($_SESSION['login_status']){
            header("Location: routes.php");
        }
    }
    function generateToken() {
        return bin2hex(random_bytes(32));
    }
    function verifyToken($userToken) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $userToken);
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = generateToken();
    }
?>
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
            #message {
                color: red;
                background-color: #FFA5A5;
                padding: 5px;
                border-radius: 5px;
                margin: 2px;
                margin-bottom: 5px;
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
                    <?php 
                        if ($_GET["ms"]){
                            $output_message = str_replace('+', ' ', urlencode($_GET["ms"]));
                            echo ("<div id='message'>$output_message</div>");
                        }
                    ?>
                    
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
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                        <button type="submit" id="submit" class="button bt_apply">Login</button>
                    </div>
                </form>
            </div>
        </div>
        
    </body>

</html>