<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="auth.css">
</head>

<body>
    <div class="header">
        <h2>Login</h2>
    </div>

    <form method="post" action="login.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Username">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="login_user">Login</button>
        </div>
        <p>
            <b>Not yet a member? <a href="register.php">Sign up</a></b>
        </p>

    </form>
    <img class="image_1" src="img/log.svg" alt="">
    <img class="image_2" src="img/register.svg" alt="">
</body>

</html>