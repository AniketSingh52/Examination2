<?php
// Include the database connection file
include('../../connect.php');
?>

<?php
//error_reporting(0);
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['professor']) && !empty($_POST['reason'])&& !empty($_POST['date'])){
       $pid=$_POST["professor"];
       $reason=$_POST["reason"];
       $date=$_POST["date"];
       $sql="insert into unavailability(p_id,date,reason) values('$pid','$date','$reason')";
          if($result=$conn->query($sql)){
			echo '<div class="alert alert-success alert-dismissible fade-show">
			<a href="index4.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Record Inserted.
		  </div>';
		  //echo"<script> alert('data inserted');</script> ";
          }
		  else{
			echo '<div class="alert alert-warning alert-dismissible fade-show">
			<a href="index4.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Error!</strong> No Data Inserted.
		  </div>';
		  }
	 }
	 else{
		echo '<div class="alert alert-danger alert-dismissible fade-show" >
		<a href="index4.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Failed!</strong> Please Select Values.
	  </div>
	';
		//echo"<script>alert('Insert some data');</script> ";
	 }
}
?>

<html>
<head>
 <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Unavailable Professor</title>
    <link rel="shortcut icon" href="../../fevicon.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="update_prof.css">
</head>

<script type="text/javascript">
  $(document).ready(function(){
    // Department dependent ajax
    $("#department").on("change",function(){
      var departId = $(this).val();
      $.ajax({
        url :"action.php",
        type:"POST",
        cache:false,
        data:{depId:departId},
        success:function(data){
          $("#programee").html(data);
        }
      });
    });

	    // Program And Department dependent Professor ajax
		$("#programee").on("change",function(){
      var pr_id = $(this).val();
	  var dep_id=document.getElementById("department").value;
      $.ajax({
        url :"action.php",
        type:"POST",
        cache:false,
        data:{prId:pr_id,depid:dep_id},
        success:function(data){
          $("#professor").html(data);
        }
      });
    });

	// Reason Textarea onchange Professor ajax
	$("#professor").on("change",function(){
      var p_id = $(this).val();
      $.ajax({
        url :"action.php",
        type:"POST",
        cache:false,
        data:{pId:p_id},
        success:function(data){
          $("#prof_name").html(data);
        }
      });
    });
    
  });
</script>

<body>
<div style="margin-top:40px;background-color:white;border-radius:10px;padding:5px;max-width:800px;"class="container">
		<h3 style="font-size:30px;font-weight:bold;color:gray;text-align:center;">UAvailability Of Profesor</h3>
    <br />
</div>

<div class="formm">
	<div class="sizeform">
		<form action="index4.php" method="post">
			<div class="col-auto">

				<!-- Department dropdown -->
				<label for="department">Department</label>
				<select class="form-control" id="department" name="department1">
					<option value="" selected disabled>Select Department</option>
					<?php
					$query = "SELECT * FROM department";
					$result = $conn->query($query);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo '<option value="'.$row['d_id'].'">'.$row['name'].'</option>';
						}
					}else{
						echo '<option value="">Country not available</option>';
					}
					?>
				</select>
        <br />

				<!-- Programme dropdown -->
				<label for="programee">Programee</label>
				<select class="form-control" id="programee" name="programee1">
					<option value="" selected disabled>Select Programee</option>
				</select>
		<br/>

		<!-- Professor dropdown -->
		<label for="professor">Professor</label>
				<select class="form-control" id="professor" name="professor">
					<option value="" selected disabled>Select Professor</option>
				</select>
		<br/>


		<div id="prof_name">
           
		</div>
		 
		<!-- Submit-->
		<input type="submit" value="Submit" name="Submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
	
</body>
</html>