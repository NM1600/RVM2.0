<html>
    <head>
        <link rel="stylesheet" href="studentDashboard.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
        <title>Student Dashboard</title>
    </head>
    <body>
        <div class ="card">
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