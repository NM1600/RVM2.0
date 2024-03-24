<html>
    <head>
        <title>Owner Dashboard</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background: linear-gradient(to bottom, #053d02, #187f13, #18d22e, #60ff04);
            }
            form{
                background: rgba(255, 255, 255, 0); /* RGBA color with 80% opacity */
                width: 550px;
                height: none;
                padding: 75px 50px;
                position:absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
            }
            .studentRewards {
                border-collapse: collapse;
                width: 100%;
                background-color: rgba(255, 255, 255, 0.5); /* 50% transparent white */
            }

            .studentRewards th, .studentRewards td {
                border: 2px solid green; /* Green borders */
                padding: 8px;
                text-align: center;
                font-size: 15px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: white; /* White text color */
            }

            .studentRewards th {
                background-color: green; /* Green background color for headers */
            }

            /* Alternating row colors */
            .studentRewards tr:nth-child(even) {
                background-color: rgba(0, 128, 0, 0.2); /* Light green for even rows */
            }

            .studentRewards tr:nth-child(odd) {
                background-color: rgba(0, 128, 0, 0.4); /* Dark green for odd rows */
            }
            .validateBtn{
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
            .validateBtn:hover {
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
        </style>
    </head>
    <body>
        <form>
            <h1>Reycle and Earn</h1>
            <p>Welcome Administrator!</p>
            <div class="dashboard_container">
                <table class="studentRewards">
                    <tr>
                        <th>Student ID</th>
                        <th>Collected Plastic Bottles</th>
                        <th>Collected Cans</th>
                        <th>Equivalent Reward Pts</th>
                        <th>Date Claimed</th>
                        <th>Unique Identifier</th>
                    </tr>
                    <?php
                    // Database connection details
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "qrdetails";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Query to fetch data from qrdata table
                    $sql = "SELECT idnumber, bottlesCollected, cansCollected, rewardPts, claimedDate, uniqueidentifier FROM qrdata";
                    $result = $conn->query($sql);

                    // Display data in table rows
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["idnumber"] . "</td>";
                            echo "<td>" . $row["bottlesCollected"] . "</td>";
                            echo "<td>" . $row["cansCollected"] . "</td>";
                            echo "<td>" . $row["rewardPts"] . "</td>";
                            echo "<td>" . $row["claimedDate"] . "</td>";
                            echo "<td>" . $row["uniqueidentifier"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No data available</td></tr>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </table>
                <input type="submit" value="Go Back" class="GoBackBtn" name="GoBack_Btn" formaction="adminDashboard.php" target="_blank">
            </div>
        </form>
    </body>
</html>