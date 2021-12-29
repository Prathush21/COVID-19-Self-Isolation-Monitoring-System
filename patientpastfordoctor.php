<?php
require_once 'classes/db.php';

session_start();

$uname = $_SESSION['username'];

$patient_no = $_GET['varname1'];
$current_record_no = $_GET['varname'];

if($_SESSION['qualified'] == false){
    $status = "You can't create a record";
    $_SESSION['qualified']=true;
}
else{

    $status = $uname;

}

$db = Db::getInstance();
$patient_det =$db->getCommon('patient','patient_no',$patient_no);

$patient_name = $patient_det['patient_name'];

$result = $db->getAll('patient_record','patient_no',$patient_no);
$patient_records = array_reverse($result);

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

    <div class ="back-box" onclick="location.href='patientsymptomsfordoctor2.php?varname=<?php echo $current_record_no ?>&varname1=<?php echo $patient_no ?>'" style="cursor:pointer;" >
            Back
        </div>

        <br>

    <div class="forms">
        <div class="form-content">
          <div class="login-form"  >
            <div class="title">Patient <?php echo $patient_no . " - " . $patient_name?> <br><br>  Past Records</div>
         
            <div class="input-boxes">
                
            </div>

            <?php 
            // var_dump($patient_records);
            $x=0;


            while($x<count($patient_records)){ 
              $record_no = $patient_records[$x]['patient_record_no'];
              if($record_no != $current_record_no){
              $no = count($patient_records)-$x;
              $doctor_no =  $patient_records[$x]['assigned_doctor_no'];
              
              ?>
            
              
              <div class = "record-box" onclick="location.href='viewapastrecordfordoctor.php?varname=<?php echo $record_no ?>&varname1=<?php echo $patient_no ?>';" style="cursor: pointer;" > 
              <h2> Record <?php echo count($patient_records)-$x ?></h2>
              <h3> <?php echo $patient_records[$x]['start_date'] ?> -> <?php echo $patient_records[$x]['end_date'] ?></h3>
              
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
