<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <style>
            
            .cl2 {
                width: 50%;
            }
            #button {
                margin-top: 20px;
                text-align: right;
            }
            #submit, #cancel, #delete{
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
            #cancel, #delete {
                background-color: #f33;
            }
            #submit:hover {
                background-color: #0f8;
            }
            #cancel:hover ,#delete:hover {
                background-color: #f00;
                color: #fff;
            }
            
            div#description {
                width: auto;                
            }

            
        </style>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="content" style="width:1000px">
                <div class="header">
                    Detail Information
                </div>
                <div style="display: flex"> 
                    <div class="item" style="flex-grow:1; overflow:scroll ;width: 50%">
                        <table>
                            <tr>
                                <td>Route ID</td>
                                <td> : </td>
                            </tr>
                            <tr>
                                <td>Starting Location</td>
                                <td> : </td>
                                <td>  </td>
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
                    <div style="flex-grow:1;width: 50%">
                        <div class="item" style="height: auto; overflow:scroll">
                            <table>
                                <tr>
                                    <td>Driver Name</td>
                                    <td> : </td>
                                </tr>
                                <tr>
                                    <td>Driver Email</td>
                                    <td> : </td>
                                </tr>
                                <tr>
                                    <td>Car model</td>
                                    <td> : </td>
                                </tr>
                            </table>
                        </div>
                        <div class="item">
                            <table>
                                <tr>
                                    <td>Number of passenger</td>
                                    <td> : </td>
                                    <td>10 / 150</td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                    
                </div>
                <div class="item" id="description">
                    Description <br><br>
                    kasdjgflkjhbdklfjbsiub fiusdbdif start_districtsd
                    sdf
                    dfs adbfjhbdfjbsdjbf jdbfbdifbsidufb ukdbfsbdfbsd kjbfkhkhfkshfkhkfhjkjlfdjl
                    sdf
                    descriptionsdf
                    sdff sdf sdf f sdf sdf ds sdaf sd sdf sd
                </div>
                <div id="button">
                    <a href="" id="cancel">Cancel</a>
                    <a href="" id="submit">Book</a>
                    <a href="" id="Delete">Delete</a>
                </div>
                
            </div>
        </div>
        
    </body>

</html>