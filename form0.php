<html>
<head>
    <title>Recycle Earn</title>
    <style>
        body{
            background: linear-gradient(to bottom, #053d02, #187f13, #18d22e, #60ff04);
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .container{
            text-align: center;
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
        h1{
            text-align: center;
            margin-bottom: 65px;
            color: yellow;
            font-size: 45px;
            font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-weight:400;
        }
        p{
            text-align: center;
            margin-bottom: 5px;
            color: #ffff;
            font-size: 18px;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .studentBtn{
            height: 45px;
            width: 60%;
            margin-top: 15px;
            border: none;
            outline: none;
            background: #053d02;
            background-size: 200%;
            color: white;
            font-size: 16px;
        }
        .studentBtn:hover {
            background-color: #0bd830; /* New background color when hovering */
            background-position: center;
            font-size: 16px;
            color: black;

        }
        .adminBtn{
            height: 45px;
            width: 60%;
            margin-top: 15px;
            border: none;
            outline: none;
            background: #053d02;
            background-size: 200%;
            color: white;
            font-size: 16px;
        }
        .adminBtn:hover {
            background-color: #0bd830; /* New background color when hovering */
            background-position: center;
            font-size: 16px;
            color: black;
        }
    </style>
</head>
<body>
    <form>
        <h1>Recycle and Earn</h1>
        <p>Select your Role:</p>
        <div class="container">
            <input type="submit" value="Student User" class="studentBtn" name="student_Btn" formaction="studentLogin.php" target="_blank">
            <input type="submit" value="System Admin" class="adminBtn" name="admin_Btn" formaction="adminLogin.php" target="_blank">
        </div>
    </form>
</body>
</html>