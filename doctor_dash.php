<?php

session_start();


require_once  'classes/doctor.php';

$uname = $_SESSION['username'];

if($_SESSION['qualified'] == false){
    $status = "You can't have an account here";
}
else{
    $status = $uname;
}

$doctor = Doctor::getInstance($uname);
$patients = $doctor->getPatientList($uname);
?>