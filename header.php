<!DOCTYPE html>
<html>
<head>
	<title><?php  if(isset($title)){echo $title;}else{echo "IERP";} ?></title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
	<link rel="icon" type="image/png" href="images/info.png"/>
	<link rel="stylesheet" type="text/css" href="css/mobile-css.css"/>
	<link rel="stylesheet" type="text/css" media="screen and (min-width: 800px)" href="css/laptop-css.css"/>
	<link rel="stylesheet" type="text/css" href="css/template.css">
	
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAcW0RZnwidEt591HwLqi9c34PyRgV0gA"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/map.js"></script>
	<script type="text/javascript" src="js/ui.js"></script>
	<?php
	if(isset($_SESSION['vehicle_id'])){
		?>
		<script type="text/javascript">
			var interval = setInterval(function(){
				if (navigator.geolocation){
					navigator.geolocation.getCurrentPosition(function(position){      
						$.post("functions/update_location.php",{
							user_lat: position.coords.latitude,
							user_lng: position.coords.longitude
						});
					},showError);
				}else{
					snackbar("Geolocation not supported.");
					clearTimeout(interval);
				}
			},5000);
		</script>
		<?php
	}
	?>
</head>
<body>
	<?php include_once 'nav.php';?>
	<header>
		<img class="menu-icon" src="images/menu.png">
		<img class="logo-img" src="images/logo.svg">
		<div>
			<?php
			if(!isset($_SESSION['user_id']) && !isset($_SESSION['vehicle_id']))
			{
				echo "<span class=\"user-div user-login-link\">Login</span>";
			}
			else
			{
				if(isset($_SESSION['user_id'])){
					$firstName = explode(" ", $_SESSION['user_name']);
					echo "<span class=\"user-div\">".strtoupper($firstName[0])."</span>";
				}else{
					echo "<span class=\"user-div\">".$_SESSION['vehicle_name']."</span>";
				}
			}
			?>
		</div>
	</header>

	<!-- Body Container For Pages  -->
	<div class="container">	