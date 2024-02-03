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
		<h3 style="font-size:30px;font-weight:bold;color:gray;text-align:center;">Display Supervision Chart</h3>
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
    <?php require '../connect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    if (isset($_POST['exam'])) { ?>
        <div class="table-responsive">
            <table border='1' class='table table-hover mx-auto px-auto' id="table">
            <?php
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
            <strong>Sucess!</strong> Data saved sucessfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

            $e = $_POST["exam"];
            $ay = $_POST['ay'];
            $sql = "SELECT `date`, SUM(nob) as nob FROM timetable  WHERE e_id='$e' and academic_year='$ay' group by date;";
            $sql1="SELECT * FROM professor WHERE unfair_means = 'N' ORDER BY doj DESC";
            $result = mysqli_query($conn, $sql);
            $result1 = $conn->query($sql1);
            $count = mysqli_num_rows($result);
            $count1 = mysqli_num_rows($result1);
            // Prepare an array to hold professor duty allocations
            $professorDuties = [];
            if ($result) {
                $resultt = $result->fetch_all(MYSQLI_ASSOC);
               
                foreach ($resultt as $row){
                   
                        $date = $row['date'];
                        $blocks = $row['nob'];
                        
                        // Reset professors list for each exam date
                        $result1->data_seek(0);
                        while ($blocks > 0 && $professor = $result1->fetch_assoc()) {
                            $p_id = $professor['p_id'];
                    
                            // Step 3: Check professor availability
                            $unavailabilityQuery = "SELECT * FROM unavailability WHERE p_id = '$p_id' AND date = '$date'";
                            $unavailable = $conn->query($unavailabilityQuery);
                    
                            if ($unavailable->num_rows == 0) { 
                                $dept="SELECT d_id FROM p_department WHERE p_id='$p_id'";
                                // Professor is available
                                // Check if professor is from the science department
                                $isScience = ($dept == 1);
                    
                                // Avoid over-allocating to science professors
                                if (!$isScience || ($isScience && @$professorDuties[$p_id] < ($blocks - 2))) {
                                    // Step 4: Allocate duty
                                    $professorDuties[$p_id] = isset($professorDuties[$p_id]) ? $professorDuties[$p_id] + 1 : 1;
                    
                                    // Step 5: Store in 'display' table
                                    $insertSql = "INSERT INTO display (p_id, date,e_id,a_year) VALUES ('$p_id', '$date',$e,'$ay')";
                                    $conn->query($insertSql);
                    
                                    $blocks--;
                                }
                            }
                        }
                    }
            } else {
                echo "No data found";
            }
        } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style=" width:100%; position: fixed; top: 0; left: 0; ">
            <strong>Warning!</strong> please select a valid Exam type. .
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            
        }
           } ?>

        </div>

</body>

</html>