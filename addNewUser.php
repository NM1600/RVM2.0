<html>
    <head>
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
            .idnumNewUser {
                margin: 15px auto;
                text-align: center;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 20px;
                width: 100%;
                padding: 8px;
            }
            .idnumNewUser input {
                display: block;
                margin: 0 auto;
                background: white;
                border: none;
                border-bottom: 2px solid rgb(0, 131, 7); /* Adjust border style */
                outline: none;
                width: 100%;
                color: black;
                font-size: 15px;
            }
            .btn{
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
            .btn:hover {
                background-color: #0bd830; /* New background color when hovering */
                background-position: center;
                font-size: 15px;
                color: black;
            }
            .userList {
                border-collapse: collapse;
                width: 100%;
                background-color: rgba(255, 255, 255, 0.5); /* 50% transparent white */
            }

            .userList th, .userList td {
                border: 2px solid green; /* Green borders */
                padding: 5px;
                text-align: center;
                font-size: 10px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: white; /* White text color */
            }

            .userList th {
                background-color: green; /* Green background color for headers */
            }

            /* Alternating row colors */
            .userList tr:nth-child(even) {
                background-color: rgba(0, 128, 0, 0.2); /* Light green for even rows */
            }

            .userList tr:nth-child(odd) {
                background-color: rgba(0, 128, 0, 0.4); /* Dark green for odd rows */
            }
        </style>
    </head>
        <body>
        <form method="post" action="">
            <table class="userList">
                <tr>
                    <th>Existing Student ID Number</th>
                </tr>
                <?php
                // Database connection details
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "studentdetails";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to fetch idnumber from studtable
                $sql = "SELECT idnumber FROM studtable";
                $result = $conn->query($sql);

                // Display idnumbers in table rows
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["idnumber"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='1'>No data available</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </table>
            <input type="text" class="idnumNewUser" name="idnumNewUser" placeholder="Enter Student ID Number">
            <input type="submit" value="Add New User" class="btn" name="addUser_btn">
            <input type="submit" value="Go Back" class="btn" name="addUser_btn" formaction="adminDashboard.php" target="_blank">
        </form>
    </body>
</html>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addUser_btn"])) {
    // Validate if ID number is provided
    if (!empty($_POST["idnumNewUser"])) {
        // Get the entered ID number
        $idnumber = $_POST["idnumNewUser"];

        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "studentdetails";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the ID number already exists
        $check_query = "SELECT idnumber FROM studtable WHERE idnumber = ?";
        $check_stmt = $conn->prepare($check_query);
        if ($check_stmt) {
            $check_stmt->bind_param("s", $idnumber);
            $check_stmt->execute();
            $check_stmt->store_result();
            
            if ($check_stmt->num_rows > 0) {
                // ID number already exists
                echo "<script>alert('ID Number is already registered');</script>";
            } else {
                // Prepare and bind the SQL statement to insert the ID number
                $insert_query = "INSERT INTO studtable (idnumber) VALUES (?)";
                $insert_stmt = $conn->prepare($insert_query);
                if ($insert_stmt) {
                    $insert_stmt->bind_param("s", $idnumber);
                    
                    // Execute the statement
                    if ($insert_stmt->execute()) {
                        echo "<script>alert('New user added successfully');</script>";
                    } else {
                        echo "<script>alert('Error adding user');</script>";
                    }
                } else {
                    echo "<script>alert('Error preparing statement for insertion');</script>";
                }
            }

            // Close statements
            $check_stmt->close();
            if (isset($insert_stmt)) {
                $insert_stmt->close();
            }
        } else {
            echo "<script>alert('Error preparing statement for checking');</script>";
        }

        // Close connection
        $conn->close();
    } else {
        echo "<script>alert('Please enter an ID number');</script>";
    }
}
?>
