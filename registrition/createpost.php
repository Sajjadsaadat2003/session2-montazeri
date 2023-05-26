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
    <title>پست جدید</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="process.php" method="post">
        <div class='main'>
            <h1>ایجاد پست جدید</h1>
            <input type="text" name="title" class="title" placeholder="تیتر" required>
            <input type="text" name="textful" class="textful" placeholder="شرح" required>
            <button type="submit" name="createpost">ثبت</button>
        </div>
    </form>
</body>
</html>