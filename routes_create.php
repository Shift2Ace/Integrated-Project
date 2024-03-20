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

<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="routes_create.css">
        <script nonce='rAnd0m'>
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
    <body id='myBody'>
        <script nonce="rAnd0m">
            document.addEventListener('DOMContentLoaded', (event) => {
                document.getElementById('myBody').onload = function() {
                    changeOptions('start_region', 'start_district');
                    changeOptions('end_region', 'end_district');
                };
            });

        </script>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="login">
                <div class="header">
                    Create Route
                </div>
                <form action="routes_create_submit.php" method="post">
                    <div class="input">
                        <div class="name">Start Location</div>
                        <select id="start_region" name="start_region" required>
                            <option>(Select Region)</option>
                            <option>Hong Kong</option>
                            <option>Kowloon</option>
                            <option>New Territories</option>
                        </select>
                        <script nonce="rAnd0m">
                            document.addEventListener('DOMContentLoaded', function () {
                                var startRegionSelect = document.getElementById('start_region');
                                startRegionSelect.addEventListener('change', function() {
                                    changeOptions('start_region', 'start_district');
                                });
                            });
                        </script>
                        <select id="start_district" name="start_district" required>
                        </select>
                        <input type="text" name="start_street" placeholder="(street/building)">
                        <br>
                        <br>
                        <div class="name">Destination</div>
                        <select id="end_region" name="end_region" required>
                            <option>(Select Region)</option>
                            <option>Hong Kong</option>
                            <option>Kowloon</option>
                            <option>New Territories</option>
                        </select>
                        <script nonce="rAnd0m">
                            document.addEventListener('DOMContentLoaded', function () {
                                var startRegionSelect = document.getElementById('end_region');
                                startRegionSelect.addEventListener('change', function() {
                                    changeOptions('end_region', 'end_district');
                                });
                            });
                        </script>
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
                            <script nonce='rAnd0m'>
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
                        <script nonce='rAnd0m'>
                            var numberInput = document.getElementById("priceInput");
                            
                        </script>
                        <input type="number" value=0 id="priceInput" name="price">
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                    <div class="input">
                        <div class="name">Description</div>
                        <textarea name="description"></textarea>
                    </div>
                    <div id="button">
                        <a id="cancel" href="/routes_dri.php" class="button bt_cancel">Cancel</a>
                        <button type="submit" id="submit"  class="button bt_apply">Apply</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>