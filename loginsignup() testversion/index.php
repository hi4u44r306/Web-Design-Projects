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
    <!--======================== GOOGLE MAP ===========================-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
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

    <!--======================== SWIPER CSS ===========================-->
    <link rel="stylesheet" href="swiper-bundle.min.css" />
    <!--==================== MAP ====================-->

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
                        <a href="#create" class="nav__link">
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
                        <a href="#contact" class="button button--flex">
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

        <!--==================== CREATE EVENT ====================-->
        <section class="create section" id="create">
            <h2 class="section__title">Create Event</h2>
            <span class="section__subtitle">Create your event</span>

            <div class="create__container container">
                <div class="main-container">
                    <div class="left-container grid">
                        <h4><i class="uil uil-upload create__icon"></i> Upload Your Event Image</h4>
                        <input type="file" />
                        <div class="create__content">
                            <label for="" class="contact__label">Event Name</label>
                            <input type="text" class="input-field" id="eventname">
                        </div>
                        <div class="create__content">
                            <label for="" class="contact__label">Date</label>
                            <input type="date" class="input-field" id="eventname">
                        </div>
                        <div class="create__content">
                            <label for="" class="contact__label">Time</label>
                            <input type="time" class="input-field" id="eventname">
                        </div>
                        <div class="create__content">
                            <label for="" class="contact__label">Members</label>
                            <input type="number" class="input-field" id="eventname">
                        </div>
                        <div class="create__content">
                            <label for="" class="contact__label">Description</label>
                            <input type="text" class="input-field" id="eventname">
                        </div>
                    </div>

                    <div class="right-container" id="app">
                        <div class="half-containers-up">
                            <!-- 搜尋框 -->
                            <div class="google-map">
                                <h5> Search restaurant：</h5>
                                <div class="form-group">
                                    <input type="text" class="form-control " ref="site" v-model="site" id="address">
                                </div>
                            </div>
                        </div>
                        <div class="half-containers-down">
                            <!-- 放google map的div -->
                            <div class="google-map">
                                <div id="createmap" class="embed-responsive embed-responsive-16by9"></div>
                            </div>
                        </div>

                        <script
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBupJWuCfekKdvLi2Pra-nO1Mr3GitpO64&libraries=places">
                        </script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
                        <!-- map -->
                        <script>
                        const googleMap = new Vue({
                            el: '#app',
                            data: {
                                map: null,
                                autocomplete: null,
                                site: '',
                                place: null
                            },
                            methods: {
                                initMap() {

                                    let location = {
                                        lat: 24.985208,
                                        lng: 121.343280
                                    };

                                    this.map = new google.maps.Map(document.getElementById('createmap'), {
                                        center: location,
                                        zoom: 17
                                    });
                                },
                                // 地址自動完成 + 地圖的中心移到輸入結果的地址上
                                siteAuto() {

                                    let options = {
                                        componentRestrictions: {
                                            country: 'tw'
                                        } // 限制在台灣範圍
                                    };
                                    this.autocomplete = new google.maps.places.Autocomplete(this.$refs.site,
                                        options);
                                    this.autocomplete.addListener('place_changed', () => {
                                        this.place = this.autocomplete.getPlace();
                                        if (this.place.geometry) {
                                            let searchCenter = this.place.geometry.location;
                                            this.map.panTo(
                                                searchCenter); // panTo是平滑移動、setCenter是直接改變地圖中心

                                            // 放置標記
                                            let marker = new google.maps.Marker({
                                                position: searchCenter,
                                                map: this.map
                                            });

                                            // info window
                                            let infowindow = new google.maps.InfoWindow({
                                                content: this.place.formatted_address
                                            });
                                            infowindow.open(this.map, marker);

                                        }
                                    });
                                }
                            },
                            mounted() {
                                window.addEventListener('load', () => {

                                    this.initMap();
                                    this.siteAuto();

                                });
                            }
                        })
                        </script>
                    </div>
                </div>
            </div>

            </div>
            </div>
            </div>
        </section>


        <!--==================== QUALIFICATION ====================-->
        <section class="qualification section">
            <h2 class="section__title">Qualification</h2>
            <span class="section__subtitle">My personal journey</span>

            <div class="qualification__container container">
                <div class="qualification__tabs">
                    <div class="qualification__button button--flex qualification__active" data-target="#education">
                        <i class="uil uil-graduation-cap qualification__icon"></i>
                        Education
                    </div>

                    <div class="qualification__button button--flex" data-target="#work">
                        <i class="uil uil-briefcase-alt qualification__icon"></i>
                        Work
                    </div>
                </div>

                <div class="qualification__sections">
                    <!--==================== QUALIFICATION CONTENT 1 ====================-->
                    <div class="qualification__content qualification__active" data-content id="education">
                        <!--==================== QUALIFICATION 1 ====================-->
                        <div class="qualification__data">
                            <div>
                                <h3 class="qualification__title">Apply Computing</h3>
                                <span class="qualification__subtitle">Ming Chuan University</span>
                                <div class="qualification__calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    2020 - 2021
                                </div>
                            </div>

                            <div>
                                <span class="qualification__rounder"></span>
                                <span class="qualification__line"></span>
                            </div>
                        </div>

                        <!--==================== QUALIFICATION 2 ====================-->
                        <div class="qualification__data">
                            <div></div>

                            <div>
                                <span class="qualification__rounder"></span>
                                <span class="qualification__line"></span>
                            </div>

                            <div>
                                <h3 class="qualification__title">Web Design</h3>
                                <span class="qualification__subtitle">Ming Chuan University</span>
                                <div class="qualification__calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    2018 - 2019
                                </div>
                            </div>
                        </div>

                        <!--==================== QUALIFICATION 3 ====================-->
                        <div class="qualification__data">
                            <div>
                                <h3 class="qualification__title">Web Developer</h3>
                                <span class="qualification__subtitle">MCU Lab</span>
                                <div class="qualification__calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    2017 - 2018
                                </div>
                            </div>

                            <div>
                                <span class="qualification__rounder"></span>
                                <span class="qualification__line"></span>
                            </div>
                        </div>
                        <!--==================== QUALIFICATION 4 ====================-->
                        <div class="qualification__data">
                            <div></div>

                            <div>
                                <span class="qualification__rounder"></span>
                                <!-- <span class="qualification__line"></span> -->
                            </div>

                            <div>
                                <h3 class="qualification__title">UX/UI Designer</h3>
                                <span class="qualification__subtitle">MCU Lab</span>
                                <div class="qualification__calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    2016 - 2017
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--==================== QUALIFICATION CONTENT 2 ====================-->
                    <div class="qualification__content" data-content id="work">
                        <!--==================== QUALIFICATION 1 ====================-->
                        <div class="qualification__data">
                            <div>
                                <h3 class="qualification__title">Software Engineer</h3>
                                <span class="qualification__subtitle">Microsoft - Taiwan</span>
                                <div class="qualification__calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    2020 - Present
                                </div>
                            </div>

                            <div>
                                <span class="qualification__rounder"></span>
                                <span class="qualification__line"></span>
                            </div>
                        </div>

                        <!--==================== QUALIFICATION 2 ====================-->
                        <div class="qualification__data">
                            <div></div>

                            <div>
                                <span class="qualification__rounder"></span>
                                <span class="qualification__line"></span>
                            </div>

                            <div>
                                <h3 class="qualification__title">Frontend Developer</h3>
                                <span class="qualification__subtitle">MCU Lab</span>
                                <div class="qualification__calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    2018 - 2019
                                </div>
                            </div>
                        </div>

                        <!--==================== QUALIFICATION 3 ====================-->
                        <div class="qualification__data">
                            <div>
                                <h3 class="qualification__title">UI Designer</h3>
                                <span class="qualification__subtitle">SOHO</span>
                                <div class="qualification__calendar">
                                    <i class="uil uil-calendar-alt"></i>
                                    2017 - 2018
                                </div>
                            </div>

                            <div>
                                <span class="qualification__rounder"></span>
                                <!-- <span class="qualification__line"></span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--==================== SERVICES ====================-->
        <section class="services section" id="services">
            <h2 class="section__title">Services</h2>
            <span class="section__subtitle">What I offer</span>

            <div class="services__container container grid">
                <!--==================== SERVICES 1 ====================-->
                <div class="services__content">
                    <div>
                        <i class="uil uil-web-grid services__icon"></i>
                        <h3 class="services__title">
                            UI/UX <br />
                            Designer
                        </h3>
                    </div>
                    <span class="
                    button button--flex button--small button--link
                    services__button
                ">
                        View More
                        <i class="uil uil-arrow-right button__icon"></i>
                    </span>
                    <div class="services__modal">
                        <div class="services__modal-content">
                            <h4 class="services__modal-title">
                                UI/UX <br />
                                Designer
                            </h4>
                            <i class="uil uil-times services__modal-close"></i>
                            <ul class="services__modal-services grid">
                                <li class="services__modal-service">
                                    <i class="uil uil-check-circle services__modal-icon"></i>
                                    <p>I develop the user interface.</p>
                                </li>
                                <li class="services__modal-service">
                                    <i class="uil uil-check-circle services__modal-icon"></i>
                                    <p>Web page development.</p>
                                </li>
                                <li class="services__modal-service">
                                    <i class="uil uil-check-circle services__modal-icon"></i>
                                    <p>I create UX element interactions.</p>
                                </li>
                                <li class="services__modal-service">
                                    <i class="uil uil-check-circle services__modal-icon"></i>
                                    <p>I position your company brand.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--==================== SERVICES 2 ====================-->
                <div class="services__content">
                    <div>
                        <i class="uil uil-arrow services__icon"></i>
                        <h3 class="services__title">
                            Frontend <br />
                            Developer
                        </h3>
                    </div>
                    <span class="
                    button button--flex button--small button--link
                    services__button
                ">
                        View More
                        <i class="uil uil-arrow-right button__icon"></i>
                    </span>
                    <div class="services__modal">
                        <div class="services__modal-content">
                            <h4 class="services__modal-title">
                                Frontend <br />
                                Developer
                            </h4>
                            <i class="uil uil-times services__modal-close"></i>
                            <ul class="services__modal-services grid">
                                <li class="services__modal-service">
                                    <i class="uil uil-check-circle services__modal-icon"></i>
                                    <p>I develop the user interface.</p>
                                </li>
                                <li class="services__modal-service">
                                    <i class="uil uil-check-circle services__modal-icon"></i>
                                    <p>Web page development.</p>
                                </li>
                                <li class="services__modal-service">
                                    <i class="uil uil-check-circle services__modal-icon"></i>
                                    <p>I create UX element interactions.</p>
                                </li>
                                <li class="services__modal-service">
                                    <i class="uil uil-check-circle services__modal-icon"></i>
                                    <p>I position your company brand.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--==================== SERVICES 3 ====================-->
                <div class="services__content">
                    <div>
                        <i class="uil uil-pen services__icon"></i>
                        <h3 class="services__title">
                            Branding <br />
                            Designer
                        </h3>
                    </div>
                    <span class="
                    button button--flex button--small button--link
                    services__button
                ">
                        View More
                        <i class="uil uil-arrow-right button__icon"></i>
                    </span>
                    <div class="services__modal">
                        <div class="services__modal-content">
                            <h4 class="services__modal-title">
                                Branding <br />
                                Designer
                            </h4>
                            <i class="uil uil-times services__modal-close"></i>
                            <ul class="services__modal-services grid">
                                <li class="services__modal-service">
                                    <i class="uil uil-check-circle services__modal-icon"></i>
                                    <p>I develop the user interface.</p>
                                </li>
                                <li class="services__modal-service">
                                    <i class="uil uil-check-circle services__modal-icon"></i>
                                    <p>Web page development.</p>
                                </li>
                                <li class="services__modal-service">
                                    <i class="uil uil-check-circle services__modal-icon"></i>
                                    <p>I create UX element interactions.</p>
                                </li>
                                <li class="services__modal-service">
                                    <i class="uil uil-check-circle services__modal-icon"></i>
                                    <p>I position your company brand.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--==================== PORTFOLIO ====================-->
        <section class="portfolio section" id="portfolio">
            <h2 class="section__title">Portfolio</h2>
            <span class="section__subtitle">Most recent work</span>

            <div class="portfolio__container container swiper-container">
                <div class="swiper-wrapper">
                    <!--==================== PORTFOLIO 1 ====================-->
                    <div class="portfolio__content grid swiper-slide">
                        <img src="img/portfolio1.jpg" alt="" class="portfolio__img" />

                        <div class="portfolio__data">
                            <h3 class="portfolio__title">Mordern Website</h3>
                            <p class="portfolio__description">
                                Website adaptable to all devices, with ul components and
                                animated interactions.
                            </p>
                            <a href="" class="button button--flex button--small portfolio__button">Demo
                                <i class="uil uil-arrow-right button__icon"></i>
                            </a>
                        </div>
                    </div>

                    <!--==================== PORTFOLIO 2 ====================-->
                    <div class="portfolio__content grid swiper-slide">
                        <img src="img/portfolio2.jpg" alt="" class="portfolio__img" />

                        <div class="portfolio__data">
                            <h3 class="portfolio__title">Brand Design</h3>
                            <p class="portfolio__description">
                                Website adaptable to all devices, with ul components and
                                animated interactions.
                            </p>
                            <a href="" class="button button--flex button--small portfolio__button">Demo
                                <i class="uil uil-arrow-right button__icon"></i>
                            </a>
                        </div>
                    </div>

                    <!--==================== PORTFOLIO 3 ====================-->
                    <div class="portfolio__content grid swiper-slide">
                        <img src="img/portfolio3.jpg" alt="" class="portfolio__img" />

                        <div class="portfolio__data">
                            <h3 class="portfolio__title">Online Store</h3>
                            <p class="portfolio__description">
                                Website adaptable to all devices, with ul components and
                                animated interactions.
                            </p>
                            <a href="" class="button button--flex button--small portfolio__button">Demo
                                <i class="uil uil-arrow-right button__icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next">
                    <i class="uil uil-angle-right-b swiper-portfolio-icon"></i>
                </div>
                <div class="swiper-button-prev">
                    <i class="uil uil-angle-left-b swiper-portfolio-icon"></i>
                </div>
                <!--Add Pagination-->
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <!--==================== PROJECT IN MIND ====================-->
        <section class="project section">
            <div class="project__bg">
                <div class="project__container container grid">
                    <div class="project__data">
                        <h2 class="project__title">You have a new project</h2>
                        <p class="project__description">
                            Contact now and get a 30% discount on your new project.
                        </p>
                        <a href="#contact" class="button button--flex button--white">
                            Contact Me
                            <i class="uil uil-message project__icon button__icon"></i>
                        </a>
                    </div>

                    <img src="img/me.jpg" alt="" class="project__img" />
                </div>
            </div>
        </section>

        <!--==================== TESTIMONIAL ====================-->
        <section class="testimonial section">
            <h2 class="section__title">Testimonial</h2>
            <span class="section__subtitle">My client saying</span>

            <div class="testimonial__container container swiper-container">
                <div class="swiper-wrapper">
                    <!--==================== TESTIMONIAL 1 ====================-->
                    <div class="testimonial__content swiper-slide">
                        <div class="testimonial__data">
                            <div class="testimonial__header">
                                <img src="img/testimonial1.jpg" alt="" class="testimonial__img" />

                                <div>
                                    <h3 class="testimonial__name">Sara Smith</h3>
                                    <span class="testimonial__client">Client</span>
                                </div>
                            </div>

                            <div>
                                <i class="uil uil-star testimonial__icon"></i>
                                <i class="uil uil-star testimonial__icon"></i>
                                <i class="uil uil-star testimonial__icon"></i>
                                <i class="uil uil-star testimonial__icon"></i>
                            </div>
                        </div>

                        <p class="testimonial__description">Very good</p>
                    </div>

                    <!--==================== TESTIMONIAL 2 ====================-->
                    <div class="testimonial__content swiper-slide">
                        <div class="testimonial__data">
                            <div class="testimonial__header">
                                <img src="img/testimonial2.jpg" alt="" class="testimonial__img" />

                                <div>
                                    <h3 class="testimonial__name">Alan</h3>
                                    <span class="testimonial__client">Client</span>
                                </div>
                            </div>

                            <div>
                                <i class="uil uil-star testimonial__icon"></i>
                                <i class="uil uil-star testimonial__icon"></i>
                                <i class="uil uil-star testimonial__icon"></i>
                                <i class="uil uil-star testimonial__icon"></i>
                                <i class="uil uil-star testimonial__icon"></i>
                            </div>
                        </div>

                        <p class="testimonial__description">Victor is the best</p>
                    </div>

                    <!--==================== TESTIMONIAL 3 ====================-->
                    <div class="testimonial__content swiper-slide swiper-slide">
                        <div class="testimonial__data">
                            <div class="testimonial__header">
                                <img src="img/testimonial3.jpg" alt="" class="testimonial__img" />

                                <div>
                                    <h3 class="testimonial__name">Alex</h3>
                                    <span class="testimonial__client">Client</span>
                                </div>
                            </div>

                            <div>
                                <i class="uil uil-star testimonial__icon"></i>
                                <i class="uil uil-star testimonial__icon"></i>
                                <i class="uil uil-star testimonial__icon"></i>
                                <i class="uil uil-star testimonial__icon"></i>
                            </div>
                        </div>

                        <p class="testimonial__description">Excellent</p>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination swiper-pagination-testimonial"></div>
            </div>
        </section>

        <!--==================== CONTACT ME ====================-->
        <section class="contact section" id="contact">
            <h2 class="section__title">Contact Me</h2>
            <span class="section__subtitle">Get in touch</span>

            <div class="contact__container container grid">
                <div>
                    <div class="contact__information">
                        <i class="uil uil-phone contact__icon"></i>

                        <div>
                            <h3 class="contact__title">Call Me</h3>
                            <span class="contact__subtitle">(+886)0908525057</span>
                        </div>
                    </div>

                    <div class="contact__information">
                        <i class="uil uil-envelope contact__icon"></i>

                        <div>
                            <h3 class="contact__title">Email</h3>
                            <span class="contact__subtitle">victorhsu0203@gmail.com</span>
                        </div>
                    </div>

                    <div class="contact__information">
                        <i class="uil uil-map-marker contact__icon"></i>

                        <div>
                            <h3 class="contact__title">Location</h3>
                            <span class="contact__subtitle">Taoyuan - Taiwan</span>
                        </div>
                    </div>
                </div>

                <form action="" class="contact__form grid">
                    <div class="contact__inputs grid">
                        <div class="contact__content">
                            <label for="" class="contact__label">Name</label>
                            <input type="text" class="contact__input" />
                        </div>
                        <div class="contact__content">
                            <label for="" class="contact__label">Email</label>
                            <input type="email" class="contact__input" />
                        </div>
                    </div>
                    <div class="contact__content">
                        <label for="" class="contact__label">Project</label>
                        <input type="text" class="contact__input" />
                    </div>
                    <div class="contact__content">
                        <label for="" class="contact__label">Message</label>
                        <textarea name="" id="" cols="0" rows="7" class="contact__input"></textarea>
                    </div>

                    <div>
                        <a href="#" class="button button--flex">
                            Send Message
                            <i class="uil uil-message"></i>
                        </a>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer">
        <div class="footer__bg">
            <div class="footer__container container grid">
                <div>
                    <h1 class="footer__title">Victor</h1>
                    <span class="footer__subtitle">Frontend Developer</span>
                </div>

                <ul class="footer__links">
                    <li>
                        <a href="#services" class="footer__link">Services</a>
                    </li>
                    <li>
                        <a href="#portfolio" class="footer__link">Portfolio</a>
                    </li>
                    <li>
                        <a href="#contact" class="footer__link">Contactme</a>
                    </li>
                </ul>

                <div class="footer__socials">
                    <a href="https://www.instagram.com/victor.0203/" target="_blank" class="footer__social">
                        <i class="uil uil-instagram"></i>
                    </a>
                    <a href="https://github.com/hi4u44r306" target="_blank" class="footer__social">
                        <i class="uil uil-github-alt"></i>
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