<?php

session_start();

require_once 'classes/validate.php';
require_once 'classes/user.php';



$validate = new Validate();
$error1 = "";
$error2 = "";
$uname = null;
$psw = null;

if(!empty($_POST)){
    $uname=$_POST['uname'];
    $psw=$_POST['password'];

    $_SESSION['username']=$uname;


if (($validate->checkUserExists('user',$uname))){
    $error1 = "No such user exists";
    
    //  echo $error1;
}else{
  // if($validate->checkPassword('user',$uname,$psw)){
    // $user = new User();
    if($validate->check('patient',$uname)){
      if($validate->verifyPassword('user',$uname,$psw)){


        $_SESSION['uname'] = $uname;
        $_SESSION['qualified'] = true;
        header("Location:patient_dashboard.php");
  
  
    }
    else{
      $error2="wrong password";
    }

    }
    else{
      if($validate->verifyPasswordDoctor('user',$uname,$psw)==1){
        $_SESSION['qualified'] = true;
        header("Location:doctordashboard.php");//have to change
      }
      else if ($validate->verifyPasswordDoctor('user',$uname,$psw)==0){
        $_SESSION['qualified'] = true;
        header("Location:doctorpassword.php");//have to change
      }
      else{
        $error2="wrong password";
      }
    }
    

}
// $validate->checkPassword('user',$uname,$psw);


// if (($validate->passed())){
//     $user = new User();
//     if ($user->login($uname, $psw)){
//         //start login session
       
//     }
// }
}

?>