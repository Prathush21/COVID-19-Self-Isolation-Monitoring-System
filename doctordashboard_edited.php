<?php

require_once 'doctor_dash.php';
require_once  'classes/iterator.php';
require_once  'classes/doctor.php';

$uname = $_SESSION['username'];

if($_SESSION['qualified'] == false){
    $status = "You can't have an account here";
}
else{
    $status = $uname;
}

$doctor = Doctor::getInstance($uname);
$patients = $doctor->getPatientList($uname);

if (!empty($_POST['change-password-btn'])){
  header("Location:doctorpassword.php");
}

if (!empty($_POST['update-btn'])){
  header("Location:doctorupdate.php");
}

if (!empty($_POST['view-prev-btn'])){
  header("Location:oldpatientsfordoctor.php?varname=$uname");
}

?>


<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->

    

    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="doctordashboard2_edited.css">
  </head>
<body>
  <div class="header">
<div class = "logout-box" onclick="location.href='logout.php?varname=<?php echo $uname ?>'" style="cursor:pointer;" >
            Log out
          </div>


<h1 class="display-3">Doctor Dashboard</h1>
</div>

<form action="#" method = "post">

<br>

<div class="buttons">
  <input type="submit" id="input-box1" name="change-password-btn" value="Change Password" style ="font-size:18px"  />
  <!-- <br><br> -->
  <input type="submit" id="input-box2" name="update-btn" value="Change Account Details" style ="font-size:18px"  />
  <!-- <br><br> -->
  <input type="submit" id="input-box3" name="view-prev-btn" value="View Former Patients" style ="font-size:18px"  />
  
  </div>

  <br><br><br>

  <div class="container">
    <input type="checkbox" id="flip">
  
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Active Patients</div>
            <br><br>
            <?php
              $it = new myIterator($patients);

              foreach($it as $patientno => [$patientname, $record_no, $patient_uname]) {
                  
                ?>
              
            
            <div class = "record-box" onclick="location.href='patientsymptomsfordoctor2.php?varname=<?php echo $record_no ?>&varname1=<?php echo $patient_uname ?>&varname2=<?php echo $patientno ?>'" style="cursor:pointer;" >
            <h1><?php echo $patientno . " - " . $patientname; ?></h1>
          </div>
          <br>
          <?php } ?>

      </div>
      
    </div>
    
    </div>
    
    </div>
    
  </div>

  </form>
  <!-- <div >
              <input type="submit" id="input-box" value="Log out" onclick="redirecting1()"  />

              
        <script>
          function redirecting1() {
            location.replace("login.php")

          }
        </script>
            </div> -->

            
            <!-- <br><br> -->

            <!-- <div >
              <input type="submit" id="input-box1" value="Change password" onclick="redirecting()" style ="font-size:18px"  />

              
        <script>
          function redirecting() {
            location.replace("doctorpassword.php")

          }
        </script>
            </div> -->
            <!-- <input type="submit" id="input-box1" name="change-password-btn" value="Change Password" style ="font-size:18px"  /> -->

            <!-- <br> <br> -->

            <!-- <div >
              <input type="submit" id="input-box2" value="Change Account Details" onclick="redirecting2()" style ="font-size:18px"  />

              
        <script>
          function redirecting2() {
            location.replace("doctorupdate.php")

          }
        </script>
            </div> -->
            <!-- <input type="submit" id="input-box1" name="update-btn" value="Change Account Details" style ="font-size:18px"  /> -->

            <!-- <br> -->

            <!-- <div class = "prev-box" onclick="location.href='oldpatientsfordoctor.php?varname=<?php echo $uname ?>'" style="cursor:pointer;" >
            View Previous Patients
        </div>  -->

            
</body>
</html>
