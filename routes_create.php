<!DOCTYPE html>
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
            textarea {
                resize: vertical;
                box-sizing: border-box;
                width: 100%;

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
                        options = ['(Select District)','Aberdeen','Admiralty','Ap Lei Chau','Causeway Bay','Central','Chai Wan','Chung Hom Kok','Deep Water Bay','Happy Valley','Kennedy Town','Mid-Levels','North Point','Pok Fu Lam','Quarry Bay','Sai Wan Ho','Sai Ying Pun','Shau Kei Wan','Shek O','Shek Tong Tsui','Sheung Wan','Stanley','Tai Hang','Tai Tam','The Peak','Wan Chai','Wong Chuk Hang'];
                        break;
                    case 'Kowloon':
                        options = ['(Select District)','Cha Kwo Ling','Cheung Sha Wan','Diamond Hill','Ho Man Tin','Hung Hom','Kowloon Bay','Kowloon City','Kowloon Tong','Lai Chi Kok','Lam Tin','Lok Fu','Mong Kok','Ngau Chi Wan','Ngau Tau Kok','San Po Kong','Sau Man Ping','Sham Shui Po','Shek Kip Mei','Tai Kok Tsui','To Kwa Wan','Tsim Sha Tsui','Tsz Wan Shan','Wang Tau Hom','Wong Tai Sin','Yau Ma Tei','Yau Tong','Yau Yat Chuen'];
                        break;
                    case 'New Territories':
                        options = ['(Select District)','Cheung Chau','Clear Water Bay','Crooked Island','Fanling','Fanling (Kwan Tei)','Grass Island','Kei Ling Chau','Hung Shui Kiu','Kwai Chung','Kwu Tung','Lamma Island','Lantau Island','Lau Fau Shan','Ma On Shan','Ma Wan','Peng Chau','Ping Che','Sai Kung','Sha Tau Kok','Sha Tin','Sham Tseng','Shek Kwu Chau','Sheung Shui','So Kwun Wat','Ta Kwu Ling','Tai Lam','Tai Po','Tai Po Kau','Tin Shui Wai','Ting Kau','Tseung Kwan O','Tsing Yi','Tsuen Wan','Tuen Mun','Yuen Long']
                        break;
                }

                for (var i = 0; i < options.length; i++) {
                    var option = document.createElement("option");
                    option.value = options[i].toLowerCase();
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
                <form>
                    <div class="input">
                        <div class="name">Start Location</div>
                        <select id="start_region" onchange="changeOptions('start_region','start_district')">
                            <option>(Select Region)</option>
                            <option>Hong Kong</option>
                            <option>Kowloon</option>
                            <option>New Territories</option>
                        </select>
                        <select id="start_district">
                        </select>
                        <input type="text" placeholder="(street/building)">
                        <br>
                        <br>
                        <div class="name">Destination</div>
                        <select id="end_region" onchange="changeOptions('end_region','end_district')">
                            <option>(Select Region)</option>
                            <option>Hong Kong</option>
                            <option>Kowloon</option>
                            <option>New Territories</option>
                        </select>
                        <select id="end_district">
                        </select>
                        <input type="text" placeholder="(street/building)">
                    </div>
                    <div class="input">
                        <div class="name">Date</div>
                        <input type="date">
                        <br>
                        <br>
                        <div class="name">Time</div>
                        <input type="time">
                    </div>
                    <div class="input">
                        <div class="name">Car Model</div>
                        <input type="text">
                        <br>
                        <br>
                        <div class="name">Available passenger capacity</div>
                        <select id="number"></select>
                        <script>
                            var select = document.getElementById("number");
                            for (var i = 1; i <= 800; i++) {
                                var option = document.createElement("option");
                                option.value = i;
                                option.text = i;
                                select.appendChild(option);
                            }
                        </script>
                    </div>
                    <div class="input">
                        <div class="name">Price</div>
                        <script>
                            var numberInput = document.getElementById("priceInput");
                            
                        </script>
                        <input type="number" value=0 id="priceInput" >
                    </div>

                    <div class="input">
                        <div class="name">Description</div>
                        <textarea></textarea>
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