<?php

session_start();

// $uname=$_SESSION['username'];
$uname='nishaa';
require_once  'classes/user.php';
require_once 'classes/doctor.php';
require_once 'classes/validate.php';

$error1="";
$error2="";
$error3="";
$email="";
$id="";
$phone="";
$name="";
$gender="";
$psw="";
$repsw="";

$doctor=new Doctor();

$validate_3=new Validate();
if($validate_3->checkUserExists('doctor',$uname)){
    if(!empty($_POST)){
        if(isset($_POST['name'])){
            $name=$_POST['name'];
        }

        if(isset($_POST['gender'])){
            $gender=$_POST['gender'];
        }
        if(isset($_POST['nic'])){
            $id=$_POST['nic'];
        }
        if(isset($_POST['mobileno'])){
            $phone=$_POST['mobileno'];
        }
        if(isset($_POST['email-id'])){
            $email=$_POST['email-id'];
        }

        if($doctor->create(array(
            'username'=> $uname,
            'doctor_name'=>$name,
            'doctor_gender'=>$gender,
            'doctor_id'=>$id,
            'doctor_email'=>$email,
            'doctor_phone'=>$phone,
        ))){
            header("Location:https://www.google.lk/");
        } 


    }
    
}
else{
    $result=$doctor->getDetails($uname);
    $uname=$result["username"];
    $email=$result["doctor_email"];
    $id=$result["doctor_id"];
    $phone=$result["doctor_phone"];
    $name=$result["doctor_name"];
    $gender=$result["doctor_gender"]; 

    if(!empty($_POST)){
        if(isset($_POST['name'])){
            $name=$_POST['name'];
        }

        if(isset($_POST['gender'])){
            $gender=$_POST['gender'];
        }
        if(isset($_POST['nic'])){
            $id=$_POST['nic'];
        }
        if(isset($_POST['mobileno'])){
            $phone=$_POST['mobileno'];
        }
        if(isset($_POST['email-id'])){
            $email=$_POST['email-id'];
        }

        if($doctor->update(array(
            'doctor_name'=>$name,
            'doctor_gender'=>$gender,
            'doctor_id'=>$id,
            'doctor_email'=>$email,
            'doctor_phone'=>$phone,
        ),$uname)){
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
  <link rel="stylesheet" href="doctorupdate.css" />
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
        <div class="title">Update your Account</div>
        <form  action="#" method="post">
          <div class="input-boxes">
            <div class="input-box">
              <label for="name"><b>Name</b></label>
              <input type="text" placeholder="Enter your name" name="name" <?php if($name!=""){?> value = <?php echo $name;} ?> /><br />
            </div>

            <label for="gender"><b>Gender</b></label> <br /><br />

            <input type="radio" id="male" name="gender" value="male" <?php if($gender=="male"){?>checked<?php } ?>/>
            <label for="male" style="color: black">Male</label>
 
            <input type="radio" id=" female" name="gender" value="female" <?php if($gender=="female"){?>checked<?php } ?>/>
            <label for="female" style="color: black">Female</label>
 
            <input type="radio" id="other" name="gender" value="other" <?php if($gender=="other"){?>checked<?php } ?>/>
            <label for="other" style="color: black">Other</label><br><br>

            <div class="input-box">
              <label for="nic"><b>ID number</b></label>
              <input type="text" placeholder="Enter your ID number" name="nic" <?php if($id!=""){?> value = <?php echo $id;} ?>/>
              <span id="nic" style="color:red"><?php echo $error1;?></span>

            </div>

            <div class="input-box">
              <label for="mobileno"><b>Mobile Number</b></label>
              <input type="text" placeholder="Enter your mobile number" name="mobileno"  <?php if($phone!=""){?> value = <?php echo $phone;} ?>/>
              <span id="mobileno" style="color:red"><?php echo $error2;?></span>

            </div>

            <div class="input-box">
              <label for="email-id"><b>Email Address</b></label>
              <input type="text" placeholder="Enter your Email Address" name="email-id" <?php if($email!=""){?> value = <?php echo $email;} ?> />
              <span id="emailadd" style="color:red"><?php echo $error3;?></span>
            </div>


            <div class="button input-box">
              <input type="submit"  value="Submit Changes" />
            </div>

            <!-- <div class="button input-box" >
              <input type="submit" onclick="redirecting()" value="Cancel Changes" />
            </div> -->



            <!-- <a href="login.php"><div class="text sign-up-text">
              Already have an account? Login now
            </div></a> -->
          </div>
        </form>

        <div class="button input-box">
        <input type="submit"  onclick="redirecting()" value="Cancel Changes" />
        
        </div>

        <script>
        function redirecting() {
            location.replace("login.php")

        }


        </script>
      </div>
      <!-- </div> -->
    </div>
  </div>
</body>

</html>