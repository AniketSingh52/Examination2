<?php

//fetch_third_level_category.php

include('../connect.php');

if(isset($_POST["selected"]))
{
 $id = join("','", $_POST["selected"]);
 $query = "
 SELECT * FROM course 
 WHERE pr_id IN ('".$id."')
 "; 
 $statement=mysqli_query($conn,$query);
  
 $result = $statement->fetch_all(MYSQLI_ASSOC);
 $output = '';
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["c_id"].'">'.$row["c_name"].'</option>';
 }
 echo $output;
}




?>