<?php
include('../../connect.php');
$p_id=$_GET["p1_id"];
if(isset($_GET["confirmation"])){
$a=$_GET["confirmation"];
if($a=="Yes"){
  $sql="delete from professor where p_id='$p_id'";
  if($conn->query($sql)){
  echo"
    <script>
    alert('Data Deleted Sucessfully');
    </script>
    ";
    echo'<META HTTP-EQUIV="Refresh" Content="0.5;URL=index1.php">';
  }
  else{
    echo"error";
  }
}
elseif($a=="No"){
  echo'<META HTTP-EQUIV="Refresh" Content="0.5;URL=index1.php">';
}
}
else{
echo"
<script>
var user=confirm('Are You Sure?');
if(user){
document.location.href='delete.php?confirmation=Yes&p1_id=$p_id';
}
else{
document.location.href='delete.php?confirmation=No&p1_id=$p_id';
}
</script>
";
}
?>