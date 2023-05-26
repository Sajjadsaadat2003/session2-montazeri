<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php if (isset($_SESSION['login'])) : ?>
    <?php header("location: dashboard.php"); ?>
        <?php else : ?>
            <div class='main'>
                <h1>ثبت نام</h1>
                <form action="process.php" method="post">
                    <input type="text" name="firstname" minlength="2" placeholder="نام" required>
                    <input type="text" name="lastname" minlength="2" placeholder="نام خانوادگی" required>
                    <input type="email" name="username" placeholder="ایمیل" required>
                    <input type="password" name="password" minlength="8" placeholder="رمز عبور" required>
                    <input type="password" name="Rpassword" placeholder="تکرار رمزعبور" required>
                    <button type="submit" name="register">ثبت</button>
                    <a href="login.php" class="link-signin">حساب کاربری دارید؟ وارد شوید</a>
                </form>
            </div>
        <?php endif; ?>
</body>
</html>