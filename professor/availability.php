<?php
// Include the database connection file
include('../connect.php');
?>

<html>

<head>
    <title>Profesor Availability</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<script type="text/javascript">
    $(document).ready(function() {
        // Department dependent ajax
        $("#department").on("change", function() {
            var departId = $(this).val();
            $.ajax({
                url: "action.php",
                type: "POST",
                cache: false,
                data: {
                    depId: departId
                },
                success: function(data) {
                    $("#programee").html(data);
                }
            });
        });

    });

    $(document).ready(function() {
        // Department dependent ajax
        $("#programee").on("change", function() {
            var progId = $(this).val();
            $.ajax({
                url: "action.php",
                type: "POST",
                cache: false,
                data: {
                    pr_id: progId
                },
                success: function(data) {
                    $("#professor").html(data);
                }
            });
        });

    });
</script>

<body>
    <div class="container">
        <h3>Unavailable professor</h3>
        <br />
        <form action="availability.php" method="post">
            <div class="col-auto">

                <!-- Department dropdown -->
                <label for="department">Department</label>
                <select class="form-control" id="department" name="department1">
                    <option value="">Select Department</option>
                    <?php
                    $query = "SELECT * FROM department";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['d_id'] . '">' . $row['name'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Country not available</option>';
                    }
                    ?>
                </select>
                <br />

                <!-- Programme dropdown -->
                <label for="programee">Programee</label>
                <select class="form-control" id="programee" name="programee1">
                    <option value="">Select Programee</option>
                </select>
                <br />
                <!-- Professor dropdown -->
                <label for="professor">Professor</label>
                <select class="form-control" id="professor" name="professor1">
                    <option value="">Select Professor</option>
                </select>
                <br />
                <input type="submit" value="Submit" name="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['professor1'])) {
        $p_id = $_POST['professor1'];
        $sql = "SELECT * FROM professor where p_id=$p_id";
        $result = $conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $name = $row['name'];
            }
    ?><div class="container">
                <form method="POST" action="reson.php" >
                    <fieldset disabled>
                    
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Name : </label>
                            <input type="text" name="p_name" id="disabledTextInput" class="form-control" value="<?php echo $name ?>" >
                        </div>
                        <hr class="mx-n3">
                    </fieldset>
                    <div class="mb-3" style="display:none;">
                            <label  class="form-label">Professor ID: </label>
                            <input type="text" id="p_id" name="p_id" class="form-control" value="<?php echo $p_id ?>" >
                        </div>
                       
                    
                    <div class="mb-3">
                        <label class="form-label">Reason: </label>
                        <input type="text" id="reason" class="form-control" name="p_reson">
                    </div>

                    <hr class="mx-n3">
                    
                    <div class="mb-3">
                        <label class="form-label">Date: </label>
                        <input type="date" id="date" class="form-control" name="p_date">
                    </div>

                    <button type="submit" class="btn btn-lg btn-block btn-primary ">Submit</button>

                </form>
            </div>


    <?php
        }
    }
   
    ?>
</body>

</html>