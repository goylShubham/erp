<?php
	session_start();
	include_once 'connection.php';

	$id = $_SESSION['vehicle_id'];
	$lat = $_POST['user_lat'];
	$lng = $_POST['user_lng'];

	mysqli_query($con, "update vehicle_info set vehicle_lat=$lat,vehicle_lng=$lng where vehicle_id=$id");
?>