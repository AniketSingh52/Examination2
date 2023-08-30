<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="
https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js
"></script>
</head>

<body>
    <form class="row g-3" method="post" action="add_user.php">

        <div style="padding: 20px;" class="container "><h3>
                  <label for="drop1">Academic Year:-</label>
                  
                    <?php
                    if (date("m") > 5) {
                    ?>
                      <?php echo date("Y") . '-' . (date("y") + 1);
                                                                          ?>
                    <?php } else { ?>
                      <?php echo (date("Y") - 1) . '-' . date("y");
                                                                          ?></h3>
                    <?php } ?>
                    </h3>
                </div>
               

        <div style="padding: 20px;" class="container justify-content-center">
            <label for="drop2">Department:-</label>
            <select class="form-select" aria-label="Default select example" id="department" name="d_id" required>
                <option disabled selected>Select Department</option>
                <?php
                require "../connect.php";
                $sql = "SELECT * FROM department;";
                $result = mysqli_query($conn, $sql);
                while ($department = mysqli_fetch_assoc($result)) {
                    echo "<option id='d_id' value='" . $department['d_id'] . "'>" . $department['name'] . "</option>";
                }
                ?>

            </select>

        </div>

        <div style="padding: 20px;" class="container justify-content-center">
            <label for="drop2">ProfessorName:-</label>
            <select class="form-select" aria-label="Default select example" id="p_id" name="p_id" required>
            <option disabled selected>Select professor</option>
                

            </select>

        </div>


            <div style="padding: 20px;" class="container">
                <label for="">Username:-</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>
            </div>
            <div style="padding: 20px;" class="container">
                <label for="">Password:-</label>
                <div class="input-group mb-3">

                    <span class="input-group-text">$</span>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>


                </div>
            </div>

            <div style="font-size: 20px;padding: 20px;text-align: center;" class="container">
                <label for="">Type:-</label>

                <div class="form-check form-check-inline ">
                    <input type="radio" name="type" id="Admin" value="A" checked>
                    <label for="Admin"  >Admin</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="type" id="Other" value="O">
                    <label for="Other">Other</label>
                </div>
                <br>
                <label style="padding-top: 10px;" for="">Active:-</label>

                <div class="form-check form-check-inline ">
                    <input type="radio" name="active" id="Yes" value="A" checked>
                    <label for="Yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="active" id="NO" value="I">
                    <label for="No">No</label>
                </div>
                <div style="padding: 10px;" class="container">

                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary" type="submit">Submit</button>
                    </div>

    </form>
    <?php

    if (isset($_POST["d_id"]) && ($_POST["p_id"])) {
        $user = $_POST["username"];
        $pass = $_POST["password"];
        $type = $_POST["type"];
        $acti = $_POST["active"];
        $d_id = $_POST['d_id'];
        $p_id = $_POST['p_id'];
       //echo "$user,$pass,$type,$acti,$d_id,$p_id";
        $sql = "INSERT INTO `login` VALUES ('$user','$pass','$type','$acti','$p_id')";
        //echo "<script>alert('$user')</script>";
        $q = $conn->query($sql);
        //        header("location:admin.php");
        //            exit();
        if($q){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
            <strong>Sucess!</strong> Data saved sucessfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';}
              
         else{
           echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
            <strong>Error!</strong> something went wrong.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
         }
        }
        else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
            <strong>Warning!</strong> please select a valid department and name .
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $('#department').change(function() {
        var d_id = $(this).val();
        //alert (d_id);

        $.ajax({

          type: 'POST',
          cache: false,
          url: 'add_user2.php',
          data: {
            id: d_id
          },
          success: function(data) {
            $('#p_id').html(data);
          }
        });
      });
    });
    </script>
    
</body>

</html>