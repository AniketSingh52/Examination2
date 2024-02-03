<?php
// Include the database connection file
include('../../connect.php');

if (isset($_POST['depId']) && !empty($_POST['depId'])) {

	// Fetch PROGRAMEE name base on depid
	$d_id=$_POST['depId'];
	$query = "SELECT * FROM programme where d_id='$d_id'";
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="" Selected disabled>Select a Programme</option>';
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['pr_id'].'">'.$row['pr_name'].'</option>';
		}
	} else {
		echo '<option value="" Selected disabled>Programee not available</option>';
	}
} 

if (isset($_POST['prId']) && !empty($_POST['depid'])) {

	// Fetch PROFESSOR name base on pROGRAM AND DEPARTMENT ID
	$d_id=$_POST['depid'];
	$pr_id=$_POST['prId'];
$sql="SELECT p.p_id,p.name FROM professor as p JOIN p_department as pd ON p.p_id=pd.p_id JOIN programme as pr ON pr.d_id=pd.d_id  WHERE pr.d_id=$d_id AND pr.pr_id=$pr_id";
    $result=$conn->query($sql);
	if ($result->num_rows > 0) {
		echo '<option value="" Selected disabled>Select a Professor</option>';
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['p_id'].'">'.$row['name'].'</option>';
		}
	} else {
		echo '<option value="" Selected disabled>Professor Name not available</option>';
	}
}

	if (isset($_POST['pId']) && !empty($_POST['pId'])) {

		$p_id=$_POST['pId'];
		echo'<label for="date">Date</label>';
		echo '<input type="date" class="form-control" name="date"><br>';
		echo'<label for="Reason">Reason</label>';
		echo '<textarea class="form-control" name="reason" rows="3"></textarea><br>';
} 
?>