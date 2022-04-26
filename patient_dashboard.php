<?php
require_once 'classes/db.php';

require_once 'classes/patient.php';

require_once 'classes/patientrecord1.php';

session_start();

$uname = $_SESSION['uname'];

if($_SESSION['qualified'] == false){
    $status = "You can't create a record";
    $_SESSION['qualified']=true;
}
else{

    $status = $uname;

}

// $db = Db::getInstance();
$patient = Patient::getInstance($uname);
$patient_det =$patient->getDetails($uname);
$patient_no = $patient_det['patient_no'];

$patient_rec=new PatientRecord();

$result = $patient_rec->getRecordDetails($patient_no);
$patient_records = array_reverse($result);
$record_count=count($patient_records);
$_SESSION['count']=$record_count;


if (!empty($_POST['new-rec-btn'])){
  header("Location:create_record_form.php");
}
if (!empty($_POST['update-btn'])){
  header("Location:patientupdate1.php");
}

?>


<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="patientdashboard1.css">
    <!-- Fontawesome CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  
<div class = "logout-box" onclick="location.href='logout.php?varname=<?php echo $uname ?>'" style="cursor:pointer;" >
            Log out
          </div>

<form action="#" method = "post">

<h1 class="display-2">Patient Dashboard</h1>

<br>
<div class="buttons">
  <input type="submit" id="input-box1" name="new-rec-btn" value="Create New Record" style ="font-size:18px"  />
  <!-- <br><br> -->
  <input type="submit" id="input-box2" name="update-btn" value="Change Account Details" style ="font-size:18px"  />
  <!-- <br><br> -->
  </div>

  <br><br>
  <div class="container">


    <div class="forms">
        <div class="form-content">
          <div class="login-form"  >
            <div class="title">Records</div>
            <div class="input-boxes">
                
            </div>

            <?php 
            // var_dump($patient_records);
            $x=0;


            while($x<count($patient_records)){ 
              $record_no = $patient_records[$x]['patient_record_no'];
              $no = count($patient_records)-$x;
              $doctor_no =  $patient_records[$x]['assigned_doctor_no'];
              
              
              ?>
            
              
              <div class = "record-box" onclick="location.href='view_record.php?varname=<?php echo $record_no ?>&varname1=<?php echo $no ?>&varname2=<?php echo $doctor_no ?>';" style="cursor: pointer;" > 
              <h2> Record <?php echo count($patient_records)-$x ?></h2>
              <h3> <?php echo $patient_records[$x]['start_date'] ?> -> <?php echo $patient_records[$x]['end_date'] ?></h3>
              
              </div>
              <br> <br>
              <?php

              $x = $x+1;






            }

            
            
            ?> 

            <!-- <div class="input-boxes">
                <a href="patientupdate1.php"><div class="text sign-up-text">Update your account</div></a>
            </div> -->

       

        
      </div>

      
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
            </div>
            
            <!-- <br><br> -->
<!-- 
            <div >
              <input type="submit" id="input-box1" value="Create new record" onclick="redirecting()" style ="font-size:18px"  />

              
        <script>
          function redirecting() {
            location.replace("create_record_form.php")

          }
        </script>
            </div>
            <br> <br> -->

            <!-- <div >
              <input type="submit" id="input-box2" value="Change Account Details" onclick="redirecting2()" style ="font-size:18px"  />

              
        <script>
          function redirecting2() {
            location.replace("patientupdate1.php")

          }
        </script>
            </div> -->
            
          
          </form>
</body>
</html>
