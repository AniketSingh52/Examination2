<?php
require "../connect.php";
$p_reson=$_POST['p_reson'];
$p_id=$_POST['p_id'];
$datee=$_POST['p_date'];
// echo $p_reson,$p_id,$datee;
$sq = "INSERT INTO `unavailability`( `date`,`reason`,`p_id`)
    VALUES ('$datee','$p_reson','$p_id')";
    $res=$conn->query($sq);
    if($res){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
        <strong>Sucess!</strong> Data saved sucessfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
          
     else{
       echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
        <strong>Error!</strong> something went wrong.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
     }

    
?>

