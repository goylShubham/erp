<!-- Header and Navigation -->
<?php
session_start();

$title = "IERP: Current Location";

include 'header.php';
?>

<!-- Only Change Here For Other Pages -->
<style type="text/css">
#mapholder{
	width: 100%;
	min-height: 50px;
	height: 100%;
}
</style>
<div id="mapholder">
	<script type="text/javascript">
		currentLocation();
	</script>
</div>

<!-- Footer -->
<?php
include 'footer.php';
?>