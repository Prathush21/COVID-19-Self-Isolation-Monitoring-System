<?php

require_once 'db.php';

class User{
    private $db;

    public function __construct($user = null) {
		$this->_db = Db::getInstance();
    }

    public function create($fields = array()) {
		if(!$this->_db->insert('user', $fields)) {
			throw new Exception('There was a problem creating this account.');
		}
		else{
			return true;
		}
	}

    public function update($fields = array(),$uname) {
		if(!$this->_db->update('user',$uname, $fields)) {
			throw new Exception('There was a problem updating this patient account.');
		}
		else{
			return true;
		}
	}

    public function getDetails($uname){}
    public static function getInstance($uname){}
    // public function login($uname, $password){
	// 	echo 'hi';
    //     return $this->db->getPassword('user',$uname, $password);
    // }
	public function login($table, $uname, $password){
       
        
        $result =  $this->_db->getCommon($table,'username',$uname);

        if (password_verify($password, $result['password'])){
                    // echo "login successful";
            return true;
        }
        else {
            return false;
        }
            
        
        

    }

    public function check($table,$uname){
        $result =  $this->_db->getCommon($table,'username',$uname);
        if($result){
            return true;
        }
        else{
            return false;
        }
        
    }

    public function loginDoctor($table,$uname,$psw){
        $result=$this->_db->getCommon($table,'username',$uname);
        if($result['password']==$psw){
            return true;
        }
        else{
            if (password_verify($psw, $result['password'])){
                // echo "login successful";
                return true;
            }
            else {
                return false;
            }
        
        }
    }
}
?>