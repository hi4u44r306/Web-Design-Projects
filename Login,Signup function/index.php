<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <div class="header">
        <h2>Home Page</h2>
        <!-- logged in user information -->
        <?php  if (isset($_SESSION['username'])) : ?>
        <p>Welcome <strong class="welcomemsg"><?php echo $_SESSION['username']; ?></strong></p>
        <button class="smallbtn"><a href="index.php?logout='1'">LOGOUT</a></button>
        <b>
            <p class="logoutmsg"> <a href="index.php?logout='1'">LOGOUT</a>
            </p>
        </b>
        <?php endif ?>
    </div>
    <div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success">
            <h3>
                <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
            </h3>
        </div>
        <?php endif ?>
        <img class="image" src="img/log.svg" alt="">
    </div>

</body>

</html>