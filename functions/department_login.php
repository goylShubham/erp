<?php

	session_start();
	include_once 'connection.php';

	if(empty($_POST['email'])){
		echo "Enter your email!";
		exit();
	}else if(empty($_POST['pass'])){
		echo "Enter your password!";
		exit();
	}else{
		$email = $_POST['email'];
		$pass = $_POST['pass'];

		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			echo "Invalid email address!";
			exit();
		}else{
			$loginQuery = mysqli_query($con,"select department_info.department_vehicle,vehicle_info.* from department_info,vehicle_info where department_info.department_id=vehicle_info.department_id and vehicle_info.vehicle_email='$email'") or die(mysqli_error($con));

			if(mysqli_num_rows($loginQuery)==1){
				$row = $loginQuery->fetch_assoc();
				$dbPass = $row['vehicle_password'];
				if($dbPass != $pass){
					echo "Invalid email or password!";
					exit();					
				}else{
					$_SESSION['vehicle_id'] = $row['vehicle_id'];
					$_SESSION['vehicle_name'] = $row['department_vehicle'];
					$_SESSION['vehicle_email'] = $row['vehicle_email'];
					echo "success";
				}
			}else{
				echo "Invalid email or password!";
				exit();
			}
		}
	}

?>