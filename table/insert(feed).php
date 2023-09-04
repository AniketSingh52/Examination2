<?php
// Include the database connection file
include('../connect.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
    $year=$_POST["year"];
    $prog=$_POST["programee1"];
    #$sem=$_POST["semester1"];
    $e_id=$_POST["examtype1"];
    $date=$_POST["course_date"];
    $f_time=$_POST["f_time"];
    $t_time=$_POST["to_time"];
#echo $year."\n";
#echo $prog."\n";
#echo $sem."\n";
#echo $e_id."\n";
foreach($date as $c_id=>$date1){
    #echo $c_id."\n";
    #echo $date1."\n";
    if(array_key_exists($c_id,$f_time)){
        $time=$f_time[$c_id];
        #echo $time;
    }
    if(array_key_exists($c_id,$t_time)){
        $time1=$t_time[$c_id];
        #echo $time1;
    }
    $sql="insert into timetable(pr_id,c_id,e_id,date,f_time,t_time,academic_year) values('$prog','$c_id','$e_id','$date1','$time','$time1','$year')";
    $result=$conn->query($sql);
    if($result){
       echo "
       <script>
alert('Data Inserted Sucessfully');
       </script>
       ";
       header("refresh:0.5; url=index2.php");
            }
            else{
                echo"lag agaye bisi";
            }
}





}

?>