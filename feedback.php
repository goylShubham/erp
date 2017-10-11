<!-- Header and Navigation -->
<?php
session_start();
$title = "IERP";

include_once 'header.php';
?>

<!-- Body Container For Pages -->
<style type="text/css">
.feedback-wrapper{
	position: relative;
	float: left;
	width: 100%;
	height: 100%;
}

.feedback-wrapper table{
	position: relative;
	float: left;
	width: 100%;
}

.feedback-wrapper textarea{
	position: relative;
	padding-left: .5%;
	width: 98.8%;
	height: 100px;
	text-align: left;
	font-weight: normal;
	resize: none;
}
</style>

<div class="feedback-wrapper">
	<form onsubmit="return false">
		<span id="feedback-ack" class="ack"></span>
		<table>
			<?php if(!isset($_SESSION['user_id']) && !isset($_SESSION['vehicle_id'])) {?>
			<tr>
				<td>
					<input id="f_name" class="input-field" type="text" name="name" spellcheck="false" placeholder="Full Name">
				</td>
			</tr>	
			<tr>
				<td>
					<input id="f_email" class="input-field" type="text" name="email" spellcheck="false" placeholder="Email">
				</td>
			</tr>	
			<?php } ?>
			<tr>
				<td>
					<textarea id="f_feed" spellcheck="false" placeholder="Feedback..."></textarea>
				</td>
			</tr>	
			<tr>
				<td>
					<button class="btn bg-green">Submit</button>
				</td>
			</tr>
		</table>
	</form>
</div>

<!-- Footer -->
<?php
include 'footer.php';
?>