<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Examination Committee</title>
    <link rel="shortcut icon" href="../fevicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="css/buttons.css" type="text/css">
      <pages enableSessionState="true" /> 
</head>
<!--  -->
<body>

    <!-- BACKGROUND IMG -->
    <!-- <div class="bg-image" 
style="   background-image: url('https://mdbootstrap.com/img/new/fluid/nature/011.jpg');

       height: 100vh"> -->
       <?php 
                                require "connect.php";
                               
                                $ecm='A';
                                if($ecm=='A')
                                {
                                    ?>
    <div class="content container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="frame">
                <form>
                            <div>
                                <!-- Feed TimeTable -->
                                <a href="table/index2.php" <button class="custom-btn btn-5 btn btn-lg btn-block"><span>Feed
                                        Time
                                        Table</span></button></a><br><br>
                                <!-- Manage Professor Duty -->
                                <a href="professor/manageprof.html" <button
                                    class="custom-btn btn-5 btn btn-lg btn-block "><span>Manage Professor
                                        Duty</span></button></a><br><br>
                                <!-- Allocate Duty -->
                                <a href="allotment/allotment.php" <button class="custom-btn btn-5 btn btn-lg btn-block"><span>Allocate
                                        duty</span></button></a><br><br>
                                <!-- Display SuperVision Chart -->
                                <a href="display/display.php" <button class="custom-btn btn-5 btn btn-lg btn-block"><span>Display supervision
                                        chart</span></button></a><br><br>
                            </div>
                            <!-- Manage User Info -->
                            <div><a href="user/manageuser.html" <button
                                    class="custom-btn btn-5 btn btn-lg btn-block"><span>Manage User
                                        Info</span></button></a><br>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

                        
    <?php } ?>
       
</body>

</html>