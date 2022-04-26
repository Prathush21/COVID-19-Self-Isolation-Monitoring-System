<?php

session_start();


require_once  'classes/user.php';
require_once 'classes/patient.php';
require_once 'classes/validate.php';
require_once 'classes/symptomrecord.php';

// $breathe = 'no';
// $body_ache = 'no';
// $vomit = 'no';

// $oxygen = $_SESSION['oxygen'];
// $pressure1 =  $_SESSION['pressure1'];
// $pressure2 =  $_SESSION['pressure2'];
// $pulse =  $_SESSION['pulse'];
// $temp =  $_SESSION['temp'];
$error='';

$db = Db::getInstance();

$pcr = $_GET['varname'];
$record_no = $_GET['varname1'];
$patient_uname = $_GET['varname2'];

$patient = Patient::getInstance($patient_uname); 

$patientRecord = $patient->getRecordObject($record_no);

if(isset($_POST['accept'])) {
    if($patientRecord->acceptPCR()){
        header("Location:doctordashboard.php");
    }
}

if(isset($_POST['reject'])) {
    $patientRecord->rejectPCR($patient_uname, $record_no);
    header("Location:doctordashboard.php");
    
}


    


   




  


?>
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
  <link rel="stylesheet" href="submitreport1.css" />
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
        
      <div class = "record-box" onclick="history.go(-1);" >
           Back
        </div>
        <br><br>

        <div class="title">View PCR</div>
        <br>
        <?php
        echo '<a href="'.$pcr.'" role="text" aria-expanded="false" >'.$pcr .'</a>'; 

        ?>
        <br>
        <br>



        <form method='post' action='#'>
        
        <input type='submit' id='input-box4' value='Accept PCR' name='accept' />
 

        <input type="submit" id='input-box4' value="Reject PCR" name='reject' />

    </form>

    <!-- <div class="button input-box">
          <input type="submit" onclick="history.go(-1);" value="Reject PCR" name='reject' />

        </div> -->
    <!-- <div class ="back-box" onclick="history.go(-1);" >
           Reject PCR
        </div> -->

    <!-- <div class="button input-box">
          <input type="submit" onclick="location.href='view_record.php?varname=<?php echo $record_no ?>&varname1=<?php echo $no ?>&varname2=<?php echo $doc_no ?>';" value="Reject PCR" />

        </div> -->
        <!-- <form action="#" method="post">
          <div class="input-boxes">
            <div class="input-box">
              <label for="oxygen"><b>Oxygen Saturation</b></label>
              <input type="number" placeholder="" name="oxygen" min="1" max="100" step = "0.1"  /><br />
            </div> -->
            <!-- <div class="input-box">
              <label for="pressure1"><b>Systolic blood pressure </b></label>
              <input type="number" id="pressure1" name="pressure1"  /> -->
              <!-- <span id="pressure1" style="color:red"></span> -->

            <!-- </div>

            <div class="input-box">
              <label for="pressure2"><b>Diastolic blood pressure </b></label>
              <input type="number" id="pressure2" name="pressure2" />
              

            </div>
            <div class="input-box">
              <label for="pulse"><b>Pulse Rate</b></label>
              <input type="number" id="pulse" name="pulse" /> -->
              <!-- <span id="pulse"></span> -->
            <!-- </div>

            <div class="input-box">
              <label for="temp"><b>Temperature</b></label>
              <input type="number" placeholder="Enter the temperature in fahrenheit" id="temp" name="temp" step="0.1"  />
              
</div>

            <div class="input-boxes">

            <label for="Symptoms"><b>Other symptoms</b></label> <br /><br />
            <input type="Checkbox" name="breathe" value="yes" />Shortness of breathe <br> <br>
            <input type="Checkbox" name="bodyache" value="yes" />Chills and body aches(new) <br> <br>
            <input type="Checkbox" name="vomit" value="yes" /> Nausea,vomitting or diarrhea <br> <br>

</div>


<span  style="color:red"><?php echo $error;?></span>

              <div class="button input-box">
                            <input type="submit" value="Submit" />
                        </div> -->

                        

        <!-- <script>
          function redirecting() {
            location.replace("view_record.php?varname=  $patient_record_no &varname1=  $number &varname2= $doc_no")

          }
        </script> -->





            <!-- <a href='https://www.google.lk' ><div class="text sign-up-text">
              Help?
            </div></a> -->
          <!-- </div>
        </form> -->
        <!-- <div class="button input-box">
          <input type="submit" onclick="location.href='view_record.php?varname=<?php echo $record_no ?>&varname1=<?php echo $no ?>&varname2=<?php echo $doc_no ?>';" value="Cancel Changes" />

        </div> -->
      </div>
      <!-- </div> -->
    </div>
  </div>
</body>

</html>