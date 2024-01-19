<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <style>
            #submit, #clear{
                font-size: 20px;
                border: 0;
                border-radius: 4px;
                padding: 5px;
                color: black;
                text-decoration: none;
            }
            #submit {
                background-color: #6fb;
            }
            #clear {
                background-color: #f33;
            }
            #submit:hover {
                background-color: #0f8;
            }
            #clear:hover {
                background-color: #f00;
            }
            #button {
                margin-top: 20px;
                text-align: right;
            }
            form {
                margin: 0;
            }
            br {
                height: 1px;
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
                <form>
                    <div class="input">
                        <div class="name">User Name</div>
                        <input type="text">
                        <br>
                        <br>
                        <div class="name">Age</div>
                        <input type="number" min="1" max="200">
                        <br>
                        <br>
                        <div class="name">Gender</div>
                        <select name="gender" id="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <br>
                        <br>
                        <div class="name">Email</div>
                        <input type="email">
                    </div>
                    <div class="input">
                        <div class="name">Account Type</div>
                        <select name="role" id="role">
                            <option value="male">Passenger</option>
                            <option value="female">Driver</option>
                        </select>
                    </div>
                    <div class="input">
                        <div class="name">Password</div>
                        <input type="email">
                        <br>
                        <br>
                        <div class="name">Confirm Password</div>
                        <input type="email">
                    </div>
                    <div id="button">
                        <a id="clear" href="/login.php">Cancel</a>
                        <button type="submit" id="submit">Apply</button>
                    </div>
                </form>
            </div>
        </div>
        
    </body>

</html>