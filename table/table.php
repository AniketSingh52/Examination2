<?php
error_reporting(0);

include('../connect.php');

if (isset($_POST['progid']) && !empty($_POST['semid'])) {
if($_SERVER['REQUEST_METHOD']=='POST'){
//echo $_POST["department1"];
//echo $_POST["programee1"];
$prog=$_POST["progid"];
$sem=$_POST["semid"];
echo "
<thead class='thead-dark'>
<th>Select</th>
<th>Courses</th>
<th>Date</th>
<th>FromTime</th>
<th>ToTime</th>
</thead>
";
$sql="select*from course where pr_id='$prog' AND sem='$sem'";
$result=$conn->query($sql);
if($result){
while($row=$result->fetch_assoc()){
 $name=$row['c_name'];
 $c_id=$row['c_id'];
 //$pr_id=$row['pr_id'];
echo "<tr>
<td><input type='checkbox' class='form-check-input' onchange='toggle(this,course_date{$c_id},f_time{$c_id},to_time{$c_id})'></td>
<td>".$name."</td>
<td><input type='date' class='form-control date-input' name='course_date[".$c_id."]' id='course_date{$c_id}' disabled></td>
<td><input type='time' class='form-control date-input'  name='f_time[".$c_id."]>' id='f_time{$c_id}' disabled></td>
<td><input type='time' class='form-control date-input'  name='to_time[".$c_id."]>' id='to_time{$c_id}' disabled></td>
</tr>
";
}
}
}
}
?>