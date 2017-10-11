<?php
session_start();
include_once 'connection.php';

$user_id = $_POST['user_id'];
$user_location = $_POST['user_location'];
$department_id = $_POST['department'];
$user_lat = $_POST['user_lat'];
$user_lng = $_POST['user_lng'];

$getUserQuery = mysqli_query($con,"select aadhar_info.aadhar_name,user_info.user_mobile from user_info,aadhar_info where user_id=$user_id") or die(mysqli_error($con));
$row=$getUserQuery->fetch_assoc();
$user_name = $row['aadhar_name'];
$user_mobile = $row['user_mobile'];

$checkReport = mysqli_query($con,"select report_id from report_info where report_by=$user_id and report_status='initiated' or report_status='ongoing'");
if(mysqli_num_rows($checkReport)>0){
	echo "Emergency already generated!";
	exit();
}else{
	$getHelperQuery = mysqli_query($con,"select vehicle_id,vehicle_email, vehicle_mobile from vehicle_info where department_id =$department_id") or die(mysqli_error($con));

	if(mysqli_num_rows($getHelperQuery)>0){
		$row = $getHelperQuery->fetch_assoc();
		$vehicle_id = $row['vehicle_id'];
		$email = $row['vehicle_email'];
		$mobile = $row['vehicle_mobile'];

		$today = date('Y/m/d');
		$now = date('G:i:s');
		mysqli_query($con,"insert into report_info(report_by,sender_address,sender_lat,sender_lng,report_date,report_time,report_status,vehicle_id) values($user_id,'$user_location',$user_lat,$user_lng,'$today','$now','initiated',$vehicle_id)") or die(mysqli_error($con));	

		$_SESSION['report_initiated'] = true;

		$emailMessage = "An Emergency generated!<br/>Requestor: ".$user_name."<br/>Mobile: ".$user_mobile."<br/>Location: ".$user_location;
		$mobileMessage = "An Emergency generated!\nRequestor: ".$user_name."\nMobile: ".$user_mobile."\nLocation: ".$user_location;
		sendSMS($mobile,$mobileMessage);
		sendGmail($email,"New Emergency Request!",$emailMessage);
	}else{
		echo "Vehicle found to request!";
	}
}

function sendGmail($receiver,$subject,$body){
	require '../phpmailer/PHPMailerAutoLoad.php';

	$mail = new PHPMailer;
	$mail->Host = 'smtp.gmail.com';
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
	$mail->Username = 'magarchsstm@gmail.com';
	$mail->Password = 'magarSaimonThada';
	$mail->From = "magarchsstm@gmail.com";
	$mail->FromName = "IERP";

	$mail->addAddress($receiver);
	$mail->isHTML(true);

	$mail->Subject = $subject;
	$mail->Body = $body;

	if(!$mail->send()) 
	{
		echo "Error sending email. Try again later!";
	} 
}

function sendSMS($receiver,$body){	
	require '../sms/way2sms-api.php';
	$sender = '7508239154';
	$pass = 'shubham';
	$receiver = $receiver;
	$message = $body;

	if(sendWay2SMS($sender,$pass,$receiver,$message)){
		echo "Emergency request generated!";
	}else{
		echo "Error sending message. Try again later!";
	}
}
?>