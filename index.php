<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="shortcut icon" href="fevicon.png">
  

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/9e5ba2e3f5.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <link rel="stylesheet" href="css/login.css" type="text/css">
</head>
<body>
  <?php
require "connect.php";
error_reporting(0);

if(isset($_POST['u_name'])&& !empty($_POST['pass'])){
  session_start();
      $_SESSION['username']=$_POST['u_name'];
      echo '<script> alert($_SESSION[`username`])</script>';

      //echo $_SESSION['username'];
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
    echo '<META HTTP-EQUIV="Refresh" Content="1; URL=info-2.php">';
    }else{
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
      <strong>Sucess!</strong> Login Successful.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      // echo"<script> alert ('Login successful')</script>" ;
      echo'<META HTTP-EQUIV="Refresh" Content="0.9;URL=info-1.php">';
      }
  }
  else{ 
    echo "<script>alert('Unable to Login...! ');</script>";
  }
}
?>
   
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="login">
          <div class="wrapper">
            <div class="form-container sign-in">
              <form name="login" method="post" action="index.php">
                <h1>Login</h1>
                <!-- UserName -->
                <div class="form-group">
                  <input type="name" class="form-control" id="u_name" name="u_name" required>
                  <i class="fas fa-user"></i>
                  <label for="">Username</label>
                </div>
                <!-- Password -->
                <div class="form-group ">
                  <input type="password" class="password" id="pass" name="pass" required>
                  <i class="fas fa-lock"></i>
                  <label for="">Password</label>
                  <label for="">Password</label>
                  <i class="fas fa-lock"></i>
                 
                </div>
                <div class="okay col-3 col-sm-5 col-lg-5  "><i class="eyee uil uil-eye-slash"></i></div>
                
                <script>
                  eyee = document.querySelector(".eyee"),
                  input =document.querySelector(".password"); 


                  eyee.addEventListener("click", function(){
                    if(input.type==='password'){
                      input.setAttribute('type','text');
                      eyee.classList.replace("uil-eye-slash","uil-eye");
                    }else{
                      input.setAttribute('type','password');
                      eyee.classList.replace("uil-eye","uil-eye-slash");
                    }
                  })

                </script>
    
          <!-- FORGET PASSWORD -->
                <div class="forgot-pass">
                  <a href="ForgotPassword2/verification.php">forgot password?</a>
                </div>
                <!-- SubmitButton -->
                <br>
                <button type="submit" class="btn btn-lg btn-block btn-success">Sign in</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
<style>
  
.eyee{
font-size:30px;
cursor:pointer;
}
.okay{
  cursor:pointer;
  position:absolute;
  right:7px;
  transform:translate(0,-50%);
  top:65%;
}

  </style>
</html>