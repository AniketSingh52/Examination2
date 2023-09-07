<?php
require "../connect.php";
$p_reson=$_POST['p_reson'];
$p_id=$_POST['p_id'];
$datee=$_POST['p_date'];
echo $p_reson,$p_id,$datee;
$sq = "INSERT INTO `unavailability`( `date`,`reason`,`p_id`)
    VALUES ('$datee','$p_reson','$p_id')";
    $res=$conn->query($sq);
?>

