<?php

include_once 'connection.php';

$type = $_POST['type'];
$eamil = $_POST['email'];
$code = $_POST['code'];
$matchCode = $_POST['matchCode'];

if($code != $matchCode){
	echo "Invalid verification code!";
	exit();
}else{
	if($type=='mobile'){
		$updateMobileVerification = mysqli_query($con,"update user_info set user_mobile_verified=1 where user_email=$email");
		echo "Mobile Registered";
		exit();
	}else if($type=='email'){

	}
}

?>