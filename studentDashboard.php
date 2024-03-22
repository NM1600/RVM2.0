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
        .dashboard_container {
            text-align: center;
        }
        form{
            background: rgba(255, 255, 255, 0.33); /* RGBA color with 80% opacity */
            width: 550px;
            height: none;
            padding: 75px 50px;
            position:absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
        }
        p{
            text-align: center;
            margin-bottom: 5px;
            color: #ffff;
            font-size: 25px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .ClaimRewardBtn{
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
        .ClaimRewardBtn:hover {
            background-color: #0bd830; /* New background color when hovering */
            background-position: center;
            font-size: 16px;
            color: black;
        }
        .RewardsInfoBtn{
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
        .RewardsInfoBtn:hover {
            background-color: #0bd830; /* New background color when hovering */
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
            color: white;
        }
        </style>
    </head>
    <body>
    <form>
        <div class="img_container">
            <img src="profile.png" alt="Profile" class="profile_img">
        </div>
        <?php
            session_start(); // Start the session
            // Check if the user is logged in and the idnumber is set in the session
            if(isset($_SESSION["idnumber"])) {
                echo '<p>ID number: ' . htmlspecialchars($_SESSION["idnumber"]) . '</p>';
            } else {
                echo '<p>ID number: Not Available</p>';
            }
        ?>
        <div class="dashboard_container">
            <input type="submit" value="Claim Reward" class="ClaimRewardBtn" name="ClaimReward_Btn" formaction="claimReward.php" target="_blank">
            <input type="submit" value="Rewards Info" class="RewardsInfoBtn" name="RewardsInfo_Btn" formaction="rewardsInfo.php" target="_blank">
            <input type="submit" value="Logout" class="LogoutBtn" name="Logout_Btn" formaction="form0.php" target="_blank">
        </div>
    </form>

    </body>
</html>