<?php

session_start();
$patient_record_no = $_SESSION['record_no'];
$number = $_SESSION['number'];
$doc_no = $_SESSION['doc_no'];


require_once  'classes/user.php';
require_once 'classes/patient.php';
require_once 'classes/validate.php';
require_once 'classes/symptomrecord.php';


$breathe = 'no';
$fever = 'no';
$throat = 'no';
$body_ache = 'no';
$confusion = 'no';
$vomit = 'no';
$nose = 'no';
$eyes = 'no';
$headache = 'no';
$taste = 'no';
$doubt = '';
$oxygen = $_SESSION['oxygen'];
$pressure1 =  $_SESSION['pressure1'];
$pressure2 =  $_SESSION['pressure2'];
$pulse =  $_SESSION['pulse'];
$temp =  $_SESSION['temp'];



if (!empty($_POST)) {



    if (isset($_POST['breathe'])) {
        $breathe = $_POST['breathe'];
    }

    if (isset($_POST['fever'])) {
        $fever = $_POST['fever'];
    }
    if (isset($_POST['throat'])) {
        $throat = $_POST['throat'];
    }
    if (isset($_POST['bodyache'])) {
        $body_ache = $_POST['bodyache'];
    }
    if (isset($_POST['confusion'])) {
        $confusion = $_POST['confusion'];
    }
    if (isset($_POST['vomit'])) {
        $vomit = $_POST['vomit'];
    }
    if (isset($_POST['nose'])) {
        $nose = $_POST['nose'];
    }
    if (isset($_POST['eyes'])) {
        $eyes = $_POST['eyes'];
    }
    if (isset($_POST['headache'])) {
        $headache = $_POST['headache'];
    }
    if (isset($_POST['taste'])) {
        $taste = $_POST['taste'];
    }
    if (isset($_POST['doubt'])) {
        $doubt = $_POST['doubt'];
    }



    $symptom_record = new SymptomRecord();


    if (

        $symptom_record->create(array(
            'patient_record_no' => $patient_record_no,
            'oxygen' => $oxygen,
            'pressure1' => $pressure1,
            'pressure2' => $pressure2,
            'pulse' => $pulse,
            'temperature' => $temp,
            'breathe' => $breathe,
            'fever' => $fever,
            'throat' => $throat,
            'body_ache' => $body_ache,
            'confusion' => $confusion,
            'vomit' => $vomit,
            'nose' => $nose,
            'eyes' => $eyes,
            'headache' => $headache,
            'taste' => $taste,
            'doubt' => $doubt,
            'date' => date('Y-m-d'),
            'status' => 'Pending',
        ))
    ) {
        // $_SESSION['username'] = $uname;
        // $_SESSION['qualified'] = true;
        header("Location:view_record.php?varname=  $record_no &varname1=  $no &varname2= $doctor_no ");
    }
}


?>
<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="commonsymptoms.css" />
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
                <div class="title">Symptom Record </div>
                <form action="#" method="post">
                    <div class="input-boxes">

                        <label for="Symptoms"><b>Other symptoms</b></label> <br /><br />
                        <input type="Checkbox" name="breathe" value="yes" />Shortness of breathe <br> <br>
                        <input type="Checkbox" name="fever" value="yes" />Fever<br> <br>
                        <input type="Checkbox" name="throat" value="yes" />Sore throat <br> <br>
                        <input type="Checkbox" name="bodyache" value="yes" />Chills and body aches(new) <br> <br>
                        <input type="Checkbox" name="confusion" value="yes">Confusion <br> <br>
                        <input type="Checkbox" name="vomit" value="yes" /> Nausea,vomitting or diarrhea <br> <br>
                        <input type="Checkbox" name="nose" value="yes" />Runny nose <br> <br>
                        <input type="Checkbox" name="eyes" value="yes" />Redness of the eyes <br><br>
                        <input type="Checkbox" name="headache" value="yes" />Headache <br><br>
                        <input type="Checkbox" name="taste" value="yes" />Loss of taste or smell <br>

                        <div class="input-box">
                            <label for="doubt"><b>Doubts</b></label>
                            <input type="text" id="doubt" name="doubt" />

                        </div>




                        <div class="button input-box">
                            <input type="submit" value="Submit" />
                        </div>
                        <a href='https://www.google.lk'>
                            <div class="text sign-up-text">
                                Help?
                            </div>
                        </a>




                    </div>
                </form>
            </div>
            <!-- </div> -->
        </div>
    </div>
</body>

</html>