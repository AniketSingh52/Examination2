<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
  <?php
require "connect.php";
if(isset($_POST['u_name'])){
  session_start();
      $_SESSION['username']=$_POST['u_name'];
$u_name=$_SESSION['username'];
$pass=$_POST['pass'];
$sql="select * from login where username='$u_name' and
password='$pass'";
$q=$conn->query($sql);
$count=mysqli_num_rows($q);
if($count){
  $userdata=mysqli_fetch_array($q);
  if($userdata['type']==="A"){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
    <strong>Sucess!</strong> Login Successful as admin.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    // echo "<script>alert('');</script>";
    echo '<META HTTP-EQUIV="Refresh" Content="0.5; URL=info-1.php">';
    }else{
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
      <strong>Sucess!</strong> Login Successful.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      // echo"<script> alert ('Login successful')</script>" ;
      echo'<META HTTP-EQUIV="Refresh" Content="0.5;URL=info-1.php">';
      }
  }
  else{ 
    echo "<script>alert('unable to Login.. ');</script>";
  }
}
?>
    <div class="container-fluid">
         <div class="bg-img"></div><!-- for adding background ): -->
    </div>
    <div class="container" >
        <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="login">

            <h1>Login</h1>
            <form name="login" method="post" action="index.php">
                <div class="form-group">
                  <input type="name" class="form-control" id="u_name" name="u_name"  placeholder="Your Name">
                  
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="pass"  name="pass" placeholder="Password">
                </div>

                  <div class="form-check">

                  <input type="checkbox">

                </label>
                  <label class="form-check-label ">Remember me</label>
                  <label class="forgot-password"><a href="#">Forgot Password?<a></label>

                </div>
              
                <br>
                 <button type="submit" class="btn btn-lg btn-block btn-success">Sign in</button>
              </form>

      </div>
    </div>
    </div>
</div>

</body>
</html>