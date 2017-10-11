<?php
	session_start();
	include_once 'connection.php';

	$report_id = $_POST['report_id'];
	$getLatLngQuery = mysqli_query($con,"select report_info.sender_lat,report_info.sender_lng,vehicle_info.vehicle_lat,vehicle_info.vehicle_lng from report_info,vehicle_info where report_info.report_id=$report_id and vehicle_info.vehicle_id=report_info.vehicle_id");

	$row = $getLatLngQuery->fetch_assoc();
	echo "success ";
	echo $row['sender_lat']." ";
	echo $row['sender_lng']." ";
	echo $row['vehicle_lat']." ";
	echo $row['vehicle_lng'];
?>