<style type="text/css">
.tnc-wrapper{
	position: absolute;
	display: none;
	width: 100%;
	height: 100vh;
	background-color: rgba(100,100,100,.5);
}
</style>

<div class="tnc-wrapper">
	<div class="tnc">
		<table>
			<tr>
				<td>IERP: Terms & Conditions</td>
			</tr>
			<tr>
				<td>
					<ol>
						<li></li>
					</ol>
				</td>
			</tr>
			<tr>
				<td><button id="close-tnc-btn" class="btn bg-red">Close</button></td>
			</tr>
		</table>
	</div>
</div>
<script type="text/javascript">
	$("#close-tnc-btn").click(function(){
		$(".tnc-wrapper").hide();
	});
</script>	