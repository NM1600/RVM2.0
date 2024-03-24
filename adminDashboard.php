<html>
    <head>
    <link rel="stylesheet" href="adminDashboard.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <title>Owner Dashboard</title>
        </style>
    </head>
    <body>
        <div class = "card">
            <div class = "logo-container">
            <img src="logoEarn.png" class="logo" alt="logo">
            <p>Welcome Administrator!</p>
            <div class="img_container">
                <img src="profile.png" alt="Profile" class="profile_img">
</div>
            <div class="dashboard_container">
                <input type="submit" value="Scanned QR History" class="validateBtn" name="Validate_Btn" formaction="adminValidateReward.php" target="_blank">
                <input type="submit" value="Scan QR" class="scanQR" name="scanQR_Btn" formaction="scanQR.php" target="_blank">
                <button type="button" class="LogoutBtn" onclick="redirectToForm()">Logout</button>
            </div>
        </form>
        <script>
    function redirectToForm() {
        window.location.href = "form0.php";
    }
    </script>
    </body>
</html>