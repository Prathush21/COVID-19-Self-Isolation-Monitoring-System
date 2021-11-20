<?php
chdir("classes");
require_once 'classes/patientrecord.php';

$patientRecord = new PatientRecord();
$patientRecord->assignDoctor();




?>