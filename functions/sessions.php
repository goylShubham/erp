<?php

include_once 'connection.php';

$infoQuery = mysqli_query($con,"select aadhar_info.aadhar_name, user_info.user_id, user_info.user_email, user_info.user_mobile from user_info, aadhar_info where user_info.user_id=".$_SESSION['user_id']." and aadhar_info.aadhar_number=user_info.user_aadhar") or die(mysqli_error($con));

$row = $infoQuery->fetch_assoc();

$_SESSION['user_name'] = $row['aadhar_name'];
$_SESSION['user_email'] = $row['user_email'];
$_SESSION['user_mobile'] = $row['user_mobile'];

?>