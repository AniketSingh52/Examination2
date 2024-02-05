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
    if (isset($_POST['exam']) && isset($_POST['ay'])) {
        $e = $_POST["exam"];
        $ay = $_POST['ay'];

        // Use prepared statements to prevent SQL injection
        $stmt1 = $conn->prepare("SELECT * FROM professor WHERE unfair_means = 'N' AND designation != 'HOD' ORDER BY doj DESC");
        if (!$stmt1) {
            die("Error in preparing statement: " . $conn->error);
        }
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        $stmt12 = $conn->prepare("SELECT * FROM professor WHERE unfair_means = 'N' AND designation = 'HOD' ORDER BY doj DESC");
        if (!$stmt12) {
            die("Error in preparing statement: " . $conn->error);
        }
        $stmt12->execute();
        $result12 = $stmt12->get_result();

        $stmt2 = $conn->prepare("SELECT SUM(nob) as nob FROM timetable WHERE e_id=? AND academic_year=?");
        if (!$stmt2) {
            die("Error in preparing statement: " . $conn->error);
        }
        $stmt2->bind_param("is", $e, $ay);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        $row = $result2->fetch_assoc();
        $total_nob = $row["nob"];

        $totalDuties = ceil($total_nob / mysqli_num_rows($result1));
        $totalDuties_ss = ceil($total_nob / 10);

        $stmt3 = $conn->prepare("SELECT `date`, SUM(nob) as nob FROM timetable WHERE e_id=? AND academic_year=? GROUP BY date");
        if (!$stmt3) {
            die("Error in preparing statement: " . $conn->error);
        }
        $stmt3->bind_param("is", $e, $ay);
        $stmt3->execute();
        $result3 = $stmt3->get_result();

        $count_ss = mysqli_num_rows($result3);

        $professorDuties_ss = [];

        if ($result3) {
            while ($row_ss = $result3->fetch_assoc()) {
                $date = $row_ss['date'];
                $blocks = ceil($row_ss['nob'] / 10);
                $role = 'ss';

                $stmt12->data_seek(0);

                while ($blocks > 0 && $professor = $result12->fetch_assoc()) {
                    $p_id = $professor['p_id'];

                    $unavailabilityQuery = "SELECT * FROM unavailability WHERE p_id = ? AND date = ?";
                    $stmt4 = $conn->prepare($unavailabilityQuery);
                    if (!$stmt4) {
                        die("Error in preparing statement: " . $conn->error);
                    }
                    $stmt4->bind_param("is", $p_id, $date);
                    $stmt4->execute();
                    $unavailable = $stmt4->get_result();

                    if ($unavailable && $unavailable->num_rows == 0) {
                        $deptQuery = "SELECT d_id FROM p_department WHERE p_id=?";
                        $stmt5 = $conn->prepare($deptQuery);
                        if (!$stmt5) {
                            die("Error in preparing statement: " . $conn->error);
                        }
                        $stmt5->bind_param("i", $p_id);
                        $stmt5->execute();
                        $deptResult = $stmt5->get_result();

                        if ($deptResult && $deptRow = $deptResult->fetch_assoc()) {
                            $isScience = ($deptRow['d_id'] == 1);
                        } else {
                            $isScience = false;
                        }

                        $professorDuties_ss[$p_id] = isset($professorDuties_ss[$p_id]) ? $professorDuties_ss[$p_id] + 1 : 1;
                        $maxDuties = $isScience ? ($totalDuties_ss - 2) : $totalDuties_ss;

                        if ($professorDuties_ss[$p_id] <= $maxDuties) {
                            $insertSql = "INSERT INTO allotment (`p_id`,  `date`, `e_id`, `a_year`, `role`) VALUES (?, ?, ?, ?, ?)";
                            $stmt6 = $conn->prepare($insertSql);
                            if (!$stmt6) {
                                die("Error in preparing statement: " . $conn->error);
                            }
                            $stmt6->bind_param( $p_id, $date, $e, $ay, $role);
                            $stmt6->execute();

                            $blocks--;
                        }
                    }
                }
            }

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width:100%; position: fixed; top: 0; left: 0;">
                <strong>Success!</strong> Data saved successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        } else {
            echo "No data found";
        }

        // Rest of your code...
    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="width:100%; position: fixed; top: 0; left: 0;">
            <strong>Warning!</strong> Please select a valid Exam type and Academic Year.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
}
?>






        </div>

</body>

</html>