<?php
session_start();

// Check if the user is logged in
 if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // Redirect to login page if not logged in
     exit;
 }

 $username = $_SESSION['username']; // Retrieve username from session
// $username ="Nitin Singh";
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Navbar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  </head>
  <body>
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo">Examination Department</label>
      <ul>
        <li ><img id="profile" src="profile.png" alt="profile"></li>
        
        
        <h1><li>Hi, <?php echo htmlspecialchars($username); ?>!</li></h1>
        <li><a href="logout.php">Logout</a></li>
        <!-- <li><a href="#">Feedback</a></li> -->
      </ul>
    </nav>
    <section></section>
  </body>
</html>