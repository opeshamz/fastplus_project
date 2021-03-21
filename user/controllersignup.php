<?php
include('include/config.php');
include('include/connect.php');
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "fastplus2";

// Create connection
//$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
//if ($con->connect_error) {
// die("Connection failed: " . $conn->connect_error);
//}
//echo "Connected successfully";
$con = $mysqli;

$username = $email = $password = $terms = "";
$errors = array();
$sucess = array();





if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_button'])) {
  $username = $con->real_escape_string($_POST["username"]);
  $email = $con->real_escape_string($_POST["email"]);
  $password = $con->real_escape_string($_POST["password_signup"]);
  $confirm_password = $con->real_escape_string($_POST["confirm-password"]);

  $password_crypt = md5($password);
  if ($password !== $confirm_password) {
    array_push($errors, "The two passwords do not match");
  }
  $sqlemail = "SELECT *  FROM user WHERE email = '$email' OR  username = '$username'  LIMIT 1";
  $check = $con->query($sqlemail);
  $user = $check->fetch_assoc();


  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }


  if (count($errors) == 0) {
    $sqlreg = "INSERT INTO user (username,email,password) VALUES ('$username', '$email', '$password_crypt')";
    $result1 = $con->query($sqlreg);
    if ($result1) {
      array_push($sucess, "Registration sucessful kindly login");
    }
  }
}
