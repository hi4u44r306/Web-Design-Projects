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
    <!--======================== UNICONS ===========================-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

    <!--======================== CSS ===========================-->
    <link rel="stylesheet" type="text/css" href="profile.css">


</head>

<body>

    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="index.php" class="nav__logo">
                <i class="uil uil-scenery nav__icon"></i> Foodmate
            </a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list grid">

                    <li class="nav__item">
                        <a href="index.php" class="nav__link">
                            <i class="uil uil-map-marker nav__icon"></i> Map
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="index.php?#currentevent" class="nav__link">
                            <i class="uil uil-create-dashboard nav__icon"></i> Current Event
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="create event.php" class="nav__link">
                            <i class="uil uil-file-alt nav__icon"></i> Create Event
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#services" class="nav__link">
                            <i class="uil uil-briefcase-alt nav__icon"></i> Chat
                        </a>
                    </li>
                    <!-- logged in user information -->
                    <?php  if (isset($_SESSION['username'])) : ?>
                    <li class="nav__item">
                        <a href="profile.php" class="nav__link active-link">
                            <i class="uil uil-user nav__icon"></i>
                            User : <?php echo $_SESSION['username']; ?>
                        </a>
                    </li>
                    <?php endif ?>
                    <li class="nav__item">
                        <a href="index.php?logout='1'" class="logout">
                            <i class="uil uil-signout nav__icon"></i> Logout
                        </a>
                    </li>
                </ul>
                <i class="uil uil-times nav__close" id="nav-close"></i>
            </div>
            <div class="nav__btns">
                <!-- Theme change button -->
                <i class="uil uil-moon change-theme" id="theme-button"></i>
                <div class="nav__toggle" id="nav-toggle">
                    <i class="uil uil-apps"></i>
                </div>
            </div>
        </nav>
    </header>

    <!--==================== MAIN ====================-->
    <main class="main">
        <!--==================== CREATE EVENT ====================-->
        <section class="create section" id="create" method="post" action="create event.php">
            <div class="create__container container">
                <div class="left-container grid">
                    <div class="create__content">
                        <label for="" class="create__label">User Name :</label>
                        <?php echo $_SESSION['username']; ?>
                    </div>

                    <div class="create__content">
                        <label for="" class="create__label">Event Name</label>
                        <input type="text" class="input-field" id="eventname" name="eventname">
                    </div>
                    <div class="create__content">
                        <label for="" class="create__label">Date</label>
                        <input type="date" class="input-field" id="eventdate" name="eventdate">
                    </div>
                    <div class="create__content">
                        <label for="" class="create__label">Time</label>
                        <input type="time" class="input-field" id="eventtime" name="eventtime">
                    </div>
                    <div class="create__content">
                        <label for="" class="create__label">Members</label>
                        <input type="number" class="input-field" id="eventmember" name="eventmember">
                    </div>
                    <div class="create__content">
                        <label for="" class="create__label">Description</label>
                        <input type="text" class="input-field" id="eventdescription" name="eventdescription">
                    </div>
                    <button type="submit" class="btn create-btn" name="create-event" id="createeventbutton">Create
                        Event</button>
                </div>
            </div>
        </section>
    </main>

</body>

</html>