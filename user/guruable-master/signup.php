<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fastplus2";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$username = $email = $password = $terms= "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

 

if ($_SERVER['REQUEST_METHOD'] == POST && isset($_POST['submit_button'])){
    $username = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $news = test_input($_POST["news"]);
    $password_crypt=md5($password);
    $sqlemail = "SELECT email  FROM user where email = '$email'";
    $sqlusername = "SELECT username  FROM user where username = '$username'";
    $resultemail = $con->query($sqlemail);
    $resultusername =$con->query($sqlusername);
    if($resultemail->num_rows > 0)
  {
      $emailtaken = "Email Already Exists";
      exit;
  };

  if($resultusername->num_rows>0){
      $usernametaken= "username alredy taken";
      exit;

  }

   $sql1="INSERT INTO user (username,email,password,news) VALUES ('$username', '$email', '$password_crypt',$news)";
        $result1= $con->query($sql1); die("Could Not Perform the Query");
         $sucess = "Registration sucessful kindly login"
  
}






?>