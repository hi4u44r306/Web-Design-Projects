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