<?php

session_start();

$uname=$_SESSION['username'];
// $uname = 'nishaa';
require_once  'classes/user.php';
require_once 'classes/patient.php';
require_once 'classes/validate.php';

$error1 = "";
$error2 = "";
$error3 = "";
$error4 = "";
$error5 = "";

$patient = new Patient();
$validate_3 = new Validate();

$result = $patient->getDetails($uname);

$email = $result["email_add"];
$id = $result["NIC"];
$phone = $result["phonenumber"];
$name = $result["patient_name"];
$gender = $result["gender"];
$address = $result["address"];
$asthma = $result['asthma'];
$lung = $result['lung_disease'];
$kidney = $result['kidney_failure'];
$heart = $result['heart_disease'];
$diabetes = $result['diabetes'];
$tension = $result['hyper_tension'];
$cancer = $result['cancer'];
$immuno = $result['immuno_deficiency'];
$dob = $result['DOB'];

if (!empty($_POST)) {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        if($validate_3->checkIfEmpty($name)){
          $error4="Looks like you didn't enter your name!";
        }
    }

    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    }
    if (isset($_POST['nic'])) {
        $id = $_POST['nic'];
        if($validate_3->checkNic($id)){
          $error1="Invalid NIC number";
        }
    }
    if (isset($_POST['mobileno'])) {
        $phone = $_POST['mobileno'];
        if($validate_3->checkMobile($phone)){
            $error2="Invalid mobile number";
        }
    }
    if(isset($_POST['email-id'])){
        $email=trim($_POST['email-id']);
        if($validate_3->checkEmail($email)){
          $error3="Invalid email address";
        }
    }
    if (isset($_POST['address'])) {
        $address = $_POST['address'];
        if($validate_3->checkIfEmpty($address)){
          $error5="Looks like you didn't enter your address!";
        }
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
    
    if($validate_3->passed()){
      if ($patient->update(array(
        'patient_name' => $name,
        'gender' => $gender,
        'NIC' => $id,
        'email_add' => $email,
        'phonenumber' => $phone,
        'address' => $address,
        'asthma' => $asthma,
        'lung_disease'=>$lung,
        'kidney_failure'=>$kidney,
        'heart_disease'=>$heart,
        'diabetes'=>$diabetes,
        'hyper_tension'=>$tension,
        'cancer'=>$cancer,
        'immuno_deficiency'=>$immuno,
        'username'=>$uname,
      ), $uname)) {
        header("Location:patient_dashboard.php");
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
  <link rel="stylesheet" href="doctorupdate1.css" />
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
      <div class="signup-form">
        <div class="title">Update your Account</div>
        <form action="#" method="post">
          <div class="input-boxes">
            <div class="input-box">
              <label for="name"><b>Name</b></label>
              <input type="text" placeholder="Enter your name" name="name" <?php if ($name != "") { ?> value=<?php echo "'$name'";
                                                                                                      } ?> /><br />
               <span id="name" style="color:red"><?php echo $error4; ?></span>                                                                                       
            </div>

            <label for="gender"><b>Gender</b></label> <br /><br />

            <input type="radio" id="male" name="gender" value="male" <?php if ($gender == "male") { ?>checked<?php } ?> />
              <label for="male" style="color: black">Male</label>
             
            <input type="radio" id=" female" name="gender" value="female" <?php if ($gender == "female") { ?>checked<?php } ?> />
              <label for="female" style="color: black">Female</label>
             
            <input type="radio" id="other" name="gender" value="other" <?php if ($gender == "other") { ?>checked<?php } ?> />
              <label for="other" style="color: black">Other</label><br><br>

            <div class="input-box">
              <label for="nic"><b>NIC number</b></label>
              <input type="text" placeholder="Enter your NIC number" name="nic" <?php if ($id != "") { ?> value=<?php echo $id;
                                                                                                        } ?> />
              <span id="nic" style="color:red"><?php echo $error1; ?></span>

            </div>

            <div class="input-box">
              <label for="mobileno"><b>Mobile Number</b></label>
              <input type="text" placeholder="Enter your mobile number" name="mobileno" <?php if ($phone != "") { ?> value=<?php echo $phone;
                                                                                                                    } ?> />
              <span id="mobileno" style="color:red"><?php echo $error2; ?></span>

            </div>

            <div class="input-box">
              <label for="email-id"><b>Email Address</b></label>
              <input type="text" placeholder="Enter your Email Address" name="email-id" <?php if ($email != "") { ?> value=<?php echo $email;
                                                                                                                    } ?> />
              <span id="emailadd" style="color:red"><?php echo $error3; ?></span>
            </div>


            <div class="input-box">
              <label for="address"><b>Residential Address</b></label>
              <input type="text" placeholder="Enter your Residential address" name="address" <?php if ($address != "") { ?> value=<?php echo "'$address'";
                                                                                                      } ?> /><br />
              <span id="address" style="color:red"><?php echo $error5; ?></span>
            </div>

            <label for="disease"><b>Chronic Disease</b></label> <br /><br />
            <input type="Checkbox" name="asthma" value = "yes" <?php if ($asthma == "yes") { ?>checked disabled <?php } ?> />Asthma <br> <br>
            <input type="Checkbox" name="lungdisease" value = "yes" <?php if ($lung == "yes") { ?>checked disabled <?php } ?> />Chronic lung disease<br> <br>
            <input type="Checkbox" name="kidney" value = "yes" <?php if ($kidney == "yes") { ?>checked disabled <?php } ?> />Kidney failure <br> <br>
            <input type="Checkbox" name="heart" value = "yes" <?php if ($heart == "yes") { ?>checked disabled <?php } ?> />Heart Disease <br> <br>
            <input type="Checkbox" name="diabetes" value = "yes" <?php if ($diabetes == "yes") { ?>checked disabled <?php } ?> />Diabetes <br> <br>
            <input type="Checkbox" name="hyper" value = "yes" <?php if ($tension == "yes") { ?>checked disabled <?php } ?> />Hyper Tension <br> <br>
            <input type="Checkbox" name="cancer" value = "yes" <?php if ($cancer == "yes") { ?>checked disabled <?php } ?> />Cancer <br> <br>
            <input type="Checkbox" name="immuno" value = "yes" <?php if ($immuno == "yes") { ?>checked disabled <?php } ?> />Immunodeficiency Diseases <br>


            <div class="button input-box">
              <input type="submit" value="Submit Changes" />
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
          <input type="submit" onclick="redirecting()" value="Cancel Changes" />

        </div>

        <script>
          function redirecting() {
            location.replace("patient_dashboard.php")

          }
        </script>

      </div>
      <!-- </div> -->
    </div>
  </div>
</body>

</html>