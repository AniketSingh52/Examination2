<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manageprofessor info</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<!--  -->
<body>
    <style>
        body {
            background-color: #f77878;
        }

        .login {
            padding: 15px;
            text-align: center;
            text-transform: uppercase;
            margin-top: 150px;
        }

        .login .btn {
            border-radius: 50px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 2px;
            font-size: 20px;
            white-space: normal;
            padding: 26px;
            background-color: #088af5;
        }
    </style>
    <!-- BACKGROUND IMG -->
    <!-- <div class="bg-image" 
style="   background-image: url('https://mdbootstrap.com/img/new/fluid/nature/011.jpg');

       height: 100vh"> -->
       <?php 
                                require "connect.php";

                                $query=mysqli_query($conn,"SELECT * FROM `login` WHERE username='".$_SESSION['username']."'");
                                while($row=mysqli_fetch_array($query))
                                {
                                    $ecm=$row['type'];
                                }
                                if($ecm=='A')
                                {
                                    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="login">
                    <form>
                        <br>
                        <div><a href="" class="  text-white btn btn-lg btn-block btn-danger">Feed Time Table</button></a><br>
                        <a href="professor/manageprof.html" class=" btn btn-lg btn-block btn-danger ">Manage Professor Duty</button></a><br>
                      
                        <a href="" class="btn btn-lg btn-block btn-danger ">Allocate duty</button></a><br>
                        <a href="" class="btn btn-lg btn-block btn-danger">Display supervision chart</button></a><br>
                    </div>
     
                                    <div>
                                    <a href="user/manageuser.html" class="  btn btn-lg btn-block btn-danger ">Manage User
                                        Info</button></a>
                                </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

                        
    <?php }else{ ?>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="login">
                    <form>
                        <br>
                        <div><a href="" class="  text-white btn btn-lg btn-block btn-danger">Feed Time Table</button></a><br>
                        <a href="professor/manageprof.html" class=" btn btn-lg btn-block btn-danger ">Manage Professor Info</button></a><br>
                      
                        <a href="" class="btn btn-lg btn-block btn-danger ">Allocate duty</button></a><br>
                        <a href="" class="btn btn-lg btn-block btn-danger">Display supervision chart</button></a><br>
                        <!-- </div>  --></div>
     
                    </form>
    <?php } ?>
</body>

</html>