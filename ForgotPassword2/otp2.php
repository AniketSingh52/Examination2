<?php
include('../connect.php');
error_reporting(0);
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST['submit']==true){

   // $email = $_GET["email"];
    $n1=$_POST["n1"];
    $n2=$_POST["n2"];
    $n3=$_POST["n3"];
    $n4=$_POST["n4"];
    $otpp=($n1*1000)+($n2*100)+($n3*10)+$n4;
    //Checking If File Exist
    if (isset($_SESSION['otp'])&& !empty($_SESSION['username'])) {

       //$userOTP = $_POST["otp"];

        // Read the OTP and username from the server
        $storedOTP = $_SESSION['otp'];
        $username=$_SESSION['username'];
        if ($otpp == $storedOTP) {
            echo 
            '<div class="alert alert-success alert-dismissible fade-show">
			<a href="otp2.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Verification</strong> Successfull .
		  </div>';

          $sql="select type from login where username='$username'";
          $result=$conn->query($sql);
          $row=$result->fetch_assoc();
            if($row['type']=='A')
            {
            // Delete the OTP file after successful verification
            unset($_SESSION['otp']);
            unset($_SESSION['username']);
           session_destroy();
            //Redirection
            echo '<META HTTP-EQUIV="Refresh" Content="0.5; URL=../info-2.php">';
            }
            else
            {
                // Delete the OTP file after successful verification
            unset($_SESSION['otp']);
            unset($_SESSION['username']);
            session_destroy();
             //Redirection
             echo '<META HTTP-EQUIV="Refresh" Content="0.5; URL=../info-1.php">';


            }
                
        }
        //If Entered OTP Is Incorrect
        else {
            echo '<div class="alert alert-danger alert-dismissible fade-show">
			<a href="otp2.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Invalid OTP!</strong> Retry.
		  </div>';

          echo ' session opt is :- '.$storedOTP;
          echo 'opt is :- '.$otpp;
        }
           }

      }
//If File Does'nt Exist
else {
        echo '<div class="alert alert-warning alert-dismissible fade-show">
			<a href="otp2.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>OTP Reset! </strong> Retry  .
		  </div>';;
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enter Email For Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="otp.js" defer></script>
    <link rel="stylesheet" type="text/css" href="otp.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <style>
        body {
            background: rgba(87, 103, 247, 0.842);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            width: auto;
        }

        .main-content {
            width: 40%;
            height:43vh;
            border-radius: 20px;
            box-shadow: 0 5px 5px rgba(0, 0, 0, .4);
            margin: 5em auto;
            display: flex;
            
        }
       

        @media screen and (max-width: 640px) {
            .main-content {
                width: 90%;
            }

            .login_form {
                border-top-left-radius: 20px;
                border-bottom-left-radius: 20px;
                
            }
        }
      

        .row>h2 {
            margin-top:20px;
            color: #000000c3;
        }

        .login_form {
            background-color: #f1f1f1a9;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            border-top: 1px solid #ccc;
            border-right: 1px solid #ccc;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            height:43vh;
        }

        .login_form:hover {
            background-color: #ffffffda;
        }

        form {
            padding: 0 2em;
        }

        .form__input {
            width: 90%;
            border: 0px solid transparent;
            border-radius: 0;
            border-bottom: 1px solid #373737;
            padding: 1em .5em .5em;
            padding-left: 2em;
            outline: none;
            margin: 1.5em auto;
            transition: all .5s ease;
        }



        .btn {
            transition: all .5s ease;
            width: 100%;
            border-radius: 30px;
            color: black;
            font-weight: 600;
            background-color: white;
            border: 1px solid #080808;
            margin-top: 1em;
            margin-bottom: 1em;
        }
.btn:hover{
    border-radius: 15px;
    color: white;
    background-color: black;
    

}
        

        .row input {
            border-radius: 5px;
            background-color: transparent;
        }

   
    </style>
</head>

<body style="background:linear-gradient(to right, #292929, #aaaaaa);">
    
   
                   


    <div class="container">
     
         <span style="font-size:50px;" class="material-icons-outlined">lock_open</span>  

      <h2>Enter OTP Code</h2>
      <form action="<?php $_PHP_SELF ?>" method="post" class="form-group">
        <div class="input-field">
          <input type="number" name="n1" onfocus="startTimer()" max="9"/>
          <input type="number" name="n2" disabled />
          <input type="number" name="n3" disabled />
          <input type="number" name="n4" disabled />
        </div>

        <p style="padding-top:10px;font-size:20px;">If you Dont get OTP in  <span id="mobile"></span>  sec <a id="link" href="verification.php" disabled><u>click Here</u> </a> and again Enter Your Email!!</p>

        <script>
        var countdownValue = 30;
        var countdownInterval;

        function startTimer() {
            countdownInterval = setInterval(function () {
                if (countdownValue > 0) {
                    countdownValue--;
                    document.getElementById("mobile").innerText = countdownValue;
                    document.getElementById("link").removeAttribute("href");
                  //  document.getElementById("link").setAttribute("disabled");
                
                } else {
                    clearInterval(countdownInterval);
                   // document.getElementById("link").removeAttribute("disabled");
                    document.getElementById("link").setAttribute("href", "verification.php");

                }
            }, 1000);
        }
        </script>

        <!-- SUBMIT BUTTON-->
        <div class="row" style="justify-content: center;">
                <input style="width:100%;" type="submit" value="Submit" name="submit" class="btn btn--accent btn--outline">
        </div>

      </form>
    </div>

                    
                            
                    
  
    
</body>
</html>
