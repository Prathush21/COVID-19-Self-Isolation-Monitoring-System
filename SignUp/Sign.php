<?php 


require_once 'user.php';
require_once 'patient.php';
require_once 'validate.php';

$error1="";
$error2="";
$error3="";
$error4="";
$error5="";
$gender='no';
$asthma='no';
$lung='no';
$kidney='no';
$heart='no';
$diabetes='no';
$tension='no';
$cancer='no';
$immuno='no';

if(!empty($_POST)){
    $name=$_POST['name'];
    $uname=$_POST['uname'];
    $psw=$_POST['password'];
    $nic=$_POST['nic'];
    $repsw=$_POST['repassword'];
    $address=$_POST['address'];
    $mobileno=$_POST['mobileno'];
    $email=trim($_POST['email-id']);
    $dob=$_POST['dob'];
    if(isset($_POST['gender'])){
      $gender=$_POST['gender'];
    }
    
    if(isset($_POST['asthma'])){
      $asthma=$_POST['asthma'];
    }
    
    if(isset($_POST['lungdisease'])){
      $lung=$_POST['lungdisease'];
    }
    if(isset($_POST['kidney'])){
      $kidney=$_POST['kidney'];
    }
    if(isset($_POST['heart'])){
      $heart=$_POST['heart'];
    }
    if(isset($_POST['diabetes'])){
      $diabetes=$_POST['diabetes'];
    }
    if(isset($_POST['hyper'])){
      $tension=$_POST['hyper'];
    }
    if(isset($_POST['cancer'])){
      $cancer=$_POST['cancer'];
    }
    if(isset($_POST['immuno'])){
      $immuno=$_POST['immuno'];
    }
   
    $hashed = password_hash($psw,PASSWORD_DEFAULT);


$validate=new Validate();
if($validate->checkUser($uname)){
    $error1="User already exists";
}
if($validate->matchPassword($psw,$repsw)){
  $error2="Passwords didn't match";
}
if($validate->checkMobile($mobileno)){
  $error3="Invalid mobile number";
}
if($validate->checkEmail($email)){
  $error4="Invalid email address";
}
if($validate->checkNic($nic)){
  $error5="Invalid NIC number";
}




if ($validate->passed()){
    $user=new User();
    $patient = new Patient();
    if(
    $user->create(array(
        'username'=> $uname,
        'password'=> $hashed,
    )) and

    
    $patient->create (array(
    'patient_name'=>$name,
    'NIC'=>$nic,
    'address'=>$address,
    'phonenumber'=>$mobileno,
    'email_add'=>$email,
    'DOB'=>$dob,
    'gender'=>$gender,
    'asthma'=>$asthma,
    'lung_disease'=>$lung,
    'kidney_failure'=>$kidney,
    'heart_disease'=>$heart,
    'diabetes'=>$diabetes,
    'hyper_tension'=>$tension,
    'cancer'=>$cancer,
    'immuno_deficiency'=>$immuno,
    'username'=>$uname,
    ))
    ){
      header("Location:https://www.google.lk/");
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
  <link rel="stylesheet" href="signup.css" />
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<!-- <script>
  function errorMessage() {
   
  
    if (
      document.getElementById("password").value !=
      document.getElementById("repassword").value
    ) {
      document.getElementById("repsw").style.color = "red";
      document.getElementById("repsw").innerHTML =
        "Password did not match";
      return false;
    }
    else{
      return true;
    }
  };
</script> -->

<body>
  <div class="container">
    <input type="checkbox" id="flip" />

    <div class="forms">
      <!-- <div class="form-content"> -->
      <div  class="signup-form" >
        <div class="title">Signup</div>
        <form  action="#" method="post">
          <div class="input-boxes">
            <div class="input-box">
              <label for="name"><b>Name</b></label>
              <input type="text" placeholder="Enter your name" name="name" required /><br />
            </div>
            <div class="input-box">
              <label for="uname"><b>Username</b></label>
              <input type="text" placeholder="Enter a username" id="uname" name="uname" required />
              <span id="unm" style="color:red"><?php echo $error1;?></span>

            </div>
            <div class="input-box">
              <label for="password"><b>Password</b></label>
              <input type="password" placeholder="Enter your password" id="password" name="password" required />
              <span id="psw"></span>
            </div>

            <div class="input-box">
              <label for="repassword"><b>Re-enter Password</b></label>
              <input type="password" placeholder="Re-enter your password" id="repassword" name="repassword" required />
              <span id="repsw" style="color:red"><?php echo $error2;?></span>

            </div>

            <div class="input-box">
              <label for="nic"><b>NIC number</b></label>
              <input type="text" placeholder="Enter your NIC number" name="nic" required />
              <span id="nic" style="color:red"><?php echo $error5;?></span>

            </div>

            <div class="input-box">
              <label for="address"><b>Residential Address</b></label>
              <input type="text" placeholder="Enter your Residential Address" name="address" required />
            </div>

            <div class="input-box">
              <label for="mobileno"><b>Mobile Number</b></label>
              <input type="text" placeholder="Enter your mobile number" name="mobileno" required />
              <span id="mobileno" style="color:red"><?php echo $error3;?></span>

            </div>

            <div class="input-box">
              <label for="email-id"><b>Email Address</b></label>
              <input type="text" placeholder="Enter your Email Address" name="email-id" required />
              <span id="emailadd" style="color:red"><?php echo $error4;?></span>
            </div>

            <div class="input-box">
              <label for="dob"><b>Date of Birth</b></label>
              <input type="date" placeholder="Enter your Date of Birth" name="dob" required />
            </div>
            <!-- <div class="input-box"> -->
            <!-- <div class = "selection"> -->
            <label for="gender"><b>Gender</b></label> <br /><br />

            <input type="radio" id="male" name="gender" value="male" />
              <label for="male" style="color: black">Male</label>
             
            <input type="radio" id=" female" name="gender" value="female" />
              <label for="female" style="color: black">Female</label>
             
            <input type="radio" id="other" name="gender" value="other" />
              <label for="other" style="color: black">Other</label><br><br>
            <!-- </div> -->
            <!-- </div> -->
            <label for="disease"><b>Chronic Disease</b></label> <br /><br />
            <input type="Checkbox" name="asthma" value="yes" />Asthma <br> <br>
            <input type="Checkbox" name="lungdisease" value="yes" />Chronic lung disease<br> <br>
            <input type="Checkbox" name="kidney" value="yes" />Kidney failure <br> <br>
            <input type="Checkbox" name="heart" value="yes" />Heart Disease <br> <br>
            <input type="Checkbox" name="diabetes" value="yes" />Diabetes <br> <br>
            <input type="Checkbox" name="hyper" value="yes" />Hyper Tension <br> <br>
            <input type="Checkbox" name="cancer" value="yes" />Cancer <br> <br>
            <input type="Checkbox" name="immuno" value="yes" />Immunodeficiency Diseases <br>

            <div class="button input-box">
              <input type="submit"  value="Submit" />
            </div>
            

            <!-- <script>
              function errorMessage() {
                if (
                    document.getElementById("password").value ==
                    document.getElementById("repassword").value
                  ) {
                    document.getElementById("repassword").style.color = "green";
                    document.getElementById("repassword").innerHTML =
                      "Passwords matched";
                  } else {
                    document.getElementById("repassword").style.color = "red";
                    document.getElementById("repassword").innerHTML =
                      "Password did not match";
                  }

              }
            </script> -->
            <div class="text sign-up-text">
              Already have an account? <label for="flip">Login now</label>
            </div>
          </div>
        </form>
      </div>
      <!-- </div> -->
    </div>
  </div>
</body>

</html>