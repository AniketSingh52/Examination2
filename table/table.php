<?php
error_reporting(0);

include('../connect.php');

if (isset($_POST['progid']) && !empty($_POST['semid'])&& !empty($_POST['yearid'])&& !empty($_POST['examid'])) {
if($_SERVER['REQUEST_METHOD']=='POST'){
//echo $_POST["department1"];
//echo $_POST["programee1"];
$prog=$_POST["progid"];
$sem=$_POST["semid"];
$year=$_POST['yearid'];
$examid=$_POST['examid'];
echo "
<thead class='thead-dark'>
<th>Select</th>
<th>Courses</th>
<th>Date</th>
<th>FromTime</th>
<th>ToTime</th>
</thead>
";
//Course Name And C_id 
$sql="select*from course where pr_id='$prog' AND sem='$sem'";
$result=$conn->query($sql);
if($result){
while($row=$result->fetch_assoc()){
 $name=$row['c_name'];
 $c_id=$row['c_id'];

 //Pre-Fetching Code
 $sql2="select*from timetable where pr_id='$prog' AND c_id='$c_id' AND e_id='$examid' AND academic_year='$year'";
 $result2=$conn->query($sql2);
    $row2=$result2->fetch_assoc();
    $date=$row2['date'];
    $ft=$row2['f_time'];
    $tt=$row2['t_time'];
 //$pr_id=$row['pr_id'];


echo "<tr>
<td><input type='checkbox' class='form-check-input' onchange='toggle(this,course_date{$c_id},f_time{$c_id},to_time{$c_id})'></td>
<td>".$name."</td>
<td><input type='date' class='form-control date-input' name='course_date[".$c_id."]' id='course_date{$c_id}' disabled value='$date'></td>
<td><input type='time' class='form-control date-input'  name='f_time[".$c_id."]>' id='f_time{$c_id}' disabled value='$ft'></td>
<td><input type='time' class='form-control date-input'  name='to_time[".$c_id."]>' id='to_time{$c_id}' disabled value='$tt'></td>
</tr>
";

}
}
}
}
?>