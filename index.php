<!-- Header and Navigation -->
<?php
session_start();
if(isset($_SESSION['vehicle_id'])){
	header("Location: current_report");
}
$title = "IERP";

include_once 'header.php';
?>

<!-- Body Container For Pages -->
<style type="text/css">
#department-wrapper{
	position: relative;
	width: 100%;
}

.department-div{
	cursor: pointer;
	position: relative;
	float: left;
	margin: 5%;
	padding: 5%;
	width: 30%;
	min-height: 20vh;
	border-radius: 5px;
}

.department-icon{
	cursor: pointer;
	position: relative;
	width: 100%;
}

.department-info{
	cursor: pointer;
	position: absolute;
	bottom: 0px;
	left: 0px;
	width: 100%;
	height: 25px;
	line-height: 25px;
	text-align: center;
	color: white;
	background-color: #a9a9a9;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
}

#department-popup{
	position: absolute;
	display: none;
	top: 0px;
	left: 0px;
	width: 100%;
	height: 80vh;
	background-color: rgba(0,0,0,.6);
	z-index: 10;
}

#specification-wrapper{
	position: absolute;
	margin: auto;
	top: 0px;
	right: 0px;
	bottom: 0px;
	left: 0px;
	width: 80%;
	height: 80%;
	background-color: white;
}

</style>
<div id="department-wrapper" class="department-wrapper">
	<?php include 'loading.php'; ?>
</div>		
<script type="text/javascript">
	var user_id = 
	<?php 
		if(isset($_SESSION['user_id'])){
			echo $_SESSION['user_id'];
		}else{
			echo 0;
		} 
	?>;
	$(document).ready(function(){
		$("#department-wrapper").load("functions/fetch_department.php",function(responseTxt, statusTxt){
		});
	});
</script>

<!-- Footer -->
<?php
include 'footer.php';
?>