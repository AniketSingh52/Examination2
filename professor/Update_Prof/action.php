<?php
// Include the database connection file
include('../../connect.php');

if (isset($_POST['depId']) && !empty($_POST['depId'])) {

	// Fetch PROGRAMEE name base on depid
	$d_id=$_POST['depId'];
	$query = "SELECT * FROM programme where d_id='$d_id'";
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="" disabled selected>Select a Programme</option>';
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['pr_id'].'">'.$row['pr_name'].'</option>';
		}
	} else {
		echo '<option value="" selected disabled>Programee not available</option>';
	}
} 
?>