<?php
require_once 'classes/db.php';

session_start();

$uname = $_SESSION['username'];

if($_SESSION['qualified'] == false){
    $status = "You can't create a record";
    $_SESSION['qualified']=true;
}
else{

    $status = $uname;

}

$db = Db::getInstance();
$patient_det =$db->getCommon('patient','username',$uname);
$patient_no = $patient_det['patient_no'];
$result = $db->getAll('patient_record','patient_no',$patient_no);
$patient_records = array_reverse($result);

?>


<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="patient_dashboard2.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <!-- <div class="cover"> -->
      <!-- <div class="front"> -->
        <!--<img src="images/frontImg.jpg" alt="">-->
        <!-- <div class="text">
          <span class="text-1"></span> -->
          <!-- <span class="text-2">Let's get connected</span> -->
        <!-- </div> -->
      <!-- </div> -->
      <!-- <div class="back"> -->
        <!--<img class="backImg" src="images/backImg.jpg" alt="">-->
        <!-- <div class="text"> -->
          <!-- <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span> -->
        <!-- </div>
      </div>
    </div> -->

    <div class="forms">
        <div class="form-content">
          <div class="login-form"  >
            <div class="title">Patient Records</div>
          <form action="#" method = "post">
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

        </form>

        
      </div>

      </form>
    </div>
    </div>
    </div>
  </div>
  <a href="create_record_form.php"><div class="text sign-up-text">Create a new Record now!</div></a>
</body>
</html>
