<?php
// Include the database connection file
include('../connect.php');

if (isset($_POST['depId']) && !empty($_POST['depId'])) {

	// Fetch PROGRAMEE name base on depid
	$d_id=$_POST['depId'];
	$query = "SELECT * FROM programme where d_id='$d_id'";
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="">Select a Programme</option>';
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['pr_id'].'">'.$row['pr_name'].'</option>';
		}
	} else {
		echo '<option value="">Programee not available</option>';
	}
} 
if (isset($_POST['pr_id']) && !empty($_POST['pr_id'])) {

	// Fetch PROGRAMEE name base on depid
	$pr_id=$_POST['pr_id'];
	$query = "SELECT p.name,p.reg_sfc,p.designation,p.type,p.ecm,p.p_id FROM professor as p JOIN p_department as pd ON p.p_id=pd.p_id JOIN programme as pr ON pr.d_id=pd.d_id  WHERE  pr.pr_id=$pr_id";
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="">Select a Professor</option>';
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['p_id'].'">'.$row['name'].'</option>';
		}
	} else {
		echo '<option value="">Professor not available</option>';
	}
} 
?>