<?php

session_start();

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
  
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Doctor Dashboard</div>
          <form action="#" method = "post">
            <br><br>
            <?php
              $it = new myIterator($patients);

              foreach($it as $patientno => [$patientname, $record_no, $patient_uname]) {
                  
                ?>
              
            
            <div class = "record-box" onclick="location.href='patientsymptomsfordoctor2.php?varname=<?php echo $record_no ?>&varname1=<?php echo $patient_uname ?>&varname2=<?php echo $patientno ?>'" style="cursor:pointer;" >
            <h1><?php echo $patientno . " " . $patientname; ?></h1>
          </div>
          <br>
          <?php } ?>
            <div class="input-boxes">
                <!-- <a href="doctorpassword.php"><div class="text sign-up-text">Change Password</div></a>
                <a href="doctorupdate.php"><div class="text sign-up-text">Update Account Details</div></a> -->
            </div>
        </form>
      </div>

      </form>
    </div>
    </div>
    </div>
  </div>

  <!-- <div >
              <input type="submit" id="input-box" value="Log out" onclick="redirecting1()"  />

              
        <script>
          function redirecting1() {
            location.replace("login.php")

          }
        </script>
            </div> -->

            
            <br><br>

            <div >
              <input type="submit" id="input-box1" value="Change password" onclick="redirecting()" style ="font-size:18px"  />

              
        <script>
          function redirecting() {
            location.replace("doctorpassword.php")

          }
        </script>
            </div>
            <br> <br>

            <div >
              <input type="submit" id="input-box2" value="Change Account Details" onclick="redirecting2()" style ="font-size:18px"  />

              
        <script>
          function redirecting2() {
            location.replace("doctorupdate.php")

          }
        </script>
            </div>

            <br>

            <div class = "prev-box" onclick="location.href='oldpatientsfordoctor.php?varname=<?php echo $uname ?>'" style="cursor:pointer;" >
            View Previous Patients
        </div> 

            <div class = "logout-box" onclick="location.href='logout.php?varname=<?php echo $uname ?>'" style="cursor:pointer;" >
            Log out
          </div>

</body>
</html>
