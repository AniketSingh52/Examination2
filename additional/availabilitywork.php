<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Allotment</title>
    <link rel="shortcut icon" href="../../fevicon.png">
    <link rel="stylesheet" href="update_prof.css" type="text/css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

<div style="margin-top:40px;background-color:white;border-radius:10px;padding:10px;max-width:800px;"class="container">
		<h3 style="font-size:30px;font-weight:bold;color:gray;text-align:center;">Allotment</h3>
		<!-- ACADEMIC YEAR BLOCK -->
		<div>
			<h3>
				<label style="margin-top:10px;display:flex;justify-content:center;"
					class="d-flex justify-content-center" for="drop1">Academic Year:-
					<?php
					if (date("m") > 5) {
						?>
						<?php echo date("Y") . '-' . (date("y") + 1); ?>
					<?php } else { ?>
						<?php echo (date("Y") - 1) . '-' . date("y"); ?>
					<?php } ?>
				</label>
			</h3>
		</div>
	</div>
	<div class="formm">
		<div class="sizeform">
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
                <option value="4">Class test2</option>
                <option value="5">Regular2</option>
            </select>
        </div>
        <div class="div">
            <hr class="mx-n3">
        </div>
        <div style="padding: 20px;" class="container">

            <div class="d-grid gap-2">
                <button class="btn btn-outline-primary" type="submit">Allocate</button>
            </div>
        </div>
    </form>
    <?php
require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['exam'])) {
        $e = $_POST["exam"];
        $ay = $_POST['ay'];

        // Get professors ordered by experience (DOJ: Date of Joining)
        $sql1 = "SELECT * FROM professor WHERE unfair_means = 'N' ORDER BY doj DESC";
        $result1 = $conn->query($sql1);
        
        // Get total no of blocks of any particular exam
        $sql = "SELECT  SUM(nob) as nob FROM timetable  WHERE e_id='$e' and academic_year='$ay';";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();
        $total_nob =$row["nob"];

        // Get the total number of professors
        $totalProfessors = mysqli_num_rows($result1);

        // Calculate the number of duties per professor
        $totalDuties = ceil($total_nob/$totalProfessors); //need modification

        // $sql = "SELECT `date`, SUM(nob) as nob FROM timetable  WHERE e_id='$e' and academic_year='$ay' group by date;";
        // $result = mysqli_query($conn, $sql);
        
        $sql = "SELECT `date`,nob,'pr_id','c_id' FROM timetable  WHERE e_id='$e' and academic_year='$ay';";
        $result = mysqli_query($conn, $sql);
        
        // $sqll = "SELECT * FROM timetable  WHERE e_id='$e' and academic_year='$ay';";
        // $result2 = mysqli_query($conn, $sqll);
        
        $count = mysqli_num_rows($result);

        // Prepare an array to hold professor duty allocations
        $professorDuties = [];

        if ($result) {
            $resultt = $result->fetch_all(MYSQLI_ASSOC);
            // $resultt2 = $result2->fetch_all(MYSQLI_ASSOC);

            foreach ($resultt as $row) {
                $date = $row['date'];
                $blocks = $row['nob'];
                $pr_id=$row['pr_id'];
                $c_id=$row['c_id'];
                $role='js';

                // Reset professors list for each exam date
                // $result1->data_seek(0);

                while ($blocks > 0 && $professor = $result1->fetch_assoc()) {
                    $p_id = $professor['p_id'];

                    // Step 3: Check professor availability
                    $unavailabilityQuery = "SELECT * FROM unavailability WHERE p_id = '$p_id' AND date = '$date'";
                    $unavailable = $conn->query($unavailabilityQuery);

                    if ($unavailable->num_rows == 0) {
                        // Professor is available
                        $dept = "SELECT d_id FROM p_department WHERE p_id='$p_id'";

                        // Check if professor is from the science department
                        $isScience = ($dept == 1);

                        // Calculate the number of duties for this professor
                        $professorDuties[$p_id] = isset($professorDuties[$p_id]) ? $professorDuties[$p_id] + 1 : 1;

                        // Avoid over-allocating to science professors
                        $maxDuties = $isScience ? ($totalDuties - 2) : $totalDuties;

                        if ($professorDuties[$p_id] <= $maxDuties) {
                            // Step 4: Allocate duty
                            $insertSql = "INSERT INTO allotment (`p_id`,'pr_id','c_id', `date`,`e_id`,`a_year`,'role') VALUES ('$p_id','$pr_id','$c_id', '$date',$e,'$ay','$role')";
                            $conn->query($insertSql);

                            $blocks--;
                        }
                    }
                }
            }

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
                <strong>Success!</strong> Data saved successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        } else {
            echo "No data found";
        }
    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
            <strong>Warning!</strong> Please select a valid Exam type.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
}
?>


        </div>

</body>

</html>