<?php

require_once 'db.php';

class Validate{


    private $db;
    private $errorcount;
    private $errors=array();

    public function __construct() {
        $this->_errorcount=0;
        $this->_db = Db::getInstance();
    }


    public function checkUser($uname){
        if($this->_db->select('user',$uname)){
            $this->_errorcount+=1;
            $this->_errors[]=$uname;
            return true;

        }
        return false;
    }

    public function geterror(){
        return $this->_errors;
    }


    public function matchPassword($psw,$repsw){
        if($psw!=$repsw){
            $this->_errorcount+=1;
            $this->_errors[]=$repsw;
            return true;
            
        }
        return false;
    }

    public function checkMobile($mobileno){
        if(strlen($mobileno)!=10){
            $this->_errorcount+=1;
            $this->_errors[]=$mobileno;
            return true;          
        }
        return false;        
    }

    public function checkEmail($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->_errorcount+=1;
            $this->_errors[]=$email;
            return true;
        }
        return false;
    }

    public function checkNic($nic){
        if (strlen($nic)!=10 and strlen($nic)!=12){
            $this->_errorcount+=1;
            $this->_errors[]=$nic;
            return true;
        }
        else{
            if (strlen($nic)==10){
                if (!(is_numeric(substr($nic,0,9)) and (strtoupper(substr($nic,9))=='V' or strtoupper(substr($nic,9))=='X'))){
                    $this->_errorcount+=1;
                    $this->_errors[]=$nic;
                    return true;
                }
            }
            else{
                if(!(is_numeric($nic))){
                    $this->_errorcount+=1;
                    $this->_errors[]=$nic;
                    return true;
                }
            }
        }
        return false;
    }


    public function checkUserExists($table,$uname){
        if(!($this->_db->select($table,$uname))){
            return true;
        }
        return false;
    }

    public function passed(){
        if ($this->_errorcount==0){
            return true;
        }
        return false;
    }

    // public function checkPassword($table, $uname, $password){
       
        
    //     $result =  $this->_db->get($table,$uname);

    //     if (password_verify($password, $result['password'])){
    //                 // echo "login successful";
    //         return true;
    //     }
    //     else {
    //                 // echo "password incorrect";
    //         $this->_errorcount+=1;
    //         return false;
    //     }
            
        
        

    // }
}


?>