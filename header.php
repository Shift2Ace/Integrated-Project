<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="main.css">
        <style>
            div.top {
                text-align: center;
                font-size: 30px;
                font-weight: 900;
                font-family: Georgia, 'Times New Roman', Times, serif;
                background-color: #222;
            }

            div.top a {
                display: block;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                color: #ccc;
            }

            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #333;
                }

            li {
                float: left;
                border-right:1px solid #222;
            }

            li:last-child {
                border-right: none;
            }

            li a {
                display: block;
                color: white;
                text-align: center;
                padding: 15px;
                text-decoration: none;
            }

            li a:hover:not(.active) {
                background-color: #111;
            }

            .active {
                background-color: #04AA6D;
            }
            body {
                margin: 0;
                width: 100%;
            }

            #header {
                width: 100%;
                position: fixed;
                top: 0;
                left: 0;
            }

            #h_space {
                height: 112px;
            }
            
        </style>
    </head>
    <body>
        <div id="header">
            <div class="top">
                <a href="routes.php">Title</a>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="routes.php">Routes</a></li>
                    <li><a href="routes_pas_booked.php">My Order</a></li>
                    <li><a href="routes_dri.php">My Routes</a></li>
                    <li><a href="acount.php">Account</a></li>
                    <li style="float:right"><a href="login.php">login</a></li>
                    <li style="float:right"><a href="">logout</a></li>
                </ul>
            </div>
        </div>
        <div id="h_space">

        </div>
        
    </body>
</html>