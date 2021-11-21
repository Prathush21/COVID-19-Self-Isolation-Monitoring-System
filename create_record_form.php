<?php

session_start();


chdir("classes");
require_once 'classes/patientrecord.php';

if(!empty($_POST)){
  if (isset($_POST['reason']))
    $reason = $_POST['reason'];
  if (isset($_POST['vaccination']))
    $vaccination = $_POST['vaccination'];
  if (isset($_POST['employment']))
    $employment = $_POST['employment'];
  if (isset($_POST['contact-type']))
    $contacttype = $_POST['contact-type'];
  $time = $_POST['appt'];
  if(isset($_POST['click'])){
    $start_date = date('Y-m-d');
  }

  $patientRecord = new PatientRecord();

  //finding the patient number
  $uname = $_SESSION['uname'];
  $patient_no = $patientRecord->getPatientNo($uname);

  $enddate = $patientRecord->getEndDate($reason,$contacttype,$employment,$vaccination,$start_date);
  if($enddate == $start_date){
    $_SESSION['qualified'] = false;
  }

  $docno = $patientRecord->assignDoctor();
  
  if($enddate != $start_date){
    if(
      $patientRecord->create(array(
        'patient_no' => $patient_no,
        'reason' => $reason,
        'vaccination' => $vaccination,
        'employment' => $employment,
        'email_time' => $time,
        'start_date' => $start_date,
        'contact_type' => $contacttype,
        'assigned_doctor_no' => $docno,
        'end_date' => $enddate,
      ))
    ){
      header("Location:patient_dashboard.php");
    }
  }
  else{
    header("Location:patient_dashboard.php");
  }

}


?>

<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
  <link rel="stylesheet" href="createrecord1.css" />
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<!-- <script>
  function errorMessage() {
   
  
    if (
      document.getElementById("password").value !=
      document.getElementById("repassword").value
    ) {
      document.getElementById("repsw").style.color = "red";
      document.getElementById("repsw").innerHTML =
        "Password did not match";
      return false;
    }
    else{
      return true;
    }
  };
</script> -->

<body>
  <div class="container">
    <input type="checkbox" id="flip" />

    <div class="forms">
      <!-- <div class="form-content"> -->
      <div  class="create-record-form" >
        <div class="title">Create New Record</div>
        <form  action="#" method="post">

        

          <div class="input-boxes">

          <label for="reason"><b>Reason for self-isolation</b></label>          
          <br><br>
            <label class="radio-container">
            <input type="radio" onclick="javascript:yesnoCheck();" name="reason" value="covid-positive" required>
            <label for="covid-positive" style="color: black">Tested COVID Positive</label>
          </label>

          <br><br>
          <label class="radio-container">
            <input type="radio" onclick="javascript:yesnoCheck();" name="reason" value="foreign-return">
            <label for="foreign-return" style="color: black">Foreign Return</label>
          </label>
          <br>

          <br>
          <label class="radio-container">
          <input type="radio" onclick="javascript:yesnoCheck();" id="yesCheck" name="reason" value="close-contact">
          <label for="close-contact" style="color: black">Close Contact of COVID Positive Patient</label>

          </label>
          <div class="sub" id="ifYes" style="left:50px"><br>
        <label for="type"><b>Type of close contact:</b></label> 
        <br>
      
        <input type="radio" id="inside" name='contact-type' value="inside" disabled required> 
        <label for="inside" style="color: black">Index case inside the household</label>
        <br>
        <input type="radio" id="outside" name='contact-type' value="outside" disabled> 
        <label for="outside" style="color: black">Index case outside the household</label>
    </div>


          <br>
          <label for="vaccination"><b>Vaccination Status</b></label>
          <br><br>
            <label class="radio-container">
            <input type="radio" id="html" name="vaccination" value="fully-vaccinated" required>
            <label for="fully-vaccinated" style="color: black">Fully Vaccinated</label>
          </label>
          <br><br>
          <label class="radio-container">
          <input type="radio" id="html" name="vaccination" value="partially-vaccinated">
          <label for="partially-vaccinated" style="color: black">Partially Vaccinated</label>
          </label>

          <br><br>
          <label class="radio-container">
            <input type="radio" id="html" name="vaccination" value="unvaccinated">
            <label for="unvaccinated" style="color: black">Unvaccinated</label>
          </label>
          <br>


          <br>
          <label for="employment"><b>Employment Category</b></label>
          <br><br>
            <label class="radio-container">
            <input type="radio" id="html" name="employment" value="hospital-work" required>
            <label for="hospital-work" style="color: black">Patient Care Management services in hospital</label>
          </label>

          <br><br>
          <label class="radio-container">
          <input type="radio" id="html" name="employment" value="MOH-work">
          <label for="MOH-work" style="color: black">Field health services related to COVID 19 surveillance in MOH</label>
          </label>

          <br><br>
          <label class="radio-container">
            <input type="radio" id="html" name="employment" value="essential-work">
            <label for="essential-work" style="color: black">Other essential services recognized by government</label>
          </label>
          
          <br><br>
          <label class="radio-container">
            <input type="radio" id="html" name="employment" value="none">
            <label for="none" style="color: black">None of the above</label>
          </label>
          <br>
          

          <div class="input-box">
              <label for="dob"><b>Preferred Time for Emails</b></label><br>
              <small>We would like to send you an email at a convenient time, reminding you to fill the form with your symptoms.
              Please select your preferred time to receive this reminder email.</small>
              <input type="time" id="appt" name="appt" required> 
              <!-- min="09:00" max="18:00" -->
            </div>
          <br>
            <div class="button input-box">
              <input name = "click" type="submit"  value="Create Record" />
            </div>

            
          </div>
        </form>
      </div>
      <!-- </div> -->
    </div>
  </div>
  <script>
  
  function yesnoCheck() {
    document.getElementById("inside").disabled = true;  
    document.getElementById("outside").disabled = true;  

    if (document.getElementById('yesCheck').checked) {
        document.getElementById('inside').disabled=false;
        document.getElementById('outside').disabled=false;
    }

}
</script>

</body>

</html>