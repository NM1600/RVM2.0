<html>
    <head>
        <link rel="stylesheet" href="form0.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
         <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
         <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
        <title>Claim Reward</title>

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
