<?php
session_start();

chdir("classes");
require_once  'classes/user.php';
require_once 'classes/patient.php';
require_once 'classes/validate.php';

$error1="";
$error2="";
$error3="";
$error4="";
$error5="";
$gender='no';
$asthma='no';
$lung='no';
$kidney='no';
$heart='no';
$diabetes='no';
$tension='no';
$cancer='no';
$immuno='no';

if(!empty($_POST)){
    $name=$_POST['name'];
    $uname=$_POST['uname'];
    $psw=$_POST['password'];
    $nic=$_POST['nic'];
    $repsw=$_POST['repassword'];
    $address=$_POST['address'];
    $mobileno=$_POST['mobileno'];
    $email=trim($_POST['email-id']);
    $dob=$_POST['dob'];
    if(isset($_POST['gender'])){
      $gender=$_POST['gender'];
    }
    
    if(isset($_POST['asthma'])){
      $asthma=$_POST['asthma'];
    }
    
    if(isset($_POST['lungdisease'])){
      $lung=$_POST['lungdisease'];
    }
    if(isset($_POST['kidney'])){
      $kidney=$_POST['kidney'];
    }
    if(isset($_POST['heart'])){
      $heart=$_POST['heart'];
    }
    if(isset($_POST['diabetes'])){
      $diabetes=$_POST['diabetes'];
    }
    if(isset($_POST['hyper'])){
      $tension=$_POST['hyper'];
    }
    if(isset($_POST['cancer'])){
      $cancer=$_POST['cancer'];
    }
    if(isset($_POST['immuno'])){
      $immuno=$_POST['immuno'];
    }
   
    $hashed = password_hash($psw,PASSWORD_DEFAULT);


$validate=new Validate();
if($validate->checkUser($uname)){
    $error1="User already exists";
}
if($validate->matchPassword($psw,$repsw)){
  $error2="Passwords didn't match";
}
if($validate->checkMobile($mobileno)){
  $error3="Invalid mobile number";
}
if($validate->checkEmail($email)){
  $error4="Invalid email address";
}
if($validate->checkNic($nic)){
  $error5="Invalid NIC number";
}




if ($validate->passed()){
    // $user=new User();
    $patient = Patient::getInstance($uname);
    if(
    $patient->createUser(array(
        'username'=> $uname,
        'password'=> $hashed,
    )) and

    
    $patient->create (array(
    'patient_name'=>$name,
    'NIC'=>$nic,
    'address'=>$address,
    'phonenumber'=>$mobileno,
    'email_add'=>$email,
    'DOB'=>$dob,
    'gender'=>$gender,
    'asthma'=>$asthma,
    'lung_disease'=>$lung,
    'kidney_failure'=>$kidney,
    'heart_disease'=>$heart,
    'diabetes'=>$diabetes,
    'hyper_tension'=>$tension,
    'cancer'=>$cancer,
    'immuno_deficiency'=>$immuno,
    'username'=>$uname,
    ))
    ){
      $_SESSION['uname']=$uname;
      $_SESSION['qualified'] = true;
      header("Location:patient_dashboard.php");
    }
}


}
?>
