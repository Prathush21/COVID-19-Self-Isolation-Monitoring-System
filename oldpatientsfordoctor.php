<?php
require_once 'classes/db.php';

session_start();

$uname = $_GET['varname'];

$db = Db::getInstance();
$doctor_no =$db->getCommon('doctor','username',$uname)['doctor_no'];

$records =$db->getAllRelevant('patient_record','assigned_doctor_no',$doctor_no);



?>


<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="patientpastfordoctor1.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>



  <div class="container">
    <input type="checkbox" id="flip">

    <div class ="back-box" onclick="history.go(-1);" >
            Back
        </div>
<!-- 
        <button onclick="history.go(-1);">Back </button> -->

        <br>

    <div class="forms">
        <div class="form-content">
          <div class="login-form"  >
            <div class="title">Previous Patients' Records </div>
            <div class="input-boxes">
                
            </div>

            <?php 
            // var_dump($patient_records);
            $x=0;


            while($x<count($records)){ 
              if($records[$x]['status'] != 'ongoing'){
                $patient_no = $records[$x]['patient_no'];
                $patient_name = $db->getCommon('patient','patient_no',$patient_no)['patient_name'];
                $record_no = $records[$x]['patient_record_no'];           
              
              ?>
            
              
              <div class = "record-box" onclick="location.href='viewapastrecordfordoctor.php?varname=<?php echo $record_no ?>&varname1=<?php echo $patient_no ?>';" style="cursor: pointer;" > 
              <h2> <?php echo $patient_no . ' - ' . $patient_name ?></h2>
              <h3> <?php echo $records[$x]['start_date'] ?> -> <?php echo $records[$x]['end_date'] ?></h3>
              <h3> <?php echo $records[$x]['status'] ?></h3>
              
              </div>
              <br> <br>
              <?php
              }
              $x = $x+1;

            }

            
            
            ?> 
                     

        
      </div>

      
    </div>
    </div>
    </div>
  </div>
  
</body>
</html>
