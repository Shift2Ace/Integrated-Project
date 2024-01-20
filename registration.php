<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <style>
            #submit, #cancel{
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
            #cancel {
                background-color: #f33;
            }
            #submit:hover {
                background-color: #0f8;
            }
            #cancel:hover {
                background-color: #f00;
                color: #fff;
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
                        <select id="number"></select>
                        <script>
                            var select = document.getElementById("number");
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
                            <option value="passenger">Passenger</option>
                            <option value="driver">Driver</option>
                        </select>
                    </div>
                    <div class="input">
                        <div class="name">Password</div>
                        <input type="password">
                        <br>
                        <br>
                        <div class="name">Confirm Password</div>
                        <input type="password">
                    </div>
                    <div id="button">
                        <a id="cancel" href="/login.php">Cancel</a>
                        <button type="submit" id="submit">Apply</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>