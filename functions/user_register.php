<?php
	include_once 'connection.php';

	if(empty($_POST['aadhar']) || empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['repass'])){
		echo "All fields are mandatory!";
		exit();
	}else if(!is_numeric($_POST['aadhar'])){
		echo "Aadhar must be numeric!";
		exit();
	}else if($_POST['pass']!=$_POST['repass']){
		echo "Password do not match!";
		exit();		
	}else if($_POST['tnc']===false){
		echo "You have to agree T&C.";
		exit();
	}
	else{
		$aadharNumber = mysqli_real_escape_string($con,$_POST['aadhar']);
		$checkAadhar = mysqli_query($con, "select aadhar_info.aadhar_mobile from aadhar_info where aadhar_number=$aadharNumber") or die(mysqli_error($con));

		$checkUser = mysqli_query($con, "select user_id from user_info where user_aadhar=$aadharNumber") or die(mysqli_error($con));
		if(mysqli_num_rows($checkUser)==1){
			echo "Aadhar already registered!";
			exit();
		}else if(mysqli_num_rows($checkAadhar)==1){
			session_start();
			$row = $checkAadhar->fetch_assoc();
			$mobile = $row['aadhar_mobile'];
			$_SESSION['user_mobile'] = $mobile;
			$email = mysqli_real_escape_string($con,$_POST['email']);
			$hashPass = password_hash($_POST['pass'],PASSWORD_DEFAULT);

			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				echo "Invalid email address!";
				exit();				
			}else if(strlen($_POST['pass'])<8){
				echo "Min password length is 8!";
				exit();
			}else{
				$registerQuery = mysqli_query($con,"insert into user_info(user_aadhar,user_email,user_mobile,user_password) values($aadharNumber,'$email',$mobile,'$hashPass')") or die(mysqli_error($con));
				echo "success";
			}
		}else{
			echo "Invalid aadhar number!";
			exit();
		}
	}
?>