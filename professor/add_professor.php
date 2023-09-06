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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
  <style>
    .multiselect {
      width: 200px;
    }

    .selectBox {
      position: relative;
    }

    .selectBox select {
      width: 100%;
      font-weight: bold;
    }

    .overSelect {
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
    }
  

    #checkboxes {
      display: none;
      border: 1px #dadada solid;
    }

    #checkboxes label {
      display: block;
    }

    #checkboxes label:hover {
      background-color: #1e90ff;
    }

    body {
      background: #eee;
      min-height: 100vh;
    }

    .wrapper {
      max-width: 800px;
      margin: 10px auto;
      padding: 30px 45px;
      box-shadow: 5px 25px 35px #3535356b;
      background-color: white;
      border-radius: 10px;
    }
    

    .wrapper label {
      display: inline;
      padding-bottom: 0.2rem;
    }

    .wrapper .form .row {
      padding: 0.6rem 0;
    }

    .wrapper .form .option {
      position: relative;
      padding-left: 20px;
      cursor: pointer;
    }


    .wrapper .form .option input {
      opacity: 0;
    }

    .wrapper .form .checkmark {
      position: absolute;
      top: 1px;
      left: 0;
      height: 20px;
      width: 20px;
      border: 1px solid #bbb;
      border-radius: 50%;
    }



    .wrapper .form .option .checkmark:after {
      content: "";
      width: 10px;
      height: 10px;
      display: block;
      background: linear-gradient(45deg, #ce1e53, #8f00c7);
      position: absolute;
      top: 50%;
      left: 50%;
      border-radius: 50%;
      transform: translate(-50%, -50%) scale(0);
      transition: 300ms ease-in-out 0s;
    }

    .wrapper .form .option input[type="radio"]:checked~.checkmark {
      background: #fff;
      transition: 300ms ease-in-out 0s;
    }

    .wrapper .form .option input[type="radio"]:checked~.checkmark:after {
      transform: translate(-50%, -50%) scale(1);
    }
  </style>
</head>

<body>

  <form method="post" action="add_professor.php">
    <div style="max-width: 818px; " class="container">
      <div style=" margin-top: 70px; padding-top: 30px;
padding-bottom: 30px;
background-color:white; border-radius:10px;" class="containermaintext container">
        <h3 style="font-size:30px" class="text-center">Add New Professor</h3>
      </div>
      <hr class="mx-n3">
    </div>
    <div class="wrapper">

      <!-- ACADEMIC YEAR BLOCK -->
      <div style="padding: 20px; " class=" container">
        <h3>
          <label class="d-flex  justify-content-center" for="drop1">Academic Year:-
            <?php
            if (date("m") > 5) {
            ?>
              <?php echo date("Y") . '-' . (date("y") + 1);  ?>
            <?php } else { ?>
              <?php echo (date("Y") - 1) . '-' . date("y");     ?>
            <?php } ?></label>
        </h3>
      </div>
      <div class="form">
        <div class="row">
          <div class="col-md-6 mt-md-0 mt-3">
            <label>Full Name</label>
            <input type="name" placeholder="Enter Full Name" name="pname" id="profname" class="form-control " />
          </div>

          <!-- DATE OF JOINING -->
          <div class="col-md-6 mt-md-0 mt-3">
            <label>Date Of Joining</label>
            <input type="date" name="doj" id="doj" class="form-control " />
          </div>
        </div>
        <?php

        //index.php

        include('../connect.php');

        $query = "
          SELECT * FROM department 
ORDER BY name ASC
";
        $statement = $conn->prepare($query);
        $statement->execute();
        $resultSet = $statement->get_result();
        $result = $resultSet->fetch_all(MYSQLI_ASSOC);
        ?>
        <!-- DEPARTMENT BLOCK -->
        <div class="a">
        <div class="container">
          <div style="width: 500px; margin:0 auto">
            <div class="form-group">
              <label>Select Department(s)</Select></label><br />
              <select id="first_level" name="first_level[]" multiple class="form-control">
                <?php
                foreach ($result as $row) {
                  echo '<option value="' . $row["d_id"] . '">' . $row["name"] . '</option>';
                }
                ?>
              </select>
            </div>
            <!-- PROGRAMME BLOCK -->
            <div class="form-group container">
              <label>Select Program(s)</label><br />
              <select id="second_level" name="second_level[]" multiple class="form-control">

              </select>
            </div>
            <!-- COURSE BLOCK -->
            <div class="form-group container">
              <label>Select Course(s)</label><br />
              <select id="third_level" name="third_level[]" multiple class="form-control">

              </select>
            </div>
          </div>
        </div>
        </div>

        <!-- DESIGNATION BLOCK -->

        <div class="col-md-6 mt-md-0 mt-3">
          <label>Designation</lable>

            <div style="padding:10px; font-size:20px" class="dropdown row">
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

      <!-- type -->
      <div class="row">
        <div class="col-md-6 mt-md-0 mt-3">
          <label>Type</label>
          <div class="d-flex align-items-center mt-2">
            <label class="option">
              <input type="radio" name="type" id="regular" value="R">Regular
              <span class="checkmark"></span>
            </label>
            <label class="option ms-4">
              <input type="radio" name="type" id="visiting" value="V">Visiting
              <span class="checkmark"></span>
            </label>
          </div>
        </div>
        <!-- Examcommiteemember -->
        <div class="col-md-6 mt-md-0 mt-3">
          <label>Exam Commitee Member</label>
          <div class="d-flex align-items-center mt-2">
            <label class="option">

              <input type="radio" name="ecm" id="" value="yes">Yes
              <span class="checkmark"></span>
            </label>
            <label class="option ms-4">
              <input type="radio" name="ecm" id="" value="no">No
              <span class="checkmark"></span>
            </label>
          </div>
        </div>


      </div>
      <hr>
      <div class="row">
        <div class="col-md-12  ">
          <div class="d-flex justify-content-center mt-2">
            <label class="option">

              <input type="radio" name="staff" value="reg">Regular
              <span class="checkmark"></span>
            </label>
            <label class="option ms-4">
              <input type="radio" name="staff" value="sfc">SFC
              <span class="checkmark"></span>
            </label>
            <label class="option ms-4">
              <input type="radio" name="staff" value="both">Both
              <span class="checkmark"></span>
            </label>
          </div>
        </div>

        <button type="submit" class="btn btn-outline-primary  mt-3">Submit</button>

      </div>
    </div>
    </div>

    </div>
  </form>
  <script>
    $(document).ready(function() {

      $('#first_level').multiselect({
        nonSelectedText: 'Select Deparment(s)',
        buttonWidth: '90%',
        onChange: function(option, checked) {
          $('#second_level').html('');
          $('#second_level').multiselect('rebuild');
          $('#third_level').html('');
          $('#third_level').multiselect('rebuild');
          var selected = this.$select.val();
          
          if (selected.length > 0) {
            $.ajax({
              url: "fetch_second_level_category.php",
              method: "POST",
              data: {
                selected: selected
              },
              success: function(data) {
                $('#second_level').html(data);
                $('#second_level').multiselect('rebuild');
              }
            })
          }
        }
      });

      $('#second_level').multiselect({
        nonSelectedText: 'Select Program(s)',
        buttonWidth: '400px',
        onChange: function(option, checked) {
          $('#third_level').html('');
          $('#third_level').multiselect('rebuild');
          var selected = this.$select.val();
          if (selected.length > 0) {
            $.ajax({
              url: "fetch_third_level_category.php",
              method: "POST",
              data: {
                selected: selected
              },
              success: function(data) {
                $('#third_level').html(data);
                $('#third_level').multiselect('rebuild');
              }
            });
          }
        }
      });

      $('#third_level').multiselect({
        nonSelectedText: 'Select Course(s)',
        buttonWidth: '400px'
      });

    });
  </script>

  <?php
  require("../connect.php");
  if (isset($_POST['pname'])) {
    $name = $_POST["pname"];
    $doj = $_POST['doj'];
    $department = $_POST['first_level'];
   // $prog = $_POST['department'];
    $course = $_POST['third_level'];
    $type = $_POST['type'];
    $ecm = $_POST['ecm'];
    $designation = $_POST['designation'];
    $staff = $_POST['staff'];

    $sq = "INSERT INTO `professor`( `name`,`doj`,`reg_sfc`,`type`,`ecm`,`designation`)
    VALUES ('$name','$doj','$staff','$type','$ecm','$designation')";
    $res=$conn->query($sq);
    $sq2="Select p_id from professor where name='$name' and doj='$doj' and reg_sfc='$staff' and type='$type' and ecm= '$ecm' and designation='$designation'";
    $res2=$conn->query($sq2);
    $row = $res2->fetch_assoc();
    $id=$row['p_id'];
    foreach($department as $d){
    $sq3="INSERT INTO p_department VALUES ($id,$d);";
    $res3=$conn->query($sq3);
    }
    foreach($course as $c){
      $sq4="INSERT INTO p_course VALUES ($id,$c);";
    $res4=$conn->query($sq4);
    }
    if ($res4) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
       <strong>Sucess!</strong> Data saved sucessfully.
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
    } else {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
       <strong>Error!</strong> something went wrong.
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
    }
  }
  ?>


</body>

</html>