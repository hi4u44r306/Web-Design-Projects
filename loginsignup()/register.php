<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
        <h2>Sign Up</h2>
    </div>

    <form method="post" action="register.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1" placeholder="Password">
        </div>
        <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2" placeholder="Confirm Password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Register</button>
        </div>
        <p>
            <b>Already a member?<a href="login.php"> Sign in</a></b>
        </p>
    </form>
    <img class="image_1" src="img/log.svg" alt="">
    <img class="image_2" src="img/register.svg" alt="">
</body>

</html>