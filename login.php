<?php

require_once 'classes/validate.php';
require_once 'classes/user.php';

session_start();

$validate = new Validate();
$error1 = "";
$error2 = "";
$uname = null;
$psw = null;

if(!empty($_POST)){
    $uname=$_POST['uname'];
    $psw=$_POST['password'];


if (($validate->checkUserExists($uname))){
    $error1 = "No such user exists";
    
    //  echo $error1;
}else{
  // if($validate->checkPassword('user',$uname,$psw)){
    $user = new User();
    if($user->login('user',$uname,$psw)){
      $_SESSION['uname'] = $uname;
      $_SESSION['qualified'] = true;
      header("Location:patient_dashboard.php");
  }
  else{
    $error2="wrong password";
  }

}
// $validate->checkPassword('user',$uname,$psw);


// if (($validate->passed())){
//     $user = new User();
//     if ($user->login($uname, $psw)){
//         //start login session
       
//     }
// }
}

?>


<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="login.css">
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
          <span class="text-1">Every new friend is a <br> new adventure</span>
          <span class="text-2">Let's get connected</span>
        </div>
      </div>
      <div class="back">
        <!--<img class="backImg" src="images/backImg.jpg" alt="">-->
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>

    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
          <form action="#" method = "post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your username" name="uname" required>
                
              </div>
              <span id="unm" style="color:red"><?php echo $error1;?></span>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name="password" required>

              </div>
              <span id="unm" style="color:red"><?php echo $error2;?></span>
              
              <div class="text"><a href="#">Forgot password?</a></div>
              <div class="button input-box">
                <input type="submit" value="Login">
              </div>
              <a href="Sign.php"><div class="text sign-up-text">Don't have an account? Sigup now</div></a>
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
