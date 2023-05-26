<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class='main'>
        <h1>خوش آمدید</h1>
        <center>
            <button type="submit" class="newpost" onclick="window.open('createpost.php');">پست جدید</button><br>
            <a href="logout.php" class="link-signin" style="text-align:center;">خروج</a>
        </center>
    </div>
</body>
</html>