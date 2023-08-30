<?php
include('../connect.php');
$p_id=$_GET['p1_id'];
$sql="delete from professor where p_id='$p_id'";
if($conn->query($sql)){
echo"
  <script>
  alert('Data Deleted Sucessfully');
  </script>
  ";
  header("refresh:0.5; url=index.php");
}
?>