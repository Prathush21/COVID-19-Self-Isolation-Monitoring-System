<?php

session_start();

$uname=$_SESSION['username'];
require_once  'classes/user.php';
require_once 'classes/doctor.php';
require_once 'classes/validate.php';

$validate_4=new Validate();
$error1="";
$error2="";
$psw="";
$repsw="";

// $user=new User();
$doctor=Doctor::getInstance($uname);

if (!empty($_POST)) {
  if (isset($_POST['password'])) {
    $psw = $_POST['password'];
    $hashed = password_hash($psw,PASSWORD_DEFAULT);
  }
  if (isset($_POST['repassword'])) {
    $repsw = $_POST['repassword'];
  }
  if($validate_4->matchPassword($psw,$repsw)){
    $error1="passwords didn't match";
  }

  if($validate_4->passed() ){
    if($psw!="" and $repsw!=""){
      if ($doctor->updateUser(array(
        'password'=>$hashed,
      ), $uname)) {
        if($validate_4->checkUserExists('doctor', $uname)){
          header("Location:doctorupdate.php");
        }
        else{
          header("Location:doctordashboard.php");
        }
        
      }

    }
    else{
      $error2="Please enter a new password";
    }
    

  }
}

?>



<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
  <link rel="stylesheet" href="doctorpassword1.css" />
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>


<body>
  <div class="container">
    <input type="checkbox" id="flip" />

    <div class="forms">
      <!-- <div class="form-content"> -->
      <div  class="signup-form" >
        <div class="title">Change Password</div>
        <form  action="#" method="post">
          <div class="input-boxes">

            <div class="input-box">
              <label for="password"><b>Password</b></label>
              <input type="password" placeholder="Enter your password" id="password" name="password"  />
              <span id="psw" style="color:red"><?php echo $error2;?></span>
            </div>

            <div class="input-box">
              <label for="repassword"><b>Re-enter Password</b></label>
              <input type="password" placeholder="Re-enter your password" id="repassword" name="repassword"  />
              <span id="repsw" style="color:red"><?php echo $error1;?></span>

            </div>

            
            <div class="button input-box">
              <input type="submit"  value="Submit" />
            </div>

          </div>
        </form>
        <div class="button input-box">
          <input type="submit" onclick="redirecting()" value="Cancel Changes" />

        </div>

        <script>
          function redirecting() {
            location.replace("doctordashboard.php")

          }
        </script>
      </div>
      <!-- </div> -->
    </div>
  </div>
</body>

</html>
