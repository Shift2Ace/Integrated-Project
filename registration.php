<?php
    session_start();
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
        <link rel="stylesheet" href="registration.css">
        <script type="text/javascript" src="registration.js"></script>
        
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="login">
                <div class="header">
                    Create Account
                </div>
                <form action="registration_submit.php" id="ca_form" method="post">
                    <div class="input">
                        <div class="name">User Name</div>
                        <input type="text" id="user_name" name="user_name" required>
                        <br>
                        <br>
                        <div class="name">Age</div>
                        <select id="age" name='age' required></select>
                        <script nonce='rAnd0m'>
                            var select = document.getElementById("age");
                            for (var i = 1; i <= 120; i++) {
                                var option = document.createElement("option");
                                option.value = i;
                                option.text = i;
                                select.appendChild(option);
                            }
                        </script>
                        <br>
                        <br>
                        <div class="name">Gender</div>
                        <select name="gender" id="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <br>
                        <br>
                        <div class="name">Email</div>
                        <input type="email" id="email" name="email" required>
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                    </div>
                    <div class="input">
                        <div class="name">Account Type</div>
                        <select name="role" id="role" required>
                            <option value="passenger">Passenger</option>
                            <option value="driver">Driver</option>
                        </select>
                    </div>
                    <div class="input">
                        <div class="name">Password</div>
                        <input type="password" id="password" name="password" required>
                        <br>
                        <br>
                        <div class="name">Confirm Password</div>
                        <input type="password" id="password_cof" name="password_cof" required>
                    </div>
                    <div id="button">
                        <a id="cancel" href="/login.php" class="button bt_cancel">Cancel</a>
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