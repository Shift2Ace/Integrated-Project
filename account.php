<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <style>
            .cl1 {
                width: 50px;
            }
            .cl2 {
                width: 50%;
            }
            .item {
                min-width: 300px;
            }
            div#icon {
                height: auto;
                width: fit-content;
                min-width: 30px;
                background-color: #fff;
                margin: 2px;
            }
            
        </style>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="content">
                <div class="header">
                    My Account
                </div>
                <div style="display: flex">
                    <div id="icon">
                    </div>
                    <div class="item">
                        <table>
                            <tr>
                                <td>User Name</td>
                                <td> : </td>
                            </tr>
                            <tr>
                                <td>Age</td>
                                <td> : </td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td> : </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> : </td>
                            </tr>
                            
                            <tr>
                                <td>Account Type</td>
                                <td> : </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="item">
                    <a href="editAc.php" class="bt_text">Edit account</a>
                    <br>
                    <a href="resetPassword.php" class="bt_text">Reset password</a>
                    <br>
                    <br>
                    <a href="deleteAc.php" class="bt_text_red">Delete account</a>
                </div>
            </div>
        </div>
    </body>
</html>