<?php

session_start();


require_once  'classes/user.php';
require_once 'classes/patient.php';
require_once 'classes/validate.php';
require_once 'classes/symptomrecord.php';


$patient_no = 21;

if (!empty($_POST)) {
  $oxygen = $_POST['oxygen'];
  $pressure1 = $_POST['pressure1'];
  $pressure2 = $_POST['pressure2'];
  $pulse = $_POST['pulse'];
  $temp = $_POST['temp'];



 



  $symptom_record = new SymptomRecord();
  $patient_record_no = $_SESSION['record'];
  $_SESSION['record_no']=$patient_record_no;
  $_SESSION['oxygen'] = $oxygen;
  $_SESSION['pressure1'] = $pressure1;
  $_SESSION['pressure2'] = $pressure2;
  $_SESSION['pulse'] = $pulse;
  $_SESSION['temp'] = $temp;


  header("Location:commonsymptoms.php");

  
}


?>
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
  <link rel="stylesheet" href="symptom_record.css" />
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
        <div class="title">Symptom Record</div>
        <form action="#" method="post">
          <div class="input-boxes">
            <div class="input-box">
              <label for="oxygen"><b>Oxygen Saturation</b></label>
              <input type="number" placeholder="" name="oxygen" min="1" max="100" step = "0.1" required /><br />
            </div>
            <div class="input-box">
              <label for="pressure1"><b>Systolic blood pressure </b></label>
              <input type="number" id="pressure1" name="pressure1" required />
              <!-- <span id="pressure1" style="color:red"><?php echo $error1; ?></span> -->

            </div>

            <div class="input-box">
              <label for="pressure2"><b>Diastolic blood pressure </b></label>
              <input type="number" id="pressure2" name="pressure2" required />
              

            </div>
            <div class="input-box">
              <label for="pulse"><b>Pulse Rate</b></label>
              <input type="number" id="pulse" name="pulse" required />
              <!-- <span id="pulse"></span> -->
            </div>

            <div class="input-box">
              <label for="temp"><b>Temperature</b></label>
              <input type="number" placeholder="Enter the temperature in fahrenheit" id="temp" name="temp" step="0.1" required />
              



           

            <div class="button input-box">
              <input type="submit" value="Next Page" onclick="redirecting()"  />
            </div>

            <script>
          function redirecting() {
            location.replace("commonsymptoms.php")

          }
        </script>





            <a href='https://www.google.lk' ><div class="text sign-up-text">
              Help?
            </div></a>
          </div>
        </form>
      </div>
      <!-- </div> -->
    </div>
  </div>
</body>

</html>