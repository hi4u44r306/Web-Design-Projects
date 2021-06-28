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
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.
    var homemap, homeinfoWindow;

    function initMap() {
        homemap = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: -34.397,
                lng: 150.644
            },
            zoom: 18,
        });

        homeinfoWindow = new google.maps.InfoWindow();

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    homeinfoWindow.setPosition(pos);
                    homeinfoWindow.setContent("You are here !");
                    homeinfoWindow.open(homemap);
                    homemap.setCenter(pos);
                },
                function() {
                    handleLocationError(true, homeinfoWindow, homemap.getCenter());
                }
            );
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, homeinfoWindow, homemap.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, homeinfoWindow, pos) {
        homeinfoWindow.setPosition(pos);
        homeinfoWindow.setContent(
            browserHasGeolocation ?
            "Error: The Geolocation service failed." :
            "Error: Your browser doesn't support geolocation."
        );
        homeinfoWindow.open(homemap);
    }
    </script>
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnv_Z-OLThDSAb7Wuy64iqD3NleZhY1ZE&callback=initMap">
    </script>

</head>

<body>

    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav__logo">
                <i class="uil uil-scenery nav__icon"></i> Foodmate
            </a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list grid">

                    <li class="nav__item">
                        <a href="#home" class="nav__link active-link">
                            <i class="uil uil-map-marker nav__icon"></i> Map
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#currentevent" class="nav__link">
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
                        <a href="profile.php" class="profile">
                            <i class="uil uil-user nav__icon"></i>
                            || <?php echo $_SESSION['username']; ?> ||
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
        <!--==================== HOME ====================-->
        <section class="home section" id="home">
            <div class="home__container container grid">
                <div class="home__content grid">
                    <div class="home__social">
                        <a href="#" target="_blank" class="home__social-icon">
                            <i class="uil uil-instagram"></i>
                        </a>
                        <a href="#" target="_blank" class="home__social-icon">
                            <i class="uil uil-facebook-f"></i>
                        </a>
                    </div>
                    <div class="home__data">
                        <h1 class="home__title">Foodmate</h1>
                        <h3 class="home__subtitle">Feel lonely ?</h3>
                        <p class="home__description">
                            Hold events to meet more friend
                        </p>
                        <a href="create event.php" class="button button--flex">
                            Create Event <i class="uil uil-message button__icon"></i>
                        </a>
                    </div>
                    <div class="map__container grid" id="map"></div>
                </div>

                <div class="div home__scroll">
                    <a href="#currentevent" class="home__scroll-button button--flex">
                        <i class="uil uil-mouse-alt home__scroll-mouse"></i>
                        <span class="home__scroll-name">Scroll down</span>
                        <i class="uil uil-arrow-down home__scroll-arrow"></i>
                    </a>
                </div>
            </div>
        </section>

        <!--==================== Current Event ====================-->
        <section class="event section" id="currentevent">
            <h2 class="section__title">Latest Event</h2>
            <span class="section__subtitle">Free to join</span>

            <div class="event__container container grid">
                <div>
                    <div class="event__info">
                        <div>
                            <img src="img/register.svg" alt="">
                            <span class="event__info-title">Hot Pot</span>
                            <span class="event__info-name">Date : 2020/2/1</span>
                            <span class="event__info-name">Time : 6:30 PM</span>
                            <span class="event__info-name">Members : 2</span>
                            <span class="event__info-name">Location : Taiway,Taoyuan</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer">
        <div class="footer__bg">
            <div class="footer__container container grid">
                <div>
                    <h1 class="footer__title">Foodmate</h1>
                    <span class="footer__subtitle">Hold More Event get More Friends</span>
                </div>
                <div class="footer__socials">
                    <a href="https://www.instagram.com/victor.0203/" target="_blank" class="footer__social">
                        <i class="uil uil-instagram"></i>
                    </a>
                    <a href="https://github.com/hi4u44r306" target="_blank" class="footer__social">
                        <i class="uil uil-facebook-f"></i>
                    </a>
                </div>
            </div>

            <p class="footer__copy">&#169; Victor. All right reserved</p>
        </div>
    </footer>

    <!--==================== SCROLL TOP ====================-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="uil uil-arrow-up scrollup__icon"></i>
    </a>
    <!--==================== SWIPER JS ====================-->
    <script src="js/swiper-bundle.min.js"></script>

    <!--==================== MAIN JS ====================-->
    <script src="js/main.js"></script>
</body>

</html>