<html>
    <head>
        <link rel="stylesheet" href="adminDashboard.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
       
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
