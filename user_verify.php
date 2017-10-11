<!-- Header and Navigation -->
<?php
session_start();

if(isset($_SESSION['user_id'])){
	header("Location: ../ierp/");
}

$title = "IERP: Verification";
$code = rand(100000,999999);

include 'header.php';
?>

<!-- Only Change Here For Other Pages -->
<div id="user-login-wrapper" class="user-login-wrapper">
	<div class="login-div">
		<form method="post" onsubmit="return false" method="post">
			<span id="ack" class="ack-span"></span>
			<table>
				<tr>
					<td>
						<?php 
						if(isset($_SESSION['user_email']) || isset($_SESSION['user_mobile'])){
							if(isset($_GET['type']) && $_GET['type']=='vMobile'){
								echo "Mobile verification<br/>";
								echo "Verification code has been sent to your registered mobile number.";
							}else if(isset($_GET['type']) && $_GET['type']=='vEmail'){
								echo "Email verification<br/>";
								echo "Verification code has been sent to your registered email address.";
							}
						} 
						?>
					</td>
				</tr>
				<tr>
					<td>
						<input id="vcode" class="input-field" type="text" name="code" placeholder="Code" spellcheck="false">
					</td>
				</tr>
				<tr>
					<td>
						<button class="btn bg-red verify-btn">Veirfy</button>
					</td>
				</tr>
			</table>
		</form>
	</div>

	<script>
		$(document).ready(function(){
			var type= "<?php echo $_GET['type'];?>"; 
			var receiver = "<?php echo $_SESSION['user_mobile']; ?>";
			if(type=='vMobile'){
				$.post("sms.php",{
					receiver: receiver,
					body: "Mobile verification code: "+<?php echo $code; ?>,
					successMessage: "Verification Code has been sent to your mobile."
				},function(data,status){
					snackbar(data);
				});
			}else{
				$.post("gmail.php",{
					receiver: "<?php echo $_SESSION['user_email']; ?>",
					subject: "Email Verification Code",
					body: "Hello, this is your email verification code <br/><br/><b>Code: "+<?php echo $code; ?>+"</b>",
					successMessage: "Verification code has been sent to your email."
				},function(data,status){
					snackbar(data);
				});
			}
		});
	</script>	
</div>

<!-- Footer -->
<?php
include 'footer.php';
?>