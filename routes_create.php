<?php
    session_start();
    if (!isset($_SESSION['login_status'])){
        header("Location: routes.php");
    }else{
        if (!$_SESSION['login_status']){
            header("Location: routes.php");
        }
    }

    if (!isset($_SESSION['role'])){
        header("Location: routes.php");
    } else {
        if ($_SESSION['role'] != 'driver'){
            header("Location: routes.php");
        }
    }
?>

<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="main.css">
        <style>  
            form {
                margin: 0;
            }
            br {
                height: 1px;
            }
            textarea {
                resize: vertical;
                box-sizing: border-box;
                width: 100%;
            }
            form div.input input, form div.input select{
                border-bottom: 1px solid #888;
            }
        </style>
        <script>
            function changeOptions(source,target) {
                var selectedRegion = document.getElementById(source).value;
                var targetDistrict = document.getElementById(target);
                targetDistrict.innerHTML = "";
                var options = [];
                switch (selectedRegion) {
                    case 'Hong Kong':
                        options = ['Aberdeen','Admiralty','Ap Lei Chau','Causeway Bay','Central','Chai Wan','Chung Hom Kok','Deep Water Bay','Happy Valley','Kennedy Town','Mid-Levels','North Point','Pok Fu Lam','Quarry Bay','Sai Wan Ho','Sai Ying Pun','Shau Kei Wan','Shek O','Shek Tong Tsui','Sheung Wan','Stanley','Tai Hang','Tai Tam','The Peak','Wan Chai','Wong Chuk Hang'];
                        break;
                    case 'Kowloon':
                        options = ['Cha Kwo Ling','Cheung Sha Wan','Diamond Hill','Ho Man Tin','Hung Hom','Kowloon Bay','Kowloon City','Kowloon Tong','Lai Chi Kok','Lam Tin','Lok Fu','Mong Kok','Ngau Chi Wan','Ngau Tau Kok','San Po Kong','Sau Man Ping','Sham Shui Po','Shek Kip Mei','Tai Kok Tsui','To Kwa Wan','Tsim Sha Tsui','Tsz Wan Shan','Wang Tau Hom','Wong Tai Sin','Yau Ma Tei','Yau Tong','Yau Yat Chuen'];
                        break;
                    case 'New Territories':
                        options = ['Cheung Chau','Clear Water Bay','Crooked Island','Fanling','Fanling (Kwan Tei)','Grass Island','Kei Ling Chau','Hung Shui Kiu','Kwai Chung','Kwu Tung','Lamma Island','Lantau Island','Lau Fau Shan','Ma On Shan','Ma Wan','Peng Chau','Ping Che','Sai Kung','Sha Tau Kok','Sha Tin','Sham Tseng','Shek Kwu Chau','Sheung Shui','So Kwun Wat','Ta Kwu Ling','Tai Lam','Tai Po','Tai Po Kau','Tin Shui Wai','Ting Kau','Tseung Kwan O','Tsing Yi','Tsuen Wan','Tuen Mun','Yuen Long']
                        break;
                }

                for (var i = 0; i < options.length; i++) {
                    var option = document.createElement("option");
                    option.value = options[i];
                    option.text = options[i];
                    targetDistrict.appendChild(option);
                }
            }
        </script>
    </head>
    <body onload="changeOptions('start_region','start_district'), changeOptions('end_region','end_district')">
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="login">
                <div class="header">
                    Create Route
                </div>
                <form action="routes_create_submit.php" method="post">
                    <div class="input">
                        <div class="name">Start Location</div>
                        <select id="start_region" onchange="changeOptions('start_region','start_district')" name="start_region" required>
                            <option>(Select Region)</option>
                            <option>Hong Kong</option>
                            <option>Kowloon</option>
                            <option>New Territories</option>
                        </select>
                        <select id="start_district" name="start_district" required>
                        </select>
                        <input type="text" name="start_street" placeholder="(street/building)">
                        <br>
                        <br>
                        <div class="name">Destination</div>
                        <select id="end_region" onchange="changeOptions('end_region','end_district')" name="end_region" required>
                            <option>(Select Region)</option>
                            <option>Hong Kong</option>
                            <option>Kowloon</option>
                            <option>New Territories</option>
                        </select>
                        <select id="end_district" name="end_district" required>
                        </select>
                        <input type="text" placeholder="(street/building)" name="end_street" required>
                    </div>
                    <div class="input">
                        <div class="name">Date</div>
                        <input type="date" id="date" name="date" required>
                        <br>
                        <br>
                        <div class="name">Time</div>
                        <input type="time" min="00:00" max="23:59" name="time" required>
                    </div>
                    <div class="input">
                        <div class="name">Car Model</div>
                        <input type="text" name="car" required>
                        <br>
                        <br>
                        <div class="name">Available passenger capacity</div>
                        <select id="number" name="capacity" required>
                            <script>
                                var select = document.getElementById("number");
                                for (var i = 1; i <= 800; i++) {
                                    var option = document.createElement("option");
                                    option.value = i;
                                    option.text = i;
                                    select.appendChild(option);
                                }
                            </script>
                        </select>
                    </div>
                    <div class="input">
                        <div class="name">Price (HKD)</div>
                        <script>
                            var numberInput = document.getElementById("priceInput");
                            
                        </script>
                        <input type="number" value=0 id="priceInput" name="price">
                    </div>

                    <div class="input">
                        <div class="name">Description</div>
                        <textarea name="description"></textarea>
                    </div>
                    <div id="button">
                        <a id="cancel" href="/login.php" class="button bt_cancel">Cancel</a>
                        <button type="submit" id="submit"  class="button bt_apply">Apply</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>