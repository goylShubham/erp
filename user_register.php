<!-- Header and Navigation -->
<?php
session_start();
$title = "IERP: Register";

if(isset($_SESSION['user_id'])){
	header("Location: ../ierp/");
}

include 'header.php';
?>

<!-- Only Change Here For Other Pages -->
<style type="text/css">
#ack{
	z-index: 100;
}
</style>

<div id="user-register-wrapper" class="user-register-wrapper">
	<div class="register-div">
		<form onsubmit="return false" method="post">
			<table>
				<tr>
					<td>
						<input id="aadhar" class="input-field" type="text" name="aadhar" placeholder="Aadhar Card Number" autocomplete="false" spellcheck="false">
					</td>
				</tr>
				<tr>
					<td>
						<input id="email" class="input-field" type="text" name="email" placeholder="Email" autocomplete="false" spellcheck="false">
					</td>
				</tr>
				<tr>
					<td>
						<input id="password" class="input-field" type="password" name="password" placeholder="Password" autocomplete="false">
					</td>
				</tr>
				<tr>
					<td>
						<input onpaste="return false" id="re-pass" class="input-field" type="password" name="re-pass" placeholder="Re-Enter Password">
					</td>
				</tr>
				<tr>
					<td>
						<label class="tnc-label">
							<input id="tnc" type="checkbox" name="tnc"> I agree Terms & Conditions.
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<br/>
						<button id="register-btn" class="btn bg-blue">Register</button>
					</td>
				</tr>
				<tr>
					<td>
						<br/>
						<span class="info-span">Already Registered?</span><br/>
						<button class="btn bg-red user-login-link">Login</button>
					</td>
				</tr>
			</table>
		</form>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$(".tnc-label").click(function(){
				if($("#tnc").prop("checked")===true){
					$(".tnc-wrapper").show();
				}else{
					$(".tnc-wrapper").hide();					
				}
			});

			$("#register-btn").click(function(){
				$.post("functions/user_register.php",{
					aadhar: $("#aadhar").val(),
					email: $("#email").val(),
					mobile: $("#mobile").val(),
					pass: $("#password").val(),
					repass: $("#re-pass").val(),
					tnc: $("#tnc").is(":checked")
				},function(data,status){
					if(data == 'success'){
						snackbar("Registered successfully!");	
						setTimeout(function(){							
							location.href = "user_verify?type=vMobile";
						},500);					
					}else{
						snackbar(data);	
					}
				});	
			});
		});
	</script>	
</div>

<!-- Footer -->
<?php
include 'footer.php';
?>