<?php
	session_start();
	include_once 'connection.php';
	$type = $_POST['type'];
	$value;
	if(isset($_POST['value'])){
		$value = $_POST['value'];
	}
	$report_id = $_POST['report_id'];

	switch ($type) {
		case 'check':
			checkStatus($con,$report_id);
			break;
		case 'update':
			update($con,$report_id,$value);
			break;
		default:
			break;
	}

	function update($con,$id,$value){
		$update = mysqli_query($con,"update report_info set report_status='$value' where report_id =$id");
		if($update){
			if($value == 'closed'){
				echo "Request has been closed!";					
			}else if($value == 'ongoing'){
				echo "Moving status updated!";
			}
		}
	}

	function checkStatus($con,$id){
		$getStatus = mysqli_query($con,"select report_status from report_info where report_id=$id");
		$row = $getStatus->fetch_assoc();
		echo $row['report_status'];
		exit();
	}
?>