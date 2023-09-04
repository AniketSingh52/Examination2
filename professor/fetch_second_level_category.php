<?php

//fetch_second_level_category.php

include('../connect.php');

if(isset($_POST["selected"]))
{
    $id = join("','", $_POST["selected"]);
    $query = "
    SELECT * FROM programme 
    WHERE d_id IN ('".$id."')
    ";
    $statement=mysqli_query($conn,$query);
  
$result = $statement->fetch_all(MYSQLI_ASSOC);

 
 $output = '';
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["pr_id"].'">'.$row["pr_name"].'</option>';
 }
 echo $output;
}

?>