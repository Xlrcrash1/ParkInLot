<?php
require('../SQLconnect.php');
session_start();

$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];


$deleteLocation = "DELETE FROM userLocation WHERE userID = {$_SESSION['userID']};";

$db->query($deleteLocation);


$addLocation = "INSERT INTO userLocation (userID, longitude, latitude) VALUES ({$_SESSION['userID']}, {$longitude}, {$latitude})";
$db->query($addLocation);


?>