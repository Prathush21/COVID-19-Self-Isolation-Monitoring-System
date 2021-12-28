<?php

session_start();


require_once  'classes/user.php';
require_once 'classes/patient.php';
require_once 'classes/validate.php';
require_once 'classes/symptomrecord.php';
require_once 'classes/mail.php';

// $breathe = 'no';
// $body_ache = 'no';
// $vomit = 'no';

// $oxygen = $_SESSION['oxygen'];
// $pressure1 =  $_SESSION['pressure1'];
// $pressure2 =  $_SESSION['pressure2'];
// $pulse =  $_SESSION['pulse'];
// $temp =  $_SESSION['temp'];
$error='';
$uname = $_SESSION['uname'];



$record_no=$_SESSION['record'];
$no=$_SESSION['number'] ;
$doc_no=$_SESSION['doc_no'];

$db = Db::getInstance();
$doc_details=$db->getCommon('doctor','doctor_no',$doc_no);
$doc_email=$doc_details['doctor_email'];
$patient_details=$db->getCommon('patient','username',$uname);
$patient_no=$patient_details['patient_no'];
$patient_name=$patient_details['patient_name'];
$patient_phone=$patient_details['phonenumber'];

$symptom_record = new SymptomRecord();

$symptom_record_no=$symptom_record->getSymptomNo($record_no);

if (!empty($_POST)) {
    $count=0;
    if (isset($_POST['oxygen'])) {
        $oxygen = $_POST['oxygen'];
        if($oxygen!=''){
            $symptom_record->updateSymptom('oxygen',$oxygen,$symptom_record_no);
            $count++;
        }
        
    }

    if (isset($_POST['pressure1'])) {
        $pressure1 = $_POST['pressure1'];
        if($pressure1!=''){
            $symptom_record->updateSymptom('pressure1',$pressure1,$symptom_record_no);
            $count++;
        }
        
    }

    if (isset($_POST['pressure2'])) {
        $pressure2 = $_POST['pressure2'];
        if($pressure2!=''){
            $symptom_record->updateSymptom('pressure2',$pressure2,$symptom_record_no);
            $count++;
        }
       
    }

    if (isset($_POST['pulse'])) {
        $pulse = $_POST['pulse'];
        if($pulse!=''){
            $symptom_record->updateSymptom('pulse',$pulse,$symptom_record_no);
            $count++;
        }
       
    }

    if (isset($_POST['temp'])) {
        $temp = $_POST['temp'];
        if($temp!=''){
            $symptom_record->updateSymptom('temperature',$temp,$symptom_record_no);
            $count++;
        }

    }

    if (isset($_POST['breathe'])) {
        $breathe = $_POST['breathe'];
        $symptom_record->updateSymptom('breathe',$breathe,$symptom_record_no);
        $count++;
    }


    if (isset($_POST['bodyache'])) {
        $body_ache = $_POST['bodyache'];
        $symptom_record->updateSymptom('body_ache',$body_ache,$symptom_record_no);
        $count++;
    }

    if (isset($_POST['vomit'])) {
        $vomit = $_POST['vomit'];
        $symptom_record->updateSymptom('vomit',$vomit,$symptom_record_no);
        $count++;
    }

    if($count>0){
        //send mail
        $mail=new Mail();
        $mail->sendMail($doc_email,$patient_no,$patient_name,$patient_phone);
        header("Location:view_record.php?varname=  $record_no &varname1=  $no &varname2= $doc_no ");
    }
        
    else{
       $error='Fill atleast one field'; 
    }
    


   
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
        <div class="title">Update Symptom Record</div>
        <form action="#" method="post">
          <div class="input-boxes">
            <div class="input-box">
              <label for="oxygen"><b>Oxygen Saturation</b></label>
              <input type="number" placeholder="" name="oxygen" min="1" max="100" step = "0.1"  /><br />
            </div>
            <div class="input-box">
              <label for="pressure1"><b>Systolic blood pressure </b></label>
              <input type="number" id="pressure1" name="pressure1"  />
              <!-- <span id="pressure1" style="color:red"></span> -->

            </div>

            <div class="input-box">
              <label for="pressure2"><b>Diastolic blood pressure </b></label>
              <input type="number" id="pressure2" name="pressure2" />
              

            </div>
            <div class="input-box">
              <label for="pulse"><b>Pulse Rate</b></label>
              <input type="number" id="pulse" name="pulse" />
              <!-- <span id="pulse"></span> -->
            </div>

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
                        </div>

                        

        <!-- <script>
          function redirecting() {
            location.replace("view_record.php?varname=  $patient_record_no &varname1=  $number &varname2= $doc_no")

          }
        </script> -->





            <!-- <a href='https://www.google.lk' ><div class="text sign-up-text">
              Help?
            </div></a> -->
          </div>
        </form>
        <div class="button input-box">
          <input type="submit" onclick="location.href='view_record.php?varname=<?php echo $record_no ?>&varname1=<?php echo $no ?>&varname2=<?php echo $doc_no ?>';" value="Cancel Changes" />

        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>
</body>

</html>