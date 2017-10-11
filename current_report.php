<!-- Header and Navigation -->
<?php
session_start();

// if(!isset($_SESSION['initiated']) && !isset($_SESSION['assigned'])){
// 	header("Location: ../ierp");
// }

$title = "IERP: Current Report";

include 'header.php';
?>

<!-- Only Change Here For Other Pages -->
<style type="text/css">
#report-wrapper{
	position: absolute;
	top: 5px;
	left: 0px;
	right: 0px;
	width: 75%;
	z-index: 100;
}

#report-div{
	position: relative;
	padding: 5px;
	width: calc(100% - 10px);
	min-height: 50px;
	border-radius: 4px;
	box-shadow: 1px 1px 10px black;
}

.initiated{
	background-color: red;
}

.ongoing{
	background-color: yellow;
}

.closed{
	background-color: grey;
}

.close-btn,.start-moving{
	display: none;
}

#mapholder{
	position: relative;
	float: left;
	width: 100%;
	height: 100%;
	background-color: grey;
}
</style>
<div id="report-wrapper">
	<script type="text/javascript">
		setInterval(function(){
			$.post("functions/get_current_report.php",function(data,status){
				$("#report-wrapper").html(data);
			});
		},2000);
	</script>
</div>
<div id="mapholder">
	<script type="text/javascript">
		setInterval(function(){
			if($("#report-wrapper").html()=="No report found!"){
				currentLocation();
			}else{
				$.post("functions/get_latlng.php",{
					report_id: $("#report").val()
				},function(data,status){
					var arr = data.split(" ");
					if(arr[0]=="success"){
						var sender_latlng = {lat: parseFloat(arr[1]), lng: parseFloat(arr[2])};
						var vehicle_latlng = {lat: parseFloat(arr[3]), lng: parseFloat(arr[4])};
						direction(sender_latlng,vehicle_latlng);
					}
				});
			}
		},5000);
	</script>
</div>

<!-- Footer -->
<?php
include 'footer.php';
?>