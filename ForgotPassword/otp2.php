<?php
include('../connect.php');
error_reporting(0);
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST['submit']==true){
    $email = $_GET["email"];
    

    //Checking If File Exist
    if (isset($_SESSION['otp'])) {
       $userOTP = $_POST["otp"];

        // Read the OTP from the server
        $storedOTP = $_SESSION['otp'];

        if ($userOTP === $storedOTP) {
            echo 
            '<div class="alert alert-success alert-dismissible fade-show">
			<a href="otp2.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Verification</strong> Successfull .
		  </div>';


            // Delete the OTP file after successful verification
            unset($_SESSION['otp']);
           session_destroy();
            //Redirection
            echo '<META HTTP-EQUIV="Refresh" Content="0.5; URL=../info-1.php">';
                
        }
        //If Entered OTP Is Incorrect
        else {
            echo '<div class="alert alert-danger alert-dismissible fade-show">
			<a href="otp2.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Invalid OTP!</strong> Retry.
		  </div>';
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
    color: white;
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
    
    <div class="container-fluid">

        <div class="row main-content  text-center">
            <div class="col-12 login_form ">
                <div class="container-fluid">

                    <!--Heading-->
                    <div class="row" style="margin-top: 10px;">
                        <h2>Enter OTP</h2>
                    </div>


                    <div class="row">
                        <form action="<?php $_PHP_SELF ?>" method="post" class="form-group">
                            <!-- Input Fiel For OTP-->
                            <div class="row ok">
                                <input type="text" placeholder="Enter your OTP" name="otp" class="form__input" autocomplete="off" required>
                            </div>

                            <!-- SUBMIT BUTTON-->
                            <div class="row" style="justify-content: center;">
                                <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                            </div>

                             <!-- Distinguisher-->
                            <div class="row"> 
                            <h5>or</h5>
                            </div>

                            <!-- BACK BUTTON-->
                            <div class="row" style="justify-content: center;">
                            <a href="verification.php"><input type="button" value="Back" name="back" class="btn btn-secondary"></a>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
