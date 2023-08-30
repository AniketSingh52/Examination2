<?php
    require "../connect.php";
    if (isset($_POST['admin'])) {
      $admin = $_POST['admin'];
      echo $admin;
      $type = $_POST['type'];
      $s = "UPDATE login set type='$type',status='$admin' WHERE username='$username'";
      $qu = $conn->query($s);
      //echo mysqli_num_rows($qu) . "row selected";
      echo $username;
    }
    ?>