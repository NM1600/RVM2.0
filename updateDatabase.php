<?php
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

    // Get the ID number from the POST request
    $idnumber = $_POST['idnumber'];

    // Update the database to reset values to 0
    $sql = "UPDATE studtable SET bottlesCollected = 0, cansCollected = 0, rewardPts = 0 WHERE idnumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $idnumber);

    if ($stmt->execute()) {
        echo "Database updated successfully";
    } else {
        echo "Error updating database: " . $stmt->error;
    }

    $stmt->close();
    mysqli_close($conn);
?>
