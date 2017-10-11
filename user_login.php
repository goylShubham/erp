<!-- Header and Navigation -->
<?php
session_start();

if(isset($_SESSION['user_id'])){
	header("Location: ../ierp/");
}

$title = "IERP: User Login";

include 'header.php';
?>

<!-- Only Change Here For Other Pages -->
<div id="user-login-wrapper" class="user-login-wrapper">
	<div class="login-div">
		<form onsubmit="return false" method="post">
			<table>
				<tr>
					<td>
						<h2>User Login</h2>
					</td>
				</tr>
				<tr>
					<td>
						<input id="email" class="input-field" type="text" name="email" placeholder="Email" spellcheck="false">
					</td>
				</tr>
				<tr>
					<td>
						<input id="password" class="input-field" type="password" name="pass" placeholder="Password">
					</td>
				</tr>
				<tr>
					<td>
						<br/>
						<button id="login-btn" class="btn bg-blue">Login</button>
					</td>
				</tr>
				<tr>
					<td>
						<a href="#" class="forget-pass-link">Forget Password?</a>
					</td>
				</tr>
				<tr>
					<td>
						<br/>
						<span class="info-span">New User?</span><br/>
						<button class="btn bg-red register-link">Register</button>
					</td>
				</tr>
			</table>
		</form>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#login-btn").click(function(){
				$.post("functions/user_login.php",{
					email: $("#email").val(),
					pass: $("#password").val()
				},function(data,status){
					if(data == "success"){
						location.href = "../ierp/";
					}else if(data == "verify email"){
						location.href ="user_verify?type=vEmail";
					}else if(data == "verify mobile"){
						location.href ="user_verify?type=vMobile";
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