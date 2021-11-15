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

	public function login($table, $uname, $password){
       
        
        $result =  $this->_db->get($table,$uname);

        if (password_verify($password, $result['password'])){
                    // echo "login successful";
            return true;
        }
        else {
            return false;
        }
            
        
        

    }


}
?>