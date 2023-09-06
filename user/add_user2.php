<?php

require ('../connect.php');
$id=$_POST['id'];

$sql="SELECT p.p_id,p.name FROM professor as p JOIN p_department as d ON d.p_id=p.p_id WHERE d.d_id = '$id'";
//$sql="SELECT * FROM programme as p JOIN p_department as d ON d.p_id=p.p_id WHERE d.d_id = '$id'";
$result=mysqli_query($conn,$sql);
$out .='<option disabled selected value="">Select professor</option>';
while ($row = mysqli_fetch_array($result)) {
    $out.='<option value="' . $row['p_id'] . '">'.$row['name'].'</option>';
}
echo $out;
?>