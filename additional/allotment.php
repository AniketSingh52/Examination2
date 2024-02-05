<!DOCTYPE html>
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

<div style="margin-top:40px;background-color:white;border-radius:10px;padding:10px;max-width:800px;" class="container">
    <h3 style="font-size:30px;font-weight:bold;color:gray;text-align:center;">Allotment</h3>
    <!-- ACADEMIC YEAR BLOCK -->
    <div>
        <h3>
            <label style="margin-top:10px;display:flex;justify-content:center;" class="d-flex justify-content-center" for="drop1">Academic Year:-
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
                            <?php echo (date("Y") - 1) . '-' . date("y"); ?></option>
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

                $sql1 = "SELECT * FROM professor WHERE unfair_means = 'N' and designation != 'HOD' ORDER BY doj DESC";
                $result1 = $conn->query($sql1);

                $sql12 = "SELECT * FROM professor WHERE unfair_means = 'N' and designation = 'HOD' ORDER BY doj DESC";
                $result12 = $conn->query($sql12);

                $sql = "SELECT SUM(nob) as nob FROM timetable WHERE e_id='$e' AND academic_year='$ay';";
                $result = mysqli_query($conn, $sql);
                $row = $result->fetch_assoc();
                $total_nob = $row["nob"];

                $totalProfessors = mysqli_num_rows($result1);
                $totalDuties = ceil($total_nob / $totalProfessors);
                $totalDuties_ss = ceil($total_nob / 10);

                $sql = "SELECT `date`, `nob`, `pr_id`, `c_id` FROM timetable WHERE e_id='$e' AND academic_year='$ay';";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);

                $sql_ss = "SELECT `date`, SUM(nob) as nob FROM timetable  WHERE e_id='$e' and academic_year='$ay' group by date;";
                $result_ss = mysqli_query($conn, $sql_ss);
                $count_ss = mysqli_num_rows($result_ss);

                $professorDuties = [];
                $professorDuties_ss = [];

                if ($result_ss) {
                    $resultt_ss = $result_ss->fetch_all(MYSQLI_ASSOC);

                    foreach ($resultt_ss as $row_ss) {
                        $date = $row_ss['date'];
                        $blocks = ceil($row_ss['nob'] / 10);
                        $role = 'ss';

                        $result12->data_seek(0);

                        while ($blocks > 0 && $professor = $result12->fetch_assoc()) {
                            $p_id = $professor['p_id'];

                            $unavailabilityQuery = "SELECT * FROM unavailability WHERE p_id = '$p_id' AND date = '$date'";
                            $unavailable = $conn->query($unavailabilityQuery);

                            if ($unavailable && $unavailable->num_rows == 0) {
                                $deptQuery = "SELECT d_id FROM p_department WHERE p_id='$p_id'";
                                $deptResult = $conn->query($deptQuery);

                                if ($deptResult && $deptRow = $deptResult->fetch_assoc()) {
                                    $isScience = ($deptRow['d_id'] == 1);
                                } else {
                                    $isScience = false;
                                }

                                $professorDuties_ss[$p_id] = isset($professorDuties_ss[$p_id]) ? $professorDuties_ss[$p_id] + 1 : 1;

                                $maxDuties = $isScience ? ($totalDuties_ss - 2) : $totalDuties_ss;

                                if ($professorDuties_ss[$p_id] <= $maxDuties) {
                                    $insertSql = "INSERT INTO allotment (`p_id`,  `date`, `e_id`, `a_year`, `role`) VALUES ('$p_id','$date', $e, '$ay', '$role')";
                                    $conn->query($insertSql);

                                    $blocks--;
                                }
                            }
                        }
                    }
                } else {
                    echo "No data found";
                }

                if ($result) {
                    $resultt = $result->fetch_all(MYSQLI_ASSOC);

                    foreach ($resultt as $row) {
                        $date = $row['date'];
                        $blocks = $row['nob'];
                        $pr_id = $row['pr_id'];
                        $c_id = $row['c_id'];
                        $role = 'js';

                        $result1->data_seek(0);

                        while ($blocks > 0 && $professor = $result1->fetch_assoc()) {
                            $p_id = $professor['p_id'];

                            $unavailabilityQuery = "SELECT * FROM unavailability WHERE p_id = '$p_id' AND date = '$date'";
                            $unavailable = $conn->query($unavailabilityQuery);

                            if ($unavailable && $unavailable->num_rows == 0) {
                                $deptQuery = "SELECT d_id FROM p_department WHERE p_id='$p_id'";
                                $deptResult = $conn->query($deptQuery);

                                if ($deptResult && $deptRow = $deptResult->fetch_assoc()) {
                                    $isScience = ($deptRow['d_id'] == 1);
                                } else {
                                    $isScience = false;
                                }

                                $professorDuties[$p_id] = isset($professorDuties[$p_id]) ? $professorDuties[$p_id] + 1 : 1;

                                $maxDuties = $isScience ? ($totalDuties - 2) : $totalDuties;

                                if ($professorDuties[$p_id] <= $maxDuties) {
                                    $insertSql = "INSERT INTO allotment (`p_id`, `pr_id`, `c_id`, `date`, `e_id`, `a_year`, `role`) VALUES ('$p_id', '$pr_id', '$c_id', '$date', $e, '$ay', '$role')";
                                    $conn->query($insertSql);

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
            } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="width:100%; position: fixed; top: 0; left: 0;">
                        <strong>Warning!</strong> Please select a valid Exam type and Academic Year.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        }
        ?>
    </div>
</div>

</body>

</html>
