<?php

require ('../connect.php');
$id=$_POST['id'];
$sql="SELECT * FROM course WHERE pr_id = '$id'";
$result=mysqli_query($conn,$sql);
$out .='<option disabled selected  value="">Select course</option>';
while ($row = mysqli_fetch_array($result)) {
    $out.='<option value="' . $row['c_id'] . '">'.$row['c_name'].'</option>';
}
echo $out;
?>
