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
            table {
                background-color: #ddd;
            }
            div.createRoute {
                text-align: right;
                padding: 2px;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="list">
                <div class="header">
                    My Routes
                </div>
                <div class="createRoute">
                    <a href="routes_create.php" class="button bt_apply">Create New</a>
                </div>
                <div class="item">
                    <table>
                        <tr>
                            <td class="cl1">
                                1
                            </td>
                            <td class="cl2">
                                2
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
    </body>

</html>