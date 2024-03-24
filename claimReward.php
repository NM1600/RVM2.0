<html>
    <head>
        <title>Student Dashboard</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background: linear-gradient(to bottom, #053d02, #187f13, #18d22e, #60ff04);
            }
            h1{
                text-align: center;
                margin-bottom: 65px;
                color: white;
                font-size: 45px;
                font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;                
            }
            p{
                text-align: left;
                margin-bottom: 5px;
                color: white;
                font-size: 18px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
            }
            form{
                background: rgba(255, 255, 255, 0); /* RGBA color with 80% opacity */
                width: 550px;
                height: 580px;
                padding: 75px 50px;
                position:absolute;
                align-items: center;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
            }
            .txt {
                text-align: center;
                margin-top: 0px; /* Adjust margin */
                color: white;
                font-size: 18px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            .textBoxdiv {
                margin: 15px auto;
                text-align: center;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 18px;
                width: 100%;
            }
            .textBoxdiv input {
                display: block;
                margin: 0 auto;
                background: white;
                border: none;
                border-bottom: 2px solid rgb(0, 131, 7); /* Adjust border style */
                outline: none;
                width: 100%;
                color: black;
                height: 30px; /* Adjust height */
                font-size: 15px;
                padding: 5px; /* Add padding */
            }
            .GenerateQRBtn{
                height: 45px;
                width: 100%;
                margin-top: 5px;
                border: none;
                outline: none;
                background: #053d02;
                background-size: 200%;
                color: white;
                font-size: 16px;
            }
            .GenerateQRBtn:hover {
                background-color: #0bd830; /* New background color when hovering */
                background-position: right;
                font-size: 16px;
                color: black;
            }
            .GoBackBtn{
                height: 45px;
                width: 100%;
                margin-top: 15px;
                border: none;
                outline: none;
                background: #053d02;
                background-size: 200%;
                color: white;
                font-size: 16px;
            }
            .GoBackBtn:hover {
                background-color: #0bd830; /* New background color when hovering */
                background-position: right;
                font-size: 16px;
                color: black;
            }
            #imgBox {
                text-align: center;
            }

            #qrImage {
                max-width: 150px;
                max-height: 150px;
                margin-top: 10px; /* Adjust margin top as needed */
            }

        </style>
    </head>
    <body>
        <form method="post" action="">
            <h1>REDEEM REWARD</h1>
            <?php

                session_start(); // Start the session to maintain user login state
                
                // Check if the user is logged in, if not redirect to login page
                if(!isset($_SESSION["idnumber"])){
                    header("Location: studentLogin.php");
                    exit;
                }

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "studentdetails";

                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Prepare and bind the SQL query to fetch data of the logged-in user
                $sql = "SELECT idnumber, bottlesCollected, cansCollected, rewardPts FROM studtable WHERE idnumber = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $_SESSION["idnumber"]);
                $stmt->execute();
                $result = $stmt->get_result();

                // Display data
                while ($row = $result->fetch_assoc()) {
                ?>
                    <p class="txt">Recycler ID Number:</p>
                    <input type="text" class="textBoxdiv" name="idnumber" id="idnum" value="<?php echo $row['idnumber']; ?>"
                           readonly>
                    <p class="txt">Number of plastic bottles collected:</p>
                    <input type="text" class="textBoxdiv" name="bottlesCollected" id="bottles"
                           value="<?php echo $row['bottlesCollected']; ?>" readonly>
                    <p class="txt">Number of cans collected:</p>
                    <input type="text" class="textBoxdiv" name="cansCollected" id="cans"
                           value="<?php echo $row['cansCollected']; ?>" readonly>
                    <p class="txt">Total redeemable points (₱):</p>
                    <input type="text" class="textBoxdiv" name="rewardPts" id="pts"
                           value="<?php echo ($row['bottlesCollected'] / 10) + ($row['cansCollected'] / 5); ?>" readonly>
                <?php
                }
                $stmt->close();
                mysqli_close($conn);
            ?>

            <div class="container">
                <input onclick="claimReward()" type="button" value="Claim Reward (QR)" class="GenerateQRBtn" name="GenerateQR_Btn">
                <div id="imgBox">
                    <img src="" id="qrImage">
                    <script>
                        let imgBox = document.getElementById("imgBox");
                        let qrImage = document.getElementById("qrImage");
                        let idnum = document.getElementById("idnum");
                        let bottles = document.getElementById("bottles");
                        let cans = document.getElementById("cans");
                        let pts = document.getElementById("pts");

                        function generateUniqueIdentifier() {
                            // Generate a random string of 8 characters
                            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                            let randomString = '';
                            for (let i = 0; i < 8; i++) {
                                randomString += characters.charAt(Math.floor(Math.random() * characters.length));
                            }
                            return randomString;
                        }

                        function claimReward() {
                            let rewardPts = parseFloat(pts.value);
                            if (rewardPts < 5) {
                                alert("You cannot claim rewards yet as your collected plastic bottles and cans are too little. Collect more bottles and cans to claim reward!");
                            } else {
                                let uniqueIdentifier = generateUniqueIdentifier(); // Generate unique identifier
                                updateDatabase(uniqueIdentifier); // Update the database with the unique identifier
                            }
                        }

                        function generateQR(dateTime, uniqueIdentifier) {
                            let data = "ID Number: " + idnum.value + ", " +
                                        "Bottles collected: " + bottles.value + ", " +
                                        "Cans collected: " + cans.value + ", " +
                                        "Reward pts (php): " + pts.value + ", " +
                                        "Unique Identifier: " + uniqueIdentifier + ", " + // Include unique identifier
                                        "Claimed Date: " + dateTime + ", " + " Reminders: Present your QR code to Recycle and Earn admin to claim reward."; // Include date and time in QR code data

                            qrImage.src = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" + encodeURIComponent(data);
                        }

                        function updateDatabase(uniqueIdentifier) {
                            let xhr = new XMLHttpRequest();
                            xhr.open("POST", "updateDatabase.php", true);
                            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    let dateTime = new Date().toLocaleString(); // Get current date and time
                                    generateQR(dateTime, uniqueIdentifier); // Generate QR code with current date and time and unique identifier
                                    console.log(xhr.responseText); // Output response from updateDatabase.php
                                }
                            };
                            xhr.send("idnumber=" + idnum.value + "&uniqueIdentifier=" + uniqueIdentifier); // Send ID number and unique identifier as POST data
                        }

                    </script>

                </div>
                <input type="submit" value="Go Back" class="GoBackBtn" name="GoBack_Btn" formaction="studentDashboard.php" target="_blank">
            </div>
        </form>
    </body>
</html>
