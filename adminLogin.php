<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="adminDashboard.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <title>Welcome Admin!</title>
    </head>
    <body>
        <form method="post" action="adminLogin.php">
            <h1>Recyle and Earn</h1>
            <p>Username:</p>
            <div class="username_txtbox">
                <input type="text" placeholder="Enter username" name="userName">
            </div>
            <p>Password:</p>
            <div class="password_txtbox">
                <input type="passWord" placeholder="Enter password" name="passWord">
            </div>
            <input type="submit" value="Login" class="loginBtn" name="login_Btn">
        </form>
    </body>
</html>
<?php
$conn = mysqli_connect("localhost", "root", "", "owner_login"); // specify the database name
if(isset($_POST['login_Btn'])){
    $userName = $_POST['userName'];
    $passWord = $_POST['passWord'];
    $sql = "SELECT * FROM owner_details WHERE userName = '$userName' AND passWord = '$passWord'";
    $result = mysqli_query($conn, $sql); // execute the query

    if ($result) { // check if the query was successful
        if (mysqli_num_rows($result) > 0) { // check if any rows were returned
            // Redirect to dashboard if username and password match
            header('Location: adminDashboard.php');
            exit(); // stop further execution
        } else {
            echo "<script>alert('Invalid username or password!');</script>";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_free_result($result); // free the result set
    mysqli_close($conn); // close the connection
}
?>