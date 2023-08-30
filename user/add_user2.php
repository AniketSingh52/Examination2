<?php

require ('../connect.php');
$id=$_POST['id'];
$sql="SELECT * FROM professor WHERE d_id = '$id'";
$result=mysqli_query($conn,$sql);
$out .='<option disabled selected value="">Select programme</option>';
while ($row = mysqli_fetch_array($result)) {
    $out.='<option value="' . $row['p_id'] . '">'.$row['name'].'</option>';
}
echo $out;
?>