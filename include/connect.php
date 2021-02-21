<?php
$mysqli = new mysqli($db_config['host'], $db_config['user'], $db_config['pass'], $db_config['name']);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$mysqli->set_charset("utf8");

$is_installed = $mysqli->query("SHOW TABLES FROM $db_config[name]");
$tables_number = $is_installed->num_rows;