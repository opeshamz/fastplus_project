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
$errors=array();
$sucess=array();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_button'])){
    $username = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $confirm_password = $_POST["confirm-password"];
   
    $password_crypt=md5($password);
    if($password !== $confirm_password){
      array_push($errors, "The two passwords do not match");
   
    }
    $sqlemail = "SELECT *  FROM user WHERE email = '$email' OR  username = '$username'  LIMIT 1";
    $check = $con->query($sqlemail);
    $user = $check->fetch_assoc();

    if($user['username']== $username){
      array_push($errors, "Email Already exists");
    }
   if($user['email']== $email){
      array_push($errors, "Username already taken");
    }
  
      $sqlreg="INSERT INTO user (username,email,password) VALUES ('$username', '$email', '$password_crypt')";
      $result1= $con->query($sqlreg);
       if($result1){
            array_push($sucess, "Registration sucessful kindly login");
         
          }
    


}

?>