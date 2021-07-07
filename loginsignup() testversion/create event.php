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
    <link rel="stylesheet" type="text/css" href="create event.css">
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
                        <a href="#" class="nav__link active-link">
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
        <!--==================== CREATE EVENT ====================-->
        <section class="create section" id="create" method="post" action="create event.php">
            <div class="create__container container">
                <div class="main-container">
                    <div class="left-container grid">
                        <h4><i class="uil uil-upload create__icon"></i> Upload Your Event Image</h4>
                        <input type="file" name="eventimage" />
                        <div class="create__content">
                            <label for="" class="create__label">Event Name</label>
                            <input type="text" class="input-field" id="eventname" name="eventname">
                        </div>
                        <div class="create__content">
                            <label for="" class="create__label">Date</label>
                            <input type="date" class="input-field" id="eventname" name="eventdate">
                        </div>
                        <div class="create__content">
                            <label for="" class="create__label">Time</label>
                            <input type="time" class="input-field" id="eventname" name="eventtime">
                        </div>
                        <div class="create__content">
                            <label for="" class="create__label">Members</label>
                            <input type="number" class="input-field" id="eventname" name="eventmember">
                        </div>
                        <div class="create__content">
                            <label for="" class="create__label">Description</label>
                            <input type="text" class="input-field" id="eventdescription" name="eventdescription">
                        </div>
                        <button type="submit" class="btn create-btn" name="create-event">Create Event</button>
                    </div>

                    <div class="right-container" id="app">
                        <div class="half-containers-up">
                            <h4><i class="uil uil-search-alt create__icon"></i></i> Search Restaurant：</h4>
                            <!-- 搜尋框 -->
                            <div class="create__content">
                                <label for="" class="create__label">Search Restaurant:</label>
                                <input type="text" class="input-field" ref="site" v-model="site" id="address"
                                    name="eventlocation">
                            </div>
                        </div>
                        <div class="half-containers-down">
                            <!-- 放google map的div -->
                            <div id="createmap" class="embed-responsive embed-responsive-4by3"></div>

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
        </section>
    </main>
    <!--==================== SWIPER JS ====================-->
    <script src="js/swiper-bundle.min.js"></script>

    <!--==================== MAIN JS ====================-->
    <script src="js/main.js"></script>
</body>


<?php

// initializing variables
$eventimage = "";
$eventname = "";
$eventdate = "";
$eventtime = "";
$eventmember = "";
$eventdescription = "";
$eventlocation = "" ;

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'create_event');

// REGISTER USER
if (isset($_POST['create_event'])) {
  // receive all input values from the form
  $eventimage = mysqli_real_escape_string($db, $_POST['eventimage']);
  $eventname = mysqli_real_escape_string($db, $_POST['eventname']);
  $eventdate = mysqli_real_escape_string($db, $_POST['eventdate']);
  $eventtime = mysqli_real_escape_string($db, $_POST['eventtime']);
  $eventmember = mysqli_real_escape_string($db, $_POST['eventmember']);
  $eventdescription = mysqli_real_escape_string($db, $_POST['eventdescription']);
  $eventlocation = mysqli_real_escape_string($db, $_POST['eventlocation']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($eventname)) { array_push($errors, "Eventname is required"); }
  if (empty($eventdate)) { array_push($errors, "Date is required"); }
  if (empty($eventtime)) { array_push($errors, "Time is required"); }
  if (empty($eventmember)) { array_push($errors, "Member is required"); }
  if (empty($eventlocation)) { array_push($errors, "Please filled in address"); }
  

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
//   $user_check_query = "SELECT * FROM events WHERE eventimage='$eventimage' OR email='$email' LIMIT 1";
//   $result = mysqli_query($db, $user_check_query);
//   $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}


// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>

<?php


    
    $mysqli = new mysqli('localhost','root','','create_event') or die($mysqli->connect_error);
    $table = 'events'



?>

</html>