<?php

$error1="";
$error2="";
$error3="";
$error4="";
$error5="";

?>

<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
  <link rel="stylesheet" href="create_record_form.css" />
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
            <!-- <div class="input-box">
              <label for="name"><b>Name</b></label>
              <input type="text" placeholder="Enter your name" name="name" required /><br />
            </div> -->

            
          <label for="reason"><b>Reason for self-isolation</b></label>
          <br><br>
            <label class="radio-container">
            <input type="radio" id="html" name="reason" value="covid-positive">
            <label for="covid-positive" style="color: black">Tested COVID Positive</label>
          </label>
          <br><br>
          <label class="radio-container">
          <input type="radio" id="html" name="reason" value="close-contact">
          <label for="close-contact" style="color: black">Close Contact of COVID Positive Patient</label>
          </label>

          <br><br>
          <label class="radio-container">
            <input type="radio" id="html" name="reason" value="foreign-return">
            <label for="foreign-return" style="color: black">Foreign Return</label>
          </label>
          <br>


          <br>
          <label for="vaccination"><b>Vaccination Status</b></label>
          <br><br>
            <label class="radio-container">
            <input type="radio" id="html" name="vaccination" value="fully-vaccinated">
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
            <input type="radio" id="html" name="employment" value="hospital-work">
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
              <input type="time" id="appt" name="appt" min="09:00" max="18:00" required>
            </div>
          <br>
            <div class="button input-box">
              <input type="submit"  value="Create Record" />
            </div>

            <!-- <script>
              function errorMessage() {
                if (
                    document.getElementById("password").value ==
                    document.getElementById("repassword").value
                  ) {
                    document.getElementById("repassword").style.color = "green";
                    document.getElementById("repassword").innerHTML =
                      "Passwords matched";
                  } else {
                    document.getElementById("repassword").style.color = "red";
                    document.getElementById("repassword").innerHTML =
                      "Password did not match";
                  }

              }
            </script> -->
            
          </div>
        </form>
      </div>
      <!-- </div> -->
    </div>
  </div>
</body>

</html>