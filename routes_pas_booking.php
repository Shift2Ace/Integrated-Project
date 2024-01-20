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
            #button {
                margin-top: 20px;
                text-align: right;
            }
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
            }
        </style>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="content">
                <div class="header">
                    Confirmation
                </div>
                <div class="item">
                    <table>
                        <tr>
                            <td>Route ID</td>
                            <td> : </td>
                        </tr>
                        <tr>
                            <td>Starting Location</td>
                            <td> : </td>
                        </tr>
                        <tr>
                            <td>Destination</td>
                            <td> : </td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td> : </td>
                        </tr>
                        <tr>
                            <td>Time</td>
                            <td> : </td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td> : </td>
                        </tr>
                    </table>
                </div>
                <div id="button">
                    <a href="" id="cancel">Cancel</a>
                    <a href="" id="submit">Confirm</a>
                </div>
                
            </div>
        </div>
        
    </body>

</html>