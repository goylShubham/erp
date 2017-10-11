<?php

require 'phpmailer/PHPMailerAutoLoad.php';

$mail = new PHPMailer;
$mail->Host = 'smtp.gmail.com';
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->Username = '';
$mail->Password = '';
$mail->From = "";
$mail->FromName = "IERP";

$mail->addAddress($_POST['receiver']);
$mail->isHTML(true);

$mail->Subject = $_POST['subject'];
$mail->Body = $_POST['body'];

if(!$mail->send()) 
{
	echo "Error sending email. Try again later!";
} 
else 
{
    echo $_POST['successMessage'];
}
?>