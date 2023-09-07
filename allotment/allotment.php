<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>allotment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <form style="padding:30px;" class="row g-1" method="post" action="allotment.php">


        <div style="padding: 15px;" class="container ">
            <label for="drop1">Academic Year:-</label>

            <div class="year">
                <select name="ay" class="form-select" aria-label="Default select example" id="drop1">

                    <option class="col-md-3 col-sm-3" value="<?php echo (date("Y")); ?>">
                        <?php echo date("Y") . '-' . (date("y") + 1);
                        ?></option>

                    <option class="col-md-3 col-sm-3" value="<?php echo (date("Y") - 1); ?>">
                        <?php echo (date("Y") - 1) . '-' . date("y");                                                               ?></option>
                </select>
            </div>
        </div>
        <div class="div">
            <hr class="mx-n3">
        </div>

        <div style="padding: 15px;" class=" department container justify-content-center">
            <label for="drop2">Exam type :-</label>
            <select name="exam" class="form-select" aria-label="Default select example" id="exam">
                <option disabled selected>Select Exam type </option>
                <option value="1">Class test </option>
                <option value="2">Regular </option>
                <option value="3">ATKT</option>
            </select>
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
    <?php require '../connect.php';

    if (isset($_POST['exam'])) { ?>
        <div class="table-responsive">
            <table border='1' class='table table-hover mx-auto px-auto' id="table">
            <?php
            echo "
            <thead class='thead-dark'>
            
            <th>Date</th>
            <th>nob</th>
           
            </thead>
            ";

            $e = $_POST["exam"];
            $ay = $_POST['ay'];
            $sql = "SELECT `date`, SUM(nob) as nob FROM timetable  WHERE e_id='$e' and academic_year='$ay' group by date;";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            if ($result) {
                $result1 = $result->fetch_all(MYSQLI_ASSOC);
               
                foreach ($result1 as $row){
                   
                        $date = $row['date'];
                        $nob = $row['nob'];
                        echo "<tr> 
                    <td>" . $date . "</td>
                     <td>" . $nob . "</td>          
                </tr>
                ";
                    }
            } else {
                echo "No data found";
            }
        } else {
            echo "<script>";
            echo 'alert("Please Select Exam type")';
            echo "</script>";
        }
            ?>

        </div>

</body>

</html>