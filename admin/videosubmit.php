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


if (isset($_POST['submitads'])) {
    $name = $mysqli->real_escape_string($_POST['name']);
    $title = $mysqli->real_escape_string($_POST['title']);
    $video = $_FILES["video"]['name'];
    $thumbnail = $_FILES["thumbnail"]['name'];
    $video = $_FILES["video"]['tmp_name'];
    $thumbnail = $_FILES["thumbnail"]['tmp_name'];
    $video_dir = "/videos";
    $image_dir = "/thumbnail_image";
    move_uploaded_file($video, $video_dir);
    move_uploaded_file($thumbnail, $image_dir);
    //$target_video = $video_dir . basename($video);
    //$target_image = $image_dir . basename($thumbnail);
    /*$uploadOk = 1;
    $videoFileType = pathinfo($target_video, PATHINFO_EXTENSION);
    $imageFileType = pathinfo($target_image, PATHINFO_EXTENSION);

    // Check if file already exists
    if (file_exists($target_video) && file_exists($target_image)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($videoFileType != "mp4" || $videoFileType != "MP4") {
        echo "Sorry, only mp4 files are allowed.";
        $uploadOk = 0;
    }
    if ($imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "JPG" || $imageFileType != "PNG") {
        echo "Sorry, only , jpg && png files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    }*/
    // else {

    $sql = "INSERT INTO video_ads (ads_name,ads_title,ads_video,thumbnail) VALUES( '$name','$title','$video','$thumbnail')";
    $queries = $mysqli->query($sql);
    if (!$queries) {
        printf("Errormessage: %s\n", $mysqli->error);
    }

    echo "uploaded";
    //  }
}
