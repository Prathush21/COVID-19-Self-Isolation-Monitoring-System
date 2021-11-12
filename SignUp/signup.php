<?php 

require_once 'user.php';
require_once 'patient.php';
require_once 'validate.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST['name'];
    $uname=$_POST['uname'];
    $psw=$_POST['password'];
    $nic=$_POST['nic'];
    $repsw=$_POST['repassword'];
    $address=$_POST['address'];
    $mobileno=$_POST['mobileno'];
    $email=trim($_POST['email-id']);
    $dob=$_POST['dob'];
    $gender=$_POST['gender'];
    $hashed = password_hash($psw,PASSWORD_DEFAULT);
}

// $validate=new Validate();
// $validate->checkUser($uname);
// $validate->matchPassword($psw,$repsw);
// $validate->checkMobile($mobileno);
// $validate->checkEmail($email);
// $validate->checkNic($nic);




// if ($validate->passed()){
    $user=new User();
    $user->create(array(
        'username'=> $uname,
        'password'=> $hashed,
    ));

    $patient = new Patient();
    $patient->create (array(
    'patient_name'=>$name,
    'NIC'=>$nic,
    'address'=>$address,
    'phonenumber'=>$mobileno,
    'email_add'=>$email,
    'DOB'=>$dob,
    'gender'=>$gender,
    'username'=>$uname,
    ));
//}


?>