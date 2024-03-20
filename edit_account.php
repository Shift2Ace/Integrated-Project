<?php 
    session_start();
    if (!isset($_SESSION['login_status'])){
        header("Location: routes.php");
    }else{
        if (!$_SESSION['login_status']){
            header("Location: routes.php");
        }
    }

    $conn = mysqli_connect("localhost", $_SESSION['user_id'], $_SESSION['db_psw'], "webserver",3306);
    $sql = "SELECT * FROM my_account";

    if ($conn->multi_query($sql)){
        $result = $conn->store_result();
        if ($result) {
            $row = $result->fetch_assoc();
            $user_id =  $row["user_id"];
            $user_email =  $row["user_email"];
            $user_name =  $row["user_name"];
            $user_gender =  $row["user_gender"];
            $user_age =  $row["user_age"];
            $user_role =  $row["user_role"];
            $result->free();
        }
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="edit_account.css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="login">
                <div class="header">
                    Edit Account
                </div>
                <form action="edit_account_submit.php" id="ea_form" method="post">
                    <div class="input">
                        <div class="name">User Name</div>
                        <input type="text" id="user_name" name="user_name" value="<?php echo $user_name ?>" required>
                        <br>
                        <br>
                        <div class="name">Age</div>
                        <select id="age" name='age'  required></select>
                        <script nonce='rAnd0m'>
                            var select = document.getElementById("age");
                            for (var i = 1; i <= 120; i++) {
                                var option = document.createElement("option");
                                option.value = i;
                                option.text = i;
                                select.appendChild(option);
                            }
                            let element = document.getElementById('age');
                            element.selectedIndex = <?php echo $user_age-1 ?>;
                        </script>
                        <br>
                        <br>
                        <div class="name">Gender</div>
                        <select name="gender" id="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <script nonce='rAnd0m'>
                            let elementg = document.getElementById('gender');
                            if ("<?php echo $user_gender?>" == "male"){
                                elementg.selectedIndex = 0;
                            }else{
                                elementg.selectedIndex = 1;
                            }
                        </script>

                    </div>

                    <div id="button">
                        <a id="cancel" href="account.php" class="button bt_cancel">Cancel</a>
                        <button type="submit" id="submit_bt" class="button bt_apply">Save</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>