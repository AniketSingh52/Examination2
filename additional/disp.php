<?php require '../connect.php';
    if (isset($_POST['exam'])) { ?>
        <div class="table-responsive">
            <table border='1' class='table table-hover mx-auto px-auto' id="table">
            <?php
            echo "
            <div class='formm1'>
            <div class='sizeform1'>
            <div class='table-responsive'>
    
    <table border='1' class='table table-hover mx-auto px-auto'>
    <thead class='thead-dark'>
    <thead class='thead-dark'>
            
            <th>Date</th>
            <th>Name</th>
            <th>Programme</th>
            <th>Course</th>
            <th>Role</th>
            <th>F_Time</th>
            <th>T_Time</th>
           
            </thead> 
            ";
        
            $e = $_POST["exam"];
            $ay = $_POST['ay'];
            $sql = "SELECT * FROM allotment  WHERE e_id='$e' and a_year='$ay' and role='js';";
            
            $result = mysqli_query($conn, $sql);
           
            $count = mysqli_num_rows($result);
         
            if ($result) {
                $resultt = $result->fetch_all(MYSQLI_ASSOC);
               
                foreach ($resultt as $row){
                   
                        $p_id = $row['p_id'];
                        $date=$row['date'];
                        $pr_id=$row['pr_id'];
                        $c_id=$row['c_id'];
                        $role=$row['role'];
                        $f_time=$row['f_time'];
                        $t_time=$row['t_time'];
                        $sql1="SELECT * FROM professor WHERE p_id='$p_id'";
                        $result1=mysqli_query($conn,$sql1);
                        $userdata=mysqli_fetch_array($result1);
                        
                        $sql2="SELECT * FROM programme WHERE pr_id='$pr_id'";
                        $result2=mysqli_query($conn,$sql2);
                        $userdata1=mysqli_fetch_array($result2);
                        
                        $sql3="SELECT * FROM course WHERE c_id='$c_id'";
                        $result3=mysqli_query($conn,$sql3);
                        $userdata2=mysqli_fetch_array($result3);
                        echo "
                        <tr>
                        <td>$date</td>
                        <td>{$userdata['name']}</td>
                        <td>{$userdata1['pr_name']}</td>
                        <td>{$userdata2['c_name']}</td>
                        <td>$role</td>
                        <td>$f_time</td>
                        <td>$t_time</td>
                        </tr>";
                        
                    }     
            } else {
                echo "No data found";
            }
             echo "
        </table>
        </div>
        </div>
        ";
        ?>
        
        <div class="table-responsive">
            <table border='1' class='table table-hover mx-auto px-auto' id="table">
            <?php
            echo "
            <div class='formm1'>
            <div class='sizeform1'>
            <div class='table-responsive'>
    
    <table border='1' class='table table-hover mx-auto px-auto'>
    <thead class='thead-dark'>
    <thead class='thead-dark'>
            <th>Date</th>
            <th>Name</th>
            <th>Role</th>
            </thead> 
            ";
        
            $e = $_POST["exam"];
            $ay = $_POST['ay'];
            $sql = "SELECT `p_id`,`date`,`role`,`f_time`,`t_time` FROM allotment  WHERE e_id='$e' and a_year='$ay' and role='ss';";
            
            $result = mysqli_query($conn, $sql);
           
            $count = mysqli_num_rows($result);
         
            if ($result) {
                $resultt = $result->fetch_all(MYSQLI_ASSOC);
               
                foreach ($resultt as $row){
                   
                        $p_id = $row['p_id'];
                        $date=$row['date'];
                        $role=$row['role'];
                        
                        $sql1="SELECT * FROM professor WHERE p_id='$p_id'";
                        $result1=mysqli_query($conn,$sql1);
                        $userdata=mysqli_fetch_array($result1);
                        
                    
                        echo "
                        <tr>
                        <td>$date</td>
                        <td>{$userdata['name']}</td>
                        
                        <td>$role</td>
                        
                        </tr>";
                        
                    }  
                    
            } else {
                echo "No data found";
            }
             echo "
        </table>
        
        
          
        </div>
       
        <button type='button' class='btn btn-outline-primary' onclick='tableToCSV()'>
            download CSV
        </button>
        </div>
        ";
        ?>