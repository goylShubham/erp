<?php
include_once 'connection.php';

if(empty($_POST['email'])){
	echo "Enter your email!";
	exit();
}else if(empty($_POST['pass'])){
	echo "Enter your password!";
	exit();
}else{
	$email = mysqli_real_escape_string($con,$_POST['email']);
	$pass = mysqli_real_escape_string($con,$_POST['pass']);

	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		echo "Invalid email address!";
		exit();
	}else{
		$loginQuery = mysqli_query($con,"select user_id,user_aadhar,user_mobile,user_password,user_email_verified,user_mobile_verified from user_info where user_email='$email'") or die(mysqli_error($con));
		if(mysqli_num_rows($loginQuery)==1){
			session_start();
			$row = $loginQuery->fetch_assoc();
			if(password_verify($pass,$row['user_password'])){
				$_SESSION['user_email'] = $_POST['email'];
				if($row['user_mobile_verified']==0){
					$_SESSION['user_mobile'] = $row['user_mobile'];
					echo "verify mobile";
					exit();
				}else if($row['user_email_verified']=='false'){	
					$_SESSION['user_email'] = $email;
					echo "verify email";
					exit();
				}else{
					$_SESSION['user_id'] = $row['user_id'];
					setcookie("user_id",$row['user_id']);
					include_once 'sessions.php';

					echo "success";
				}
				exit();
			}else{

				echo "Invalid email or password!";
				exit();
			}
		}else{
			echo "Invalid email or password!";
			exit();
		}
	}
}
?>