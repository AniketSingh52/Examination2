<?php
// Include the database connection file
include('../connect.php');

if (isset($_POST['countryId']) && !empty($_POST['countryId'])) {

	// Fetch Sem name base on country id(Programee)
	$a=$_POST['countryId'];
	$query = "SELECT distinct sem FROM course where pr_id='$a'";
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="" selected disabled>Select a Semester</option>';
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['sem'].'">'.$row['sem'].'</option>';
		}
	} else {
		echo '<option value="" Selected disabled>Sem not available</option>';
	}
} 
?>