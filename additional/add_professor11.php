<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/587a7128aa.js" crossorigin="anonymous"></script>
  <script src="
https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js
"></script>
  <style>
    body {
      text-align: center;
      margin-top: 35px;
      background-color: #f1ff70;

    }

    .dropdown {
      margin-left: 20px;
    }
  </style>
</head>

<body>

  <form method="post" action="add_professor.php">
    <section class="vh-100" style="background-color: #f1ff70;">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-9">

            <h1 class="text-black mb-4">Add New Professor</h1>

            <div class="card" style="border-radius: 15px;">
              <div class="card-body">

              <!-- ACADEMIC YEAR BLOCK -->
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
               


                <!-- FULL NAME BLOCK -->
                <div class="row align-items-center py-0">
                  <div class="col-md-3 ps-0">
                    <h6 class="mb-0">Full Name</h6>
                  </div>
                  <div class="col-md-9 pe-5">
                    <div class="dropdown row">
                      <div class=" text-center"></div>
                      <input type="name" placeholder="Enter fullname" name="pname" id="profname" class="form-control form-control-lg" />
                    </div>
                  </div>
                </div>

                <hr class="mx-n3">

                <div class="row align-items-center py-0">
                  <div class="col-md-3 ps-0">
                    <h6 class="mb-0">Date of joining</h6>
                  </div>
                  <div class="col-md-9 pe-5">
                    <div class="dropdown row">
                      <div class=" text-center"></div>
                      <input type="date" placeholder="Enter date of joining " name="doj" id="doj" class="form-control form-control-lg" />
                    </div>
                  </div>
                </div>

                <hr class="mx-n3">

                

                <!-- DEPARTMENT BLOCK -->
                <div class="row align-items-center py-0">
                  <div class="col-md-3 ps-0">
                    <h6 class="mb-0">Department</h6>
                  </div>
                  <div class="col-md-9 pe-5">

                    <div class="dropdown row">
                      <div class="col-12 text-center"></div>
                      <select name="department" id="department">
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
                      <br>
                    </div>
                  </div>
                </div>

                <hr class="mx-n3">

                <!-- PROGRAMME BLOCK -->
                <div class="row align-items-center py-0">
                  <div class="col-md-3 ps-0">
                    <h6 class="mb-0">Programme</h6>
                  </div>
                  <div class="col-md-9 pe-5">

                    <div class="dropdown row">
                      <div class="col-12 text-center"></div>
                      <select name="programme" id="programme" onchange="getprogramme(this.value);">

                        <option disabled selected>Select programme</option>
                      </select>
                      <br>
                    </div>
                  </div>
                </div>

                <hr class="mx-n3">

                <!-- COURSE BLOCK -->
                <div class="row align-items-center py-0">
                  <div class="col-md-3 ps-0">
                    <h6 class="mb-0">Course</h6>
                  </div>
                  <div class="col-md-9 pe-5">
                    <div class="dropdown row">
                      <div class="col-12 text-center"></div>
                      <select name="course" id="course">
                        <option disabled selected>Select course</option>
                      </select>
                      <br>
                    </div>
                  </div>
                </div>

                <hr class="mx-n3">

                <!-- TYPE BLOCK -->
                <div class="row align-items-center py-0">
                  <div class="col-md-3 ps-0">
                    <h6 class="mb-0">Type</h6>
                  </div>
                  <div class="col-md-9 pe-5">
                    <div class="dropdown row">
                      <div class="alignradio1 col-10 text-center">
                        <div class="form-check form-check-inline ">
                          <input type="radio" name="type" id="regular" value="R" checked>
                          <label for="regular"><b>Regular</b></label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input type="radio" name="type" id="visiting" value="V">
                          <label for="visiting"><b>Visiting</b></label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <hr class="mx-n3">

                <!-- EXAM COMMITEE BLOCK -->
                <div class="row align-items-center py-0">
                  <div class="col-md-3 ps-0">
                    <h6 class="mb-0">Exam Commitee Member</h6>
                  </div>

                  <div class="col-md-9 pe-5">
                    <div class="dropdown row">
                      <div class="alignradio1 col-10 text-center">
                        <div class="form-check form-check-inline ">
                          <input type="radio" name="ecm" id="" value="yes">
                          <label for="yes"><b>Yes</b></label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input type="radio" name="ecm" id="" value="no">
                          <label for="no"><b>No</b></label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <hr class="mx-n3">

                <!-- DESIGNATION BLOCK -->
                <div class="row align-items-center py-0">
                  <div class="col-md-3 ps-0">
                    <h6 class="mb-0">Designation</h6>
                  </div>
                  <div class="col-md-9 pe-5">

                    <div class="dropdown row">
                      <div class="col-12 text-center"></div>
                      <select name="designation" id="dsgn">
                        <option selected disabled>Select Designation</option>
                        <option>Dean</option>
                        <option>HOD</option>
                        <option>Professor</option>
                        <option>Associate Professor</option>
                        <option>Assitant Professor</option>
                      </select>
                      <br>
                    </div>
                  </div>
                </div>

                <hr class="mx-n3">

                <!-- REGULAR SFC BOTH BLOCK -->
                <div class="form-check form-check-inline ">
                  <input type="radio" name="staff" value="reg"><label for="regu"><b>Regular</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="radio" name="staff" value="sfc"><label for="sfc"><b>SFC</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <input type="radio" name="staff" value="both"><label for="both"><b>Both</b></label>

                </div>
                <br>

                <div class="px-5 py-4">

                  <!-- SUBMIT BUTTON BLOCK -->
                  <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </form>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#department').change(function() {
        var d_id = $(this).val();
        // alert (d_id);

        $.ajax({

          type: 'POST',
          cache: false,
          url: 'fetch.php',
          data: {
            id: d_id
          },
          success: function(data) {
            $('#programme').html(data);
          }
        });
      });
    });

    $(document).ready(function() {
      $('#programme').change(function() {
        var pr_id = $(this).val();


        $.ajax({

          type: 'POST',
          cache: false,
          url: 'fetchcourse.php',
          data: {
            id: pr_id
          },
          success: function(data) {
            $('#course').html(data);
          }
        });
      });
    });
  </script>
  <?php
  require ("../connect.php");
  if(isset($_POST['pname'])){
    $name=$_POST["pname"];
    $doj= $_POST['doj'];
    $dept=$_POST['programme'];
    $prog=$_POST['department'];
    $course=$_POST['course'];
    $type=$_POST['type'];
    $ecm=$_POST['ecm'];
    $designation=$_POST['ecm'];
    $staff=$_POST['staff'];
    $sql="INSERT INTO `professor`( `name`,`d_id`,`doj`,`reg_sfc`,`type`,`ecm`,`designation`)
    VALUES ('$name','$dept','$doj','$staff','$type','$ecm','$designation')";

    $q=$conn->query($sql);
    if($q){
       echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
       <strong>Sucess!</strong> Data saved sucessfully.
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
    } 
    else{
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
       <strong>Error!</strong> something went wrong.
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
    }

  }
  ?>
</body>

</html>








