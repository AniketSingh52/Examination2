<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Allotment</title>
    <link rel="shortcut icon" href="../fevicon.png">
    <link rel="stylesheet" href="update_prof.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<?php
    include( "../navbar1.php");
?>


<style>
    .fullbody{
  height:calc(100vh - 60px);
  overflow:scroll;
}


::-webkit-scrollbar-thumb{
  background-color: rgba(44, 62, 80, 1);;
}
::-webkit-scrollbar{
  width:2px;
}
</style>
</head>

<body style="margin-top:70px !important">
<div class="fullbody">
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
                        <option value="1">Internal Sem(1/3/5)</option>
                        <option value="2">Internal Sem(2/4/6)</option>
                        <option value="3">Sem(1/3/5)</option>
                        <option value="4">Sem(2/4/6)</option>
                        <option value="5">ATKT Sem(1/3/5)</option>
                        <option value="6">ATKT Sem(2/4/6)</option>
                    </select>
                </div>

                <div class="div">
                    <hr class="mx-n3">
                </div>

                <div style="padding: 20px;" class="container">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary" type="submit">Allocate</button>
                        <!--<button class="btn btn-outline-primary" name="reallocate" type="submit" value="reallocate" onclick="reallocate()" >Reallocate</button>-->
                    </div>
                </div>
            </form>

            <?php
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            require '../connect.php';



            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['exam']) && isset($_POST['ay'])) {
                    $e = $_POST["exam"];
                    $ay = $_POST['ay'];

                    //to check whether allotment of this particular exam is done or not..
                    $check = "SELECT * FROM allotment where a_year='$ay' and e_id='$e'";
                    //calculate total number of sessions..
                    $session_query = "SELECT COUNT(DISTINCT CONCAT(date, ' ', f_time)) AS session_count FROM timetable where academic_year=$ay and e_id=$e";
                    $sessions = $conn->query($session_query);
                    $sess = $sessions->fetch_assoc();
                    $session_count = $sess['session_count'];


                    $check_result = $conn->query($check);
                    // $row_check = $check_result->fetch_assoc();
                    $count_check = mysqli_num_rows($check_result);
                    if ($count_check < 1) {

                        //calculate the no of unavailable professor whose department is science(d_id==1) and profesor is not hod  
                        $unavailable="SELECT COUNT(*) AS num_unavailable_professors
          FROM unavailability u
          JOIN p_department pd ON u.p_id = pd.p_id
          JOIN professor p ON pd.p_id = p.p_id
          WHERE pd.d_id IN (14,15) 
            AND u.a_year = '$ay' AND u.e_id=$e
            AND p.designation <> 'HOD'";
                        $n_unavailability=$conn->query($unavailable);
                        if ($n_unavailability) {
    $row = $n_unavailability->fetch_assoc();
    $n_unavailable_science = $row['num_unavailable_professors'];
    echo "Number of unavailable professors in department 1 (excluding HOD) for year $ay: " . $n_unavailable_science;
} else {
    echo "Error: " . $conn->error;
}
//number of total unavailableprofessor who is not HOD for js allotment
                        $unavailable_js="SELECT COUNT(*) AS num_unavailable_professors
          FROM unavailability u
          JOIN professor p ON u.p_id = p.p_id
          WHERE  u.a_year = '$ay' AND u.e_id=$e
            AND p.designation <> 'HOD'";
                        $n_unavailability_js=$conn->query($unavailable_js);
                        if ($n_unavailability_js) {
    $row_js = $n_unavailability_js->fetch_assoc();
    $n_unavailable = $row_js['num_unavailable_professors'];
    echo "Number of unavailable professors  (excluding HOD) for year $ay: " . $n_unavailable;
} else {
    echo "Error: " . $conn->error;
}
       
       //total number of science professor for js allotment 
       $sql1_science = "SELECT COUNT(*) as total FROM professor p
         JOIN p_department pd ON p.p_id = pd.p_id
         WHERE p.unfair_means = 'N' 
           AND p.designation != 'HOD' 
           AND p.ecm = 'N'
           AND pd.d_id IN (14,15)";
         $result_science=$conn->query($sql1_science);
         if ($result_science) {
    $row_science = $result_science->fetch_assoc();
    $n_science = $row_science['total'];
    echo "Number of science professors  (excluding HOD) for year $ay: " . $n_science;
} else {
    echo "Error: " . $conn->error;
}

                     $final=$n_unavailable+($n_science*2)-$n_unavailable_science;   
                        
                        //fetch the professor details for js allotment in ascending orderof their experience
                        $sql1 = "SELECT *, (TIMESTAMPDIFF(MONTH, c_date, NOW())+experience) AS total_experience_in_months 
         FROM professor 
         WHERE unfair_means = 'N' 
         AND designation != 'HOD' AND ecm='N'
         ORDER BY total_experience_in_months ASC";


                        $result1 = $conn->query($sql1);
                        
                        
                        
                        
                        //calculate the no of unavailable professor whose department is science(d_id==1) and profesor is hod  
                        $unavailable_ss="SELECT COUNT(*) AS num_unavailable_professors
          FROM unavailability u
          JOIN p_department pd ON u.p_id = pd.p_id
          JOIN professor p ON pd.p_id = p.p_id
          WHERE pd.d_id IN (14,15) 
            AND u.a_year = '$ay' AND u.e_id=$e
            AND p.designation = 'HOD'";
                        $n_unavailability_ss=$conn->query($unavailable_ss);
                        if ($n_unavailability_ss) {
    $row_ss = $n_unavailability_ss->fetch_assoc();
    $n_unavailable_science_ss = $row['num_unavailable_professors'];
    echo "Number of unavailable professors in department 1 (HOD) for year $ay: " . $n_unavailable_science_ss;
} else {
    echo "Error: " . $conn->error;
}
//number of total unavailableprofessor who is  HOD for ss allotment
                        $unavailable_ss="SELECT COUNT(*) AS num_unavailable_professors
          FROM unavailability u
          JOIN professor p ON u.p_id = p.p_id
          WHERE  u.a_year = '$ay' AND u.e_id=$e
            AND p.designation = 'HOD'";
                        $n_unavailability_ss=$conn->query($unavailable_ss);
                        if ($n_unavailability_ss) {
    $row_ss = $n_unavailability_ss->fetch_assoc();
    $n_unavailable_ss = $row_ss['num_unavailable_professors'];
    echo "Number of unavailable professors  (HOD) for year $ay: " . $n_unavailable_ss;
} else {
    echo "Error: " . $conn->error;
}
       
       //total number of science professor for ss allotment 
       $sql1_science_ss = "SELECT COUNT(*) as total FROM professor p
         JOIN p_department pd ON p.p_id = pd.p_id
         WHERE p.unfair_means = 'N' 
           AND p.designation = 'HOD' 
           AND p.ecm = 'N'
           AND pd.d_id IN (14,15)";
         $result_science_ss=$conn->query($sql1_science_ss);
         if ($result_science_ss) {
    $row_science_ss = $result_science_ss->fetch_assoc();
    $n_science_ss = $row_science_ss['total'];
    echo "Number of science professors (HOD) for year $ay: " . $n_science_ss;
} else {
    echo "Error: " . $conn->error;
}

                     $final_ss=$n_unavailable_ss+($n_science_ss*2)-$n_unavailable_science_ss;   
                        
                        
                        

                        //fetch the professor details for ss allotment in ascending orderof their experience
                        $sql12 = "SELECT *, (TIMESTAMPDIFF(MONTH, c_date, NOW())+experience) AS total_experience_in_months 
         FROM professor 
         WHERE unfair_means = 'N' 
         AND designation = 'HOD' AND ecm='N'
         ORDER BY total_experience_in_months ASC";

                        $result12 = $conn->query($sql12);
                        //to calculate the total number of sessions in any exam..
                        $sql = "SELECT SUM(nob) as nob FROM timetable WHERE e_id='$e' AND academic_year='$ay';";
                        $result = mysqli_query($conn, $sql);
                        $row = $result->fetch_assoc();
                        $total_nob = $row["nob"];
                        echo "Total blocks :" . $total_nob;

                        $totalProfessors = mysqli_num_rows($result1);
                        $totalProfessors_ss = mysqli_num_rows($result12);
                        echo "Total Professors :" . $totalProfessors;
                        $totalProfessors=$totalProfessors-ceil($final/$totalProfessors);
                        echo "Total Professors after removing unavailability :" . $totalProfessors;
                        $totalDuties = ceil(($total_nob + $session_count) / $totalProfessors);
                        echo "Total Duties per professor :" . $totalDuties;
                        


                        $sql = "SELECT `date`, `f_time`, SUM(nob) AS nob,f_time,t_time FROM timetable WHERE e_id='$e' AND academic_year='$ay' GROUP BY `date`, `f_time`;";

                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);


                        $sql_ss = "SELECT `date`, `nob`, `pr_id`, `c_id`, `f_time`, `t_time` FROM timetable WHERE e_id='$e' and academic_year='$ay' group by date, nob, pr_id, c_id, f_time, t_time;";
                        $result_ss = mysqli_query($conn, $sql_ss);
                        $result_s = mysqli_query($conn, $sql_ss);
                        $count_ss = mysqli_num_rows($result_ss);


                        $professorDuties = [];
                        $professorDuties_ss = [];
                        
                        
                         if ($result_s) {
                            $resultt_s = $result_s->fetch_all(MYSQLI_ASSOC);
                            $total_ss=0;
                            foreach ($resultt_s as $row_s) {
                                $blocks_s = ceil($row_s['nob'] / 10);
                                $total_ss=$total_ss+$blocks_s;
                                
                            }
                             
                         }
                         $totalProfessors_ss=$totalProfessors_ss-(ceil($final_ss/10));
                        $totalDuties_ss = ceil($total_ss / $totalProfessors_ss);
                        echo "Total Duties for ss :" . $totalDuties_ss;



                        if ($result_ss) {
                            $resultt_ss = $result_ss->fetch_all(MYSQLI_ASSOC);

                            foreach ($resultt_ss as $row_ss) {
                                $date = $row_ss['date'];
                                $f_time = isset($row_ss['f_time']) ? $row_ss['f_time'] : null;
                                $t_time = isset($row_ss['t_time']) ? $row_ss['t_time'] : null;
                                $blocks_ss = ceil($row_ss['nob'] / 10);
                                $role = 'ss';

                                // Allocate duties to professors one by one
                                // $result12->data_seek(0);




                                while ($blocks_ss > 0) {
                                    if ($professor = $result12->fetch_assoc()) {
                                        $p_id = $professor['p_id'];
                                        echo "<br>Professor name ss: " . $professor['name'];
                                        echo "<br>Professor ID: " . $p_id . ", Experience: " . $professor['total_experience_in_months'] . " months<br>";

                                        $unavailabilityQuery = "SELECT * FROM unavailability WHERE p_id = '$p_id' AND date = '$date'";
                                        $unavailable = $conn->query($unavailabilityQuery);
                                        if ($unavailable && $unavailable->num_rows == 0) {

                                            $deptQuery = "SELECT d_id FROM p_department WHERE p_id='$p_id'";
                                            $deptResult = $conn->query($deptQuery);

                                            if ($deptResult && $deptRow = $deptResult->fetch_assoc()) {
                                                $isScience = ($deptRow['d_id'] == 14 || $deptRow['d_id'] == 15);
                                            } else {
                                                $isScience = false;
                                            }

                                            $maxDuties = $isScience ? ($totalDuties_ss - 2) : $totalDuties_ss;
                                            if (!isset($professorDuties_ss[$p_id])) {
                                                $professorDuties_ss[$p_id] = 0;
                                            }



                                            if ($professorDuties_ss[$p_id] < $maxDuties) {
                                                $insertSql = "INSERT INTO allotment (`p_id`, `date`, `e_id`, `a_year`, `role`, `f_time`, `t_time`) VALUES ('$p_id', '$date', $e, '$ay', '$role', '$f_time', '$t_time')";

                                                if ($conn->query($insertSql) === TRUE) {
                                                    $professorDuties_ss[$p_id]++;
                                                    $blocks_ss--;
                                                } else {
                                                    echo "Error: " . $insertSql . "<br>" . $conn->error;
                                                }
                                            }
                                        }
                                    } else {
                                        $result12->data_seek(0);
                                    }
                                }
                            }
                        } else {
                            echo "No data found";
                        }

                        //code for 'js' allocation...

                        if ($result) {
                            $resultRows = $result->fetch_all(MYSQLI_ASSOC);

                            foreach ($resultRows as $row) {
                                $date = $row['date'];
                                $f_time = $row['f_time'];
                                $t_time = $row['t_time'];
                                $blocks = $row['nob'] + 1;
                                $pr_id = NULL;
                                $c_id = NULL;
                                $role = 'js';


                                while ($blocks > 0) {
                                    if ($professor = $result1->fetch_assoc()) {
                                        $p_id = $professor['p_id'];
                                        echo "<br>Professor name js: " . $professor['name'];
                                        echo "<br>Professor ID: " . $p_id . ", Experience: " . $professor['total_experience_in_months'] . " months<br>";

                                        $unavailabilityQuery = "SELECT * FROM unavailability WHERE p_id = '$p_id' AND date = '$date'";
                                        $unavailable = $conn->query($unavailabilityQuery);
                                        if ($unavailable && $unavailable->num_rows == 0) {

                                            $deptQuery = "SELECT d_id FROM p_department WHERE p_id='$p_id'";
                                            $deptResult = $conn->query($deptQuery);

                                            if ($deptResult && $deptRow = $deptResult->fetch_assoc()) {
                                                $isScience = ($deptRow['d_id'] == 14 || $deptRow['d_id'] == 15);
                                            } else {
                                                $isScience = false;
                                            }

                                            $maxDuties = $isScience ? ($totalDuties - 2) : $totalDuties;
                                            if (!isset($professorDuties[$p_id])) {
                                                $professorDuties[$p_id] = 0;
                                            }

                                            if ($professorDuties[$p_id] < $maxDuties) {
                                                $insertSql = "INSERT INTO allotment (`p_id`, `date`, `e_id`, `a_year`, `role`, `f_time`, `t_time`) VALUES ('$p_id', '$date', $e, '$ay', '$role', '$f_time', '$t_time')";

                                                if ($conn->query($insertSql) === TRUE) {
                                                    $professorDuties[$p_id]++;
                                                    $blocks--;
                                                    $flag=0;
                                                } else {
                                                    echo "Error: " . $insertSql . "<br>" . $conn->error;
                                                }
                                            }else{
                                                    $flag++;
                                                    if($flag>$totalProfessors){
                                                        $totalDuties++;
                                                        $result1->data_seek(0);
                                                        
                                                    }
                                               
                                            }
                                        }
                                    } else {
                                        $result1->data_seek(0);
                                    }
                                }
                                echo "fully allocated" . $date . " " . $f_time;
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
                        <strong>Warning!</strong>Supervision chart is already alloted.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
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
</div>
</body>

</html>