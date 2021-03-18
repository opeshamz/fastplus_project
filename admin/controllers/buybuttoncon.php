<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fastplus2";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);
if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

