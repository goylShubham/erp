<div id="navigation" class="navigation">
	<nav>
		<div class="nav-top-div">
			<img class="menu-logo" src="images/ashoka_chakra.svg">
			<span class="menu-name">Indian Emergency Response Portal</span>
		</div>
		<div class="user-link-wrapper">
			<div class="nav-user-div">
				<?php
				if(isset($_SESSION['user_id'])){
					echo "<span class=\"nav-user-info\">".$_SESSION['user_name']."<br/>".$_SESSION['user_email']."</span>";
				}else if(isset($_SESSION['vehicle_id'])){
					echo "<span class=\"nav-user-info\">".$_SESSION['vehicle_name']."<br/>".$_SESSION['vehicle_email']."</span>";
				}else{

					echo "<ul><li class=\"user-login-link\"><img class=\"menu-icon\" src=\"images/login.png\"> User Login</li>";
					echo "<li class=\"dep-login-link\"><img class=\"menu-icon\" src=\"images/login.png\"> Department Login</li></ul>";
				}
				?>
			</div>
			<div class="nav-menu-div">
				<ul>				
				<?php
				if(isset($_SESSION['user_id'])){
				?>
					<li onclick="location.href = 'current_report'"><img class="menu-icon" src="images/status.png"> Current Report</li>	

					<li onclick="location.href = 'map' "><img class="menu-icon" src="images/info.png"> My Location</li>

					<li onclick="location.href = 'functions/logout.php'"><img class="menu-icon" src="images/logout.png"> Logout</li>
				<?php
				}else if(isset($_SESSION['vehicle_id'])){
				?>
					<li onclick="location.href = 'current_report'"><img class="menu-icon" src="images/status.png"> Current Reports</li>	

					<li onclick="location.href = 'map' "><img class="menu-icon" src="images/info.png"> My Location</li>

					<li onclick="location.href = 'functions/logout.php' "><img class="menu-icon" src="images/logout.png"> Logout</li>
				<?php
				}
				?>
			</ul>
		</div>
		<div class="nav-feedback-div">
			<p style="position: relative; margin: 15px 10px 0px 10px; font-size: 1em; text-align: left; color: grey;">
				This program is under development process. Please feel free to give feedbacks.
			</p>
			<ul>
				<li onclick="location.href='feedback'"><img class="menu-icon" src="images/feedback.png"> Feedback</li>
			</ul>
		</div>
	</div>
</nav>
</div>