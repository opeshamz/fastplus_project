<?php
include("controllersignup.php");
session_start();
// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = $con->real_escape_string( $_POST['email']);
  $password = $con->real_escape_string($_POST['password']);
  

  if (empty($email)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM user WHERE email ='$email' AND password='$password'";
  	$results = $con->query($query);
	
  	if ($results->num_rows == 1) {
  	$_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
        $_SESSION['id'] = $ID;
  	  header('location: Dashboard');

  	}else {
  		array_push($errors, "Wrong Email/password");
  	}
  }
}

?>