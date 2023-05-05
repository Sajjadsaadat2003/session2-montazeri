<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php if (isset($_SESSION['login'])) : ?>
        <?= "You are login" ?>
    <?php else : ?>
        <div class='main'>
            <h2 class="formheading">ورود</h2>
            <form action="functions.php" method="post">
                <input style="text-align:right" type="text" name="username" placeholder="کدملی">
                <input style="text-align:right" type="password" name="password" placeholder="رمزعبور">
                <button type="submit" name="login">ورود</button>
                <a href="register.php" style="color:#00e1ff; font-size: 15px; text-decoration: none;">!حساب کاربری ندارید؟؟  ثبت نام کنید</a>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>