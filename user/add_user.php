<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="
https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js
"></script>
</head>

<body>

<style>

    .year select:focus {
            border:3px solid rgba(11, 11, 11, 0.895);
            
        }
    .department select:focus{
            border:3px solid rgba(11, 11, 11, 0.895);
            
    }

    .prof select:focus{
            border:3px solid rgba(11, 11, 11, 0.895);
            
    }

    .user input:focus{
             border:3px solid rgba(11, 11, 11, 0.895);
        
    }
    
    .pass input:focus{
             border:3px solid rgba(11, 11, 11, 0.895);
            
    }

    body{
        background-color:#eee;
        font-weight:500;
        font-size:20px;
    }
      
input[type="radio"] {
    background: #fff;
    transition: 300ms ease-in-out 0s;
    cursor: pointer;
    
}
</style>


<div style="max-width: 818px; "class="container">
  <div style=" margin-top: 70px; padding-top: 30px;
padding-bottom: 30px;
background-color:white; border-radius:10px;" class="containermaintext container">
                <h3 style="font-size:30px" class="text-center">ADD NEW USER</h3>
            </div><hr class="mx-n3">  
    </div>
    <div style="padding-top:20px;justify-content:center;" class="d-flex ">
        
    <div style="background-color:white;border-radius:10px; box-shadow:5px 25px 35px #3535356b" class="d-flex col-sm-4 col-md-6 col-lg-5">
    
        <form style="padding:30px;" class="row g-1" method="post" action="add_user.php">


        <div style="padding: 15px;" class="container ">
            <label for="drop1">Academic Year:-</label>
            
            <div class="year">
            <select class="form-select" aria-label="Default select example" id="drop1">
                <?php
                if (date("m") > 5) {
                ?>
                    <option class="col-md-3 col-sm-3" value="2022-2023"><?php echo date("Y") . '-' . (date("y") + 1);
                                                                        ?></option>
                <?php } else { ?>
                    <option class="col-md-3 col-sm-3" value="2023-2024"><?php echo (date("Y") - 1) . '-' . date("y");
                                                                        ?></option>
                <?php } ?>
            </select>
        
            </div>

            

        </div>
        <div class="div">
        <hr class="mx-n3">
        </div>

        <div style="padding: 15px;" class=" department container justify-content-center">
            <label for="drop2">Department:-</label>
            <select class="form-select" aria-label="Default select example" id="department" name="d_id">
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

        <div class="div">
        <hr class="mx-n3">
        </div>
        

        <div style="padding: 15px;" class="prof container justify-content-center">
            <label for="drop2">ProfessorName:-</label>
            <select class="form-select" aria-label="Default select example" id="p_id" name="p_id">
            <option disabled selected>Select professor</option>
                

            </select>


        </div>

        <div class="div">
        <hr class="mx-n3">
        </div>

        

        <div style="padding: 15px;" class="user container">
                <label for="">Email:-</label>
                <div class=" ok input-group mb-3">
                    
                    <input type="email" class="form-control" placeholder="Email" name="email">
                </div>

            </div>

            <div class="div">
        <hr class="mx-n3">
        </div>
            <div style="padding: 15px;" class="user container">
                <label for="">Username:-</label>
                <div class=" ok input-group mb-3">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" placeholder="Username" name="username">
                </div>

            </div>

            <div class="div">
        <hr class="mx-n3">
        </div>
        

            <div style="padding: 15px;" class="pass container">
                <label for="">Password:-</label>
                <div class="input-group mb-3">

                    <span class="input-group-text">$</span>
                    <input type="password" class="form-control" name="password" placeholder="Password">


                </div>

            </div>

            <div class="div">
        <hr class="mx-n3">
        </div>
        
        

            <div style="padding: 20px;text-align: center;" class="container">
                <label>Type:-</label>

                <div class="form-check form-check-inline ">
                    <input type="radio" name="type" id="Admin" value="A">
                    <label for="Admin">Admin</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="type" id="Other" value="O">
                    <label for="Other">Other</label>
                </div>
                <br>
                <label style="padding-top: 10px;" for="">Active:-</label>

                <div class="form-check form-check-inline ">
                    <input type="radio" name="active" id="Yes" value="A">
                    <label for="Yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="active" id="No" value="I">
                    <label for="No">No</label>
                </div>

            </div>

                <div class="div">
        <hr class="mx-n3">
        </div>
        
                <div style="padding: 20px;" class="container">

                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary" type="submit">Submit</button>
                    </div>
                </div>

    </form>
    </div>
    </div>
    <?php

    if (isset($_POST["username"])) {
        $user = $_POST["username"];
        $pass = $_POST["password"];
        $type = $_POST["type"];
        $acti = $_POST["active"];
        $d_id = $_POST['d_id'];
        $p_id = $_POST['p_id'];
        $email=$_POST['email'];
        //echo "$user,$pass,$type,$acti,$d_id,$p_id";
        $sql = "INSERT INTO `login` VALUES ('$user','$pass','$type','$acti','$p_id','$email')";
        //echo "<script>alert('$user')</script>";
        $q = $conn->query($sql);
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