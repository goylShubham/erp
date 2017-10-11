<?php

require 'sms/way2sms-api.php';
$sender = '';
$pass = '';
$receiver = $_POST['receiver'];
$message = $_POST['body'];

if(sendWay2SMS($sender,$pass,$receiver,$message)){
	echo $_POST['successMessage'];
}else{
	echo "Error sending message. Try again later!";
}

?>