<?php
session_start();
include_once 'connection.php';

$department_id = $_POST['department'];
$getspecificationQuery = mysqli_query($con,"select specification_id,specification_name,department_id,specification_icon from department_specification where specification_department=$department_id") or die(mysqli_error($con));

if(mysqli_num_rows($getspecificationQuery)>0){
	while($row = $getspecificationQuery->fetch_assoc()){
		$specification_id = $row['specification_id'];
		$department_id = $row['department_id'];
		$specification_name = $row['specification_name'];
		$specification_icon = $row['specification_icon'];
		?>

		<div onclick="sendRequest(<?php echo $_SESSION['user_id'].",".$department_id.",".$specification_id.",'$specification_name'";?>)" class="specification-div">		
			<img class="specification-icon" src="<?php echo $specification_icon; ?>">
		</div>

		<?php		
	}
}else{
	echo "No specifications found!";
}
?>