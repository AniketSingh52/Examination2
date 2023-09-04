<?php

require ('../connect.php');
$id=$_POST['id'];
$sql="SELECT * FROM programme  WHERE d_id = '$id'";
//SELECT l.p_id,l.type,l.status,p.name,d.name as department  FROM login as l JOIN professor as p ON l.p_id=p.p_id JOIN department as d ON p.d_id=d.d_id WHERE l.username='$username'
$result=mysqli_query($conn,$sql);
$out .='<option disabled selected value="">Select programme</option>';
while ($row = mysqli_fetch_array($result)) {
    $out.='<option value="' . $row['pr_id'] . '">'.$row['pr_name'].'</option>';
}
echo $out;
?>
