<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class='main'>
        <h2 class="formheading">ثبت نام</h2>
        <form action="functions.php" method="post">
            <input style="text-align:right" type="text" name="Fname" placeholder="نام" required>
            <input style="text-align:right" type="text" name="Lname" placeholder="نام خانوادگی" required>
            <input style="text-align:right" type="text" name="Pnumber" minlength="11" maxlength="11" placeholder="شماره همراه" required>
            <input style="text-align:right" type="text" name="nationalcode" minlength="10" maxlength="10" placeholder="کد ملی" required>
            <input style="text-align:right" type="password" name="password" placeholder="رمزعبور" required>
            <input style="text-align:right" type="password" name="Rpassword" placeholder="تکرار رمزعبور" required>
            <button type="submit" name="register">ثبت نام</button>
            <a href="login.php" style="color:#00e1ff; font-size: 15px; text-decoration: none;">!قبلا ثبت نام کردید؟؟  وارد شوید</a>
        </form>
    </div>
</body>
</html>