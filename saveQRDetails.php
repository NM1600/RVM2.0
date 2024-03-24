<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['text'])) {
        // Retrieve the scanned QR data
        $qrData = $_POST['text'];

        // Parse QR data and set parameters
        $qrDataArray = explode(",", $qrData);
        $idnumber = trim(substr($qrDataArray[0], strpos($qrDataArray[0], ":") + 1));
        $bottlesCollected = trim(substr($qrDataArray[1], strpos($qrDataArray[1], ":") + 1));
        $cansCollected = trim(substr($qrDataArray[2], strpos($qrDataArray[2], ":") + 1));
        $rewardPts = trim(substr($qrDataArray[3], strpos($qrDataArray[3], ":") + 1));
        $uniqueidentifier = trim(substr($qrDataArray[4], strpos($qrDataArray[4], ":") + 1));
        $claimedDate = date("Y-m-d H:i:s"); // Current date and time

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

        // Check if the unique identifier already exists in the database
        $checkQuery = "SELECT * FROM qrData WHERE uniqueidentifier = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $uniqueidentifier);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            // Display a pop-up message
            echo "<script>alert('This QR code has already been redeemed. No more rewards will be given as it was redeemed. Thank you for recycling!');";
            // Redirect back to scanQR.php after displaying the alert
            echo "window.location.href = 'scanQR.php';</script>";
            exit(); // Stop further execution of the script

        } else {
            // Prepare and bind the SQL statement
            $stmt = $conn->prepare("INSERT INTO qrData (idnumber, bottlesCollected, cansCollected, rewardPts, claimedDate, uniqueidentifier) VALUES (?, ?, ?, ?, ?, ?)");

            // Bind parameters
            $stmt->bind_param("ssssss", $idnumber, $bottlesCollected, $cansCollected, $rewardPts, $claimedDate, $uniqueidentifier);

            // Execute the statement
            if ($stmt->execute()) {
                // Display a pop-up message
                echo "<script>alert('QR details saved successfully. QR now redeemed.');";
                // Redirect back to scanQR.php after displaying the alert
                echo "window.location.href = 'scanQR.php';</script>";
                exit(); // Stop further execution of the script  
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement and connection
            $stmt->close();
        }

        $checkStmt->close();
        $conn->close();
    } else {
        // Display a pop-up message
        echo "<script>alert('No data scanned. Please scan a QR code.');";
        // Redirect back to scanQR.php after displaying the alert
        echo "window.location.href = 'scanQR.php';</script>";
        exit(); // Stop further execution of the script    
    }
}
?>
