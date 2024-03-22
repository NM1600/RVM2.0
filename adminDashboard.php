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
            .img_container {
                text-align: center;
                width: 200px; /* Adjust the width of the container as needed */
                height: 200px; /* Adjust the height of the container as needed */
                margin: 0 auto; /* Center the container horizontally */
                margin-bottom: 5px; /* Adjust margin as needed */
            }
            .img_container img {
                max-width: 100%; /* Set the maximum width of the image to 100% of the container */
                max-height: 100%; /* Set the maximum height of the image to 100% of the container */
            }
            h1{
                    text-align: center;
                    margin-bottom: 65px;
                    color: yellow;
                    font-size: 45px;
                    font-family: cursive;                
                    font-weight: 400;
            }
            p{
                text-align: left;
                margin-bottom: 5px;
                color: white;
                font-size: 18px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
            }
            .dashboard_container {
                text-align: center;
            }
            .ScanQRBtn{
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
            .ScanQRBtn:hover {
                background-color: green; /* New background color when hovering */
                background-position: center;
                font-size: 16px;
                color: black;
            }
            .LogoutBtn{
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
            .LogoutBtn:hover {
                background-color: #676767; /* New background color when hovering */
                background-position: center;
                font-size: 16px;
                color: black;
            }
        </style>
    </head>
    <body>
        <form>
            <div class="img_container">
                <img src="profile.png" alt="Profile" class="profile_img">
            </div>
            <h1>Reycle and Earn</h1>
            <p>Welcome Administrator!</p>
            <div class="dashboard_container">
                <input type="submit" value="Scan QR" class="ScanQRBtn" name="ScanQR_Btn" formaction="QR.php" target="_blank">
                <input type="submit" value="Logout" class="LogoutBtn" name="Logout_Btn" formaction="form0.php" target="_blank">
            </div>
        </form>
    </body>
</html>