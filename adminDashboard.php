<html>
    <head>
    <link rel="stylesheet" href="adminDashboard.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <title>Welcome Administrator!</title>
        </style>
    </head>
    <body>
        <div class = "card">
        <div class = "logo-container">
            <img src="logoEarn.png" class="logo" alt="logo">
            <p style = "font-family: Poppins, sans-serif; font-weight: 400;font-style: normal;">Welcome Administrator!</p>
        <div class="img_container">
                <img src="profile.png" alt="Profile" class="profile_img">
        </div>
        <div class="dashboard_container">
                <button type="submit" class="historyBtn" onclick="redirectTohistory()">Scan QR History</button>
                <button type="submit" class="scanQR" onclick="redirectToscanQR()">Scan QR</button>
                <button type="button" class="LogoutBtn" onclick="redirectToForm()">Logout</button>
        </div>
        </form>

        <script>
    function redirectToForm() {
        window.location.href = "index.php";
    }
    function redirectToscanQR() {
        window.location.href = "scanQR.php";
    }
    function redirectTohistory() {
        window.location.href = "adminValidateReward.php";
    }
    </script>
    </body>
</html>