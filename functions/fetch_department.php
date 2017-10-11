<?php
session_start();
include_once 'connection.php';

$getDepartmentQuery = mysqli_query($con,"select * from department_info") or die(mysqli_error($con));

if(mysqli_num_rows($getDepartmentQuery)){
	while($row = $getDepartmentQuery->fetch_assoc()){
		$department_id = $row['department_id'];
		$department_name = $row['department_name'];
		$department_helpline = $row['department_helpline'];
		$department_icon = $row['department_icon'];
		?>

		<div onclick="request(<?php echo $department_id; ?>)" class="department-div">
			<img class="department-icon" src="<?php echo $department_icon; ?>">
			<span class="department-info"><?php echo $department_name; ?></span>
		</div>

		<?php		
	}
}else{
	echo "No departments found!";
}
?>