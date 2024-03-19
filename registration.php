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
                        <script>
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
                        <button type="button" id="submit_bt" class="button bt_apply" onclick="check()">Apply</button>
                        
                    </div>
                </form>
                <script>
                    function check() {
                        var email = document.getElementById('email').value;
                        var psw1 = document.getElementById('password').value;
                        var psw2 = document.getElementById('password_cof').value;
                        var role = document.getElementById('role').value;
                        
                        //check email
                        let regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
                        if (!regex.test(email)){
                            alert("Your email is invalid");
                            return;
                        }

                        // check if the password is at least 8 characters long
                        if (psw1.length < 8) { // if the password is shorter than 8 characters
                            alert("The password is too short. It should be at least 8 characters long."); // show an alert message
                            return; // stop the function
                        }
                        if (psw1 !== psw2) { // if the passwords are not equal
                            alert("The passwords do not match."); // show an alert message
                            return; // stop the function
                        }
                        console.log('Information verified');
                        var text = "Email : "+email+"\nAccount Type : "+role+"\n\nAre you sure?";
                        if (confirm(text) == true) {
                            document.getElementById('ca_form').submit();
                            console.log('Form submitted')
                        }
                    }
                </script>
                
            </div>
        </div>
    </body>
</html>