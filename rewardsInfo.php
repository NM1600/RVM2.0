<html>
    <head>
        <title>Student Dashboard</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background: linear-gradient(to bottom, #053d02, #187f13, #18d22e, #60ff04);
            }
            h1{
                text-align: center;
                margin-bottom: 65px;
                color: white;
                font-size: 45px;
                font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;                
            }
            form{
                background: rgba(255, 255, 255, 0); /* RGBA color with 80% opacity */
                width: 550px;
                height: 580px;
                padding: 75px 50px;
                position:absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
            }
            .rewardInfoImg_container {
                text-align: center;
                width: 350px; /* Adjust the width of the container as needed */
                height: 350px; /* Adjust the height of the container as needed */
                margin: 0 auto; /* Center the container horizontally */
                margin-bottom: 5px; /* Adjust margin as needed */
            }
            .rewardInfoImg_container img {
                max-width: 100%; /* Set the maximum width of the image to 100% of the container */
                max-height: 100%; /* Set the maximum height of the image to 100% of the container */
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
            <h1>REWARDS INFORMATION</h1>
            </div>
            <div class="rewardInfoImg_container">
                <img src="rewardInfo.png" alt="rewardGuide" class="rewardInfo_img">
            </div>
            <div class="claimBtn_container">
                <input type="submit" value="Go Back" class="GoBackBtn" name="GoBack_Btn" formaction="studentDashboard.php" target="_blank">
            </div>
        </form>
    </body>
</html>