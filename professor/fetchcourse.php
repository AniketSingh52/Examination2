<?php

require ('../connect.php');
$id=$_POST['id'];
$sql="SELECT * FROM course WHERE pr_id = '$id'";
$result=mysqli_query($conn,$sql);
$out='';
while ($row = mysqli_fetch_array($result)) {
    $out.='<label ><input type="checkbox" value="' . $row['c_id'] . '">'.$row['c_name'].'</label>';
    // <label >
    //     <input type="checkbox" id="three" />Third checkbox</label>
}
echo $out;
?>
