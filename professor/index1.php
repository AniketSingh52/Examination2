<?php
// Include the database connection file
include('../connect.php');
?>

<html>
<head>
	<title>Update/Delete Profesor</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    
  });
</script>

<body>
	<div class="container">
		<h3>Update professor</h3>
    <br />
		<form action="<?php $_PHP_SELF ?>" method="post">
			<div class="col-auto">

				<!-- Department dropdown -->
				<label for="department">Department</label>
				<select class="form-control" id="department" name="department1">
					<option value="">Select Department</option>
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
					<option value="">Select Programee</option>
				</select>
		<br/>
		        <input type="submit" value="Submit" name="Submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</body>
</html>
<?php
error_reporting(0);
if($_SERVER['REQUEST_METHOD']=='POST'){
//echo $_POST["department1"];
//echo $_POST["programee1"];
$a=$_POST["department1"];
$b=$_POST["programee1"];

echo "
<div class='container'>
<table border='1' class='table table-hover mx-auto px-auto'>
<thead class='thead-dark'>
<th>Name</th>
<th>Regular/SFC</th>
<th>Designation</th>
<th>Type(Reg/Vis)</th>
<th>ECM</th>
<th colspan='2' class='text-center'>Actions</th>
</thead>
";
$sql="select p.name,p.p_id,p.reg_sfc,p.designation,p.type,p.ecm from professor p,department d,programme pr where pr.pr_id='$b' And d.d_id='$a'AND pr.d_id=d.d_id AND p.d_id=d.d_id";
$result=$conn->query($sql);
if($result){
while($row=$result->fetch_assoc()){
 $name=$row['name'];
 $p_id=$row['p_id'];
 //$pr_id=$row['pr_id'];
 $reg_sfc=$row['reg_sfc'];
 $desig=$row['designation'];
 $type=$row['type'];
 $ecm=$row['ecm'];

echo "<tr>
<td>".$name."</td>
<td>".$reg_sfc."</td>
<td>".$desig."</td>
<td>".$type."</td>
<td>".$ecm."</td>
<td class='text-center'><a href='update(prof).php?p_id=$p_id'><input type='button' class='btn btn-success' value='Update'></a></td>
<td class='text-center'><a href='delete.php?p1_id=$p_id'><input type='button' class='btn btn-danger' value='Delete'></a></td>
</tr>
";
}
}
}
?>