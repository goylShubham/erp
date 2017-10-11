<?php
	session_start();
	include_once 'connection.php';

	if(isset($_SESSION['user_id'])){
		$id = $_SESSION['user_id'];
		$getReport = mysqli_query($con,"select 
			department_info.department_vehicle,aadhar_info.*,user_info.*,report_info.*,vehicle_info.* from 
			department_info,aadhar_info,user_info,report_info,vehicle_info 
			where 
			department_info.department_id=vehicle_info.department_id and
			aadhar_info.aadhar_number=user_info.user_aadhar and
			user_info.user_id=$id and
			report_info.report_by=$id and
			report_info.report_status!='closed' and
			vehicle_info.vehicle_id=report_info.vehicle_id");
		if(mysqli_num_rows($getReport)!=1){
			echo "No report found!";
			exit();
		}else{
			$row = $getReport->fetch_assoc();
			$report_id = $row['report_id'];
			$user_name = $row['aadhar_name'];
			$date = $row['report_date'];
			$time = $row['report_time'];
			$status = $row['report_status'];
			$vehicle_name = $row['department_vehicle'];
			$vehicle_mobile = $row['vehicle_mobile'];

			?>
				<div id="report-div" class="<?php echo $status; ?>">
					<input id="report" type="hidden" name="status" value="<?php echo $report_id; ?>">
					<script type="text/javascript">
						$(document).ready(function(){
							setInterval(function(){
								$.post("functions/status.php",{
									type: 'check',
									report_id: $("#report").val()
								},function(data,status){
									$("#report-div").removeClass();
									$("#report-div").addClass(data);
									if(data =='ongoing'){
										$(".close-btn").show();
									}						
								});
							},1000);

							$(".close-btn").click(function(){
								$.post("functions/status.php",{
									type: 'update',
									value: 'closed',
									report_id: $("#report").val()
								},function(data,status){
									snackbar(data);
									setTimeout(function(){
										location.href = "../ierp";
									},1000);
								});
							});
						});
					</script>
					<?php 
					echo 
					"Sender: ".$user_name."<br/>".
					"Date: ".$date." Time: ".$time."<br/>".
					"Vehicle: ".$vehicle_name."<br/>".
					"Vehicle Mobile: ".$vehicle_mobile."<br/>".
					"<button class='close-btn'>Close</button>";
					if($status == "ongoing"){
						?>
						<script type="text/javascript">
							$(".close-btn").css("display","block");
						</script>
						<?php
					}
					?>
				</div>
			<?php
		}
	}else if(isset($_SESSION['vehicle_id'])){

		$id = $_SESSION['vehicle_id'];
		$getReport = mysqli_query($con,"select 
			department_info.department_vehicle,aadhar_info.*,user_info.*,report_info.*,vehicle_info.* from 
			department_info,aadhar_info,user_info,report_info,vehicle_info 
			where 
			department_info.department_id=vehicle_info.department_id and
			aadhar_info.aadhar_number=user_info.user_aadhar and
			user_info.user_id=report_info.report_by and
			report_info.report_status!='closed' and
			report_info.vehicle_id = $id and
			vehicle_info.vehicle_id=report_info.vehicle_id");
		if(mysqli_num_rows($getReport)!=1){
			echo "No report found!";
			exit();
		}else{
			$row = $getReport->fetch_assoc();
			$report_id = $row['report_id'];
			$user_email = $row['user_email'];
			$user_name = $row['aadhar_name'];
			$user_mobile = $row['aadhar_mobile'];
			$user_address = $row['sender_address'];
			$date = $row['report_date'];
			$time = $row['report_time'];
			$status = $row['report_status'];
			$vehicle_name = $row['department_vehicle'];

			?>
				<div id="report-div" class="<?php echo $status; ?>">
					<input id="report" type="hidden" name="status" value="<?php echo $report_id; ?>">
					<script type="text/javascript">
						$(document).ready(function(){
							setInterval(function(){
								$.post("functions/status.php",{
									type: 'check',
									report_id: $("#report").val()
								},function(data,status){
									$("#report-div").removeClass();
									$("#report-div").addClass(data);
									if(data == 'initiated'){
										$(".start-moving").show();						
									}else if(data == 'closed'){
										location.href = "current_report";
									}
								});
							},1000);

							$(".start-moving").click(function(){
								$.post("functions/status.php",{
									type: 'update',
									value: 'ongoing',
									report_id: $("#report").val()
								},function(data,status){
									snackbar(data);
									$(".start-moving").hide();
								});
							});
						});
					</script>
					<?php 
					echo 
					"Sender: ".$user_name."<br/>".
					"Mobile: ".$user_mobile."<br/>".
					"Address: ".$user_address."<br/>".
					"Date: ".$date." Time: ".$time."<br/>".
					"<button class='start-moving'>Start Moving</button>";
					if($status == "initiated"){
						?>
						<script type="text/javascript">
							$(".start-moving").css("display","block");
						</script>
						<?php
					}
					?>
				</div>
			<?php
		}
	}
?>