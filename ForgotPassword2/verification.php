<?php
//error_reporting(0);
session_start();
include('../connect.php');
include('sendotp.php');
if($_SERVER['REQUEST_METHOD']='POST'){


    if($_POST['submit1']==true){
     $c=0;
        $input_email=$_POST['email'];
     $sql="select * from login";
     if($result=$conn->query($sql)){
        while($row=$result->fetch_assoc()){
           $email=$row['email'];
           if($input_email==$email){
         
              $otp = generateOTP();
             
              if (sendOTPByEmail($input_email, $otp)) {
            
                $sql2="select username from login where email='$email'";
                $result2=$conn->query($sql2);
                $row2=$result2->fetch_assoc();
                $username=$row2['username'];
                // Temporarily store the OTP And username on the server
               $_SESSION['otp']=$otp;
               $_SESSION['username']=$username; 
                echo '<div class="alert alert-success alert-dismissible fade-show">
                <strong>OTP Sent Successfully</strong>
              </div>';

                  $c=1;//validation
                  //?email='.$input_email.'
                 //Redirection Link
                echo '<META HTTP-EQUIV="Refresh" Content="0.5; URL=otp2.php">';
                //echo "<script>window.location.href='otp2.php?email=$input_email'; </script>";
                break;
            }
            //IF Email is not send
            else {
                echo '<div class="alert alert-danger alert-dismissible fade-show">
			<a href="verification.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			Unable To Sent <strong>OTP!</strong>
		  </div>';
            }
            }
          }

         if($c==0){
          //If NO Email is found
          echo '<div class="alert alert-danger alert-dismissible fade-show">
			<a href="verification.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Invalid! Email</strong>.
		  </div>';
    }
}
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
            width: 38vw;
            height:35vh;
            border-radius: 20px;
            box-shadow: 0 5px 5px rgba(0, 0, 0, .4);
            margin: 5em auto;
            display: flex;
            
        }
       

        @media screen and (max-width: 640px) {
            .main-content {
                width: 90vw;
                
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
            width: 70%;
            border-radius: 30px;
            color: #424747;
            font-weight: 600;
            background-color: #fff;
            border: 1px solid #080808;
            margin-top: 1em;
            margin-bottom: 1em;
        }
.btn:hover{
    border-radius: 15px;

}
        .ok span {
            position: absolute;
            width: 80px;
            line-height: 106px;
            color: #5a5858;
        }

        .row input {
            border-radius: 5px;
            background-color: transparent;
        }

        .ok input:hover {
            border-radius: 15px;
            background-color: rgba(173, 172, 172, 0.427);
        }
    </style>
</head>

<body>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>

    <div class="container-fluid">
        <div class="row main-content  text-center">
            <div class="col-12 login_form ">
                <div class="container-fluid">

                    <div class="row" style="margin-top: 10px;">
                        <h2>Verification</h2>
                     </div>


                    <div class="row">
                        <form action="verification.php" method="POST" class="form-group">

                         <!--Email Field-->
                            <div class="row ok">
                                <span class="fa fa-lock"></span>
                                <input type="email" placeholder="Enter your Email" name="email" class="form__input" autocomplete="off" required>
                            </div>


                            <!--Submit Button-->
                            <div class="row" style="justify-content: center;">
                                <input type="submit" value=" Generate OTP" name="submit1" class="btn btn-primary">
                            </div>

                             <!--Message-->
                            <div class="row">
                                <h6>A OTP will sent on your email</h6>
                            </div>
                         
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>