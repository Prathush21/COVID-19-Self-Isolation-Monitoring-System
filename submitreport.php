<?php

session_start();


require_once  'classes/user.php';
require_once 'classes/patient.php';
require_once 'classes/validate.php';
require_once 'classes/symptomrecord.php';
require_once  'classes/mail.php';
require_once 'classes/patientrecord.php';

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

$db = Db::getInstance();

$record_no=$_SESSION['record'];
$no=$_SESSION['number'] ;
$doc_no=$_SESSION['doc_no'];

$record_details=$db->getCommon('patient_record','patient_record_no',$record_no);
$doc_details=$db->getCommon('doctor','doctor_no',$doc_no);
$doc_email=$doc_details['doctor_email'];

$patient_details=$db->getCommon('patient','username',$uname);
$patient_no=$patient_details['patient_no'];
$patient_name=$patient_details['patient_name'];

if(isset($_POST['submit'])) {
   
    // Count total files
    // $countfiles = count($_FILES['files']['name']);
    
    // Prepared statement
    // $query = "INSERT INTO images (name,image) VALUES(?,?)";
   
    // $statement = $conn->prepare($query);
   
    // Loop all files
    // for($i = 0; $i < $countfiles; $i++) {
   
        // File name
        $filename = $_FILES['file']['name'];
       
        // Location
        $target_file = 'uploads/'.$filename;
       
        // file extension
        $file_extension = pathinfo(
            $target_file, PATHINFO_EXTENSION);
              
        $file_extension = strtolower($file_extension);
       
        // Valid image extension
        $valid_extension = array("png","jpeg","jpg","pdf");
       
        if(in_array($file_extension, $valid_extension)) {
   
            // Upload file
            if(move_uploaded_file(
                $_FILES['file']['tmp_name'],
                $target_file)
            ) {

                $patient_record=new PatientRecord();
                $patient_record->uploadFile($record_no,$target_file);
                //send mail
                $mail=new Mail();
                $mail->SendMailReport($doc_email,$patient_no,$patient_name);
                header("Location:view_record.php?varname=  $record_no &varname1=  $no &varname2= $doc_no ");
  
                // Execute query
                // $statement->execute(
                //     array($filename,$target_file));
            }
        }
    // }
      
    // echo "File upload successfully";
}


    


   




  


?>
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
  <link rel="stylesheet" href="submitreport.css" />
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
        <div class="title">Close Record</div>
        <br><br>
        <?php

        $file_name=$record_details['pcr_report'];
        echo '<a href="'.$file_name.'" role="text" aria-expanded="false" >'.$file_name .'</a>'; 

        ?>


        <form method='post' action='' 
        enctype='multipart/form-data'>
        <input type='file' id='input-box2' name='file' />
        <br><br>
        <input type='submit' id='input-box3' value='Submit' name='submit' />
    </form>
    <div class="button input-box">
          <input type="submit" onclick="location.href='view_record.php?varname=<?php echo $record_no ?>&varname1=<?php echo $no ?>&varname2=<?php echo $doc_no ?>';" value="Cancel Changes" />

        </div>
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