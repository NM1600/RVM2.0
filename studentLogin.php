<html>
    <head>
     <link rel="stylesheet" href="studentLogin.css">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <title>Student Login</title>
    </head>

    <body>
        <div class="card">
        <img src="logoEarn.png" class="logo" alt="logo">
        <div class="welcome-container">
            <img src="WelcomeNameTag.png" class="welcome" alt="logo">
            <p style = "font-color:white;">ID Number:</p>
            <div class="textBoxdiv">
                <input type="text" class = "bordertext" placeholder="Enter School ID number"> 
                <button type="submit" class="loginBtn" onclick = "redirectToLoginDashboard()"> Login </button>
                <button type = "button" class="GoBackBtn" onclick="redirectToForm()">Go Back</button>
        </div>
        </form>

<script>
    function redirectToForm() {
        window.location.href = "form0.php";
    }

    function redirectToLoginDashboard() {
        window.location.href = "studentDashboard.php"
    }
</script>
    </body>
</html>


<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "studentdetails";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $idnumber = $_POST['idnumber'];

    $sql = "SELECT * FROM studtable WHERE idnumber='$idnumber'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Login successful, set session variable
        $_SESSION['idnumber'] = $idnumber;
        header("Location: studentDashboard.php"); // Redirect to the dashboard or any other page
        exit(); // Make sure to exit after redirecting
    } else {
        echo '<div class="error-message">Error: Unregistered ID Number</div>';
    }

    mysqli_close($conn);
}
?>







