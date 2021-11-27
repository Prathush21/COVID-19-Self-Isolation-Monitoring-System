<?php

session_start();

$uname = $_SESSION['username'];

if($_SESSION['qualified'] == false){
    $status = "You can't have an account here";
}
else{
    $status = $uname;
}

?>


<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="doctordashboard.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <!--<img src="images/frontImg.jpg" alt="">-->
        <div class="text">
          <span class="text-1"><?php echo $status ?></span>
          <!-- <span class="text-2">Let's get connected</span> -->
        </div>
      </div>
      <div class="back">
        <!--<img class="backImg" src="images/backImg.jpg" alt="">-->
        <div class="text">
          <!-- <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span> -->
        </div>
      </div>
    </div>

    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Doctor Dashboard</div>
          <form action="#" method = "post">
            <div class="input-boxes">
                <a href="doctorpassword.php"><div class="text sign-up-text">Change Password</div></a>
                <a href="doctorupdate.php"><div class="text sign-up-text">Update Account Details</div></a>
            </div>
        </form>
      </div>

      </form>
    </div>
    </div>
    </div>
  </div>
</body>
</html>
