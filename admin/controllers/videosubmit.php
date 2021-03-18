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


$sucess = array();
$error = array();
if (isset($_POST['submitads'])) {
    $name = $mysqli->real_escape_string($_POST['name']);
    $title = $mysqli->real_escape_string($_POST['title']);
    $video = trim($_FILES["video"]['name']);
    $thumbnail = trim($_FILES["thumbnail"]['name']);
    $videot = $_FILES["video"]['tmp_name'];
    $thumbnailt = $_FILES["thumbnail"]['tmp_name'];
    $video_dir = "videos/" . $video;
    $image_dir = "thumbnail/" . $thumbnail;
    $videoFileType = strtolower(pathinfo($video, PATHINFO_EXTENSION));
    $imageFileType = strtolower(pathinfo($thumbnail, PATHINFO_EXTENSION));
    echo  $imageFileType;
    if ($videoFileType != "mp4") {
        array_push($error, "Sorry, only mp4 files are allowed.");
    } else if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        array_push($error, "Sorry, only , jpg && png files are allowed.");
    } else {
        move_uploaded_file($videot, $video_dir);
        move_uploaded_file($thumbnailt, $image_dir);
        $sql = "INSERT INTO video_ads (ads_name,ads_title,ads_video,thumbnail) VALUES( '$name','$title','$video','$thumbnail')";
        $queries = $mysqli->query($sql);
        // if (!$queries) {
        //printf("Errormessage: %s\n", $mysqli->error);
        //}
        if ($queries) {
            array_push($sucess, "uploaded");
        }
    }
}
//images _ads
if (isset($_POST['submitImageads'])) {
    $display = $_POST['imagedisplay'];
    $ads_link = $mysqli->real_escape_string($_POST['ads_link']);
    $position = $_POST['imageposition'];
    $ads_image = $_FILES["ads_image"]['name'];
    $ads_imagef = $_FILES["ads_image"]['tmp_name'];
    $imageFile = strtolower(pathinfo($ads_image, PATHINFO_EXTENSION));
    $ads_imagedir = "images/" .  $ads_imagef;
    if ($imageFile != "jpg" && $imageFile != "png" && $imageFile != "jpeg") {
        array_push($error, "Sorry, only , jpg && png files are allowed.");
    } else {
        move_uploaded_file($ads_imagef, $ads_imagedir);
        $sql = "INSERT INTO image_ads (display,adslinks,adsimage,position) VALUES('$display','$ads_link','$ads_image','$position')";
        $queries = $mysqli->query($sql);
        if ($queries) {
            array_push($sucess, "Data sucessful uploaded");
        }
        if (!$queries) {
            printf("Errormessage: %s\n", $mysqli->error);
        }
    }
}

//google_ads
if (isset($_POST['googlesubmit'])) {
    $adertising_link = $mysqli->real_escape_string($_POST['adertising_link']);
    $adertising_link = $mysqli->real_escape_string($_POST['adertising_link']);
    $sql = "INSERT INTO google_ads (adslink,adstag) VALUES('$adertising_link','$adertising_link')";
    $queries = $mysqli->query($sql);
    if ($queries) {
        array_push($sucess, "Data sucessful inserted");
    }
    if (!$queries) {
        printf("Errormessage: %s\n", $mysqli->error);
    }
}

//cts ads 
if (isset($_POST['submitcta'])) {
    $cta_deiplay = $_POST['ctadisplay'];
    $ctatext = $mysqli->real_escape_string($_POST['cta_text']);
    $redirectlink = $mysqli->real_escape_string($_POST['redirectlink']);
    $textcolor = $_POST['textcolor'];
    $buttoncolor = $_POST['buttoncolor'];
    $cta_position = $_POST['cta_position'];
    $sql = "INSERT INTO cta_ads (display,cattext,redirectlink,textcolor,buttoncolor,position) VALUES('$cta_deiplay','$ctatext',' $redirectlink',' $textcolor','$buttoncolor','$cta_position')";
    $queries = $mysqli->query($sql);
    if ($queries) {
        array_push($sucess, "Data sucessful uploaded");
    }
    if (!$queries) {
        printf("Errormessage: %s\n", $mysqli->error);
    }
}


//optin form
if (isset($_POST['submitoptin'])) {
    $opt_display = $_POST['opt_display'];
    $optin_text = $mysqli->real_escape_string($_POST['optin_text']);
    $optin_color = $_POST['optin_color'];
    $custom_code = $_POST['custom_code'];
    $optin_position = $_POST['optin_position'];
    $sql = "INSERT INTO aptin_form (display,ctatext,textcolor,custoomcode,position) VALUES('$opt_display','$optin_text','  $optin_color',' $custom_code','$optin_position ')";
    $queries = $mysqli->query($sql);
    if ($queries) {
        array_push($sucess, "Data sucessful inserted");
    }
    if (!$queries) {
        printf("Errormessage: %s\n", $mysqli->error);
    }
}
// buy buttons 
if (isset($_POST['submitbuybutton'])) {
    $button_display = $_POST['button_display'];
    $button_link = $mysqli->real_escape_string($_POST['button_link']);
    $button_style = $_POST['button_style'];
    $button_position = $_POST['button_position'];
    $sql = "INSERT INTO buy_button (display,redirect_link,button_style,position) VALUES('$button_display','$button_link','$button_style ','$button_position')";
    $queries = $mysqli->query($sql);
    if ($queries) {
        array_push($sucess, "Data sucessful inserted");
    }
    if (!$queries) {
        printf("Errormessage: %s\n", $mysqli->error);
    }
}
