<?php
require_once 'db.php';
require_once 'user.php';

class Patient extends User{
    private $db;

	private static $instances=array();

    private function __construct($user = null) {
		$this->_db = Db::getInstance();
    }

	public static function getInstance($uname){
		if(!array_key_exists($uname,self::$instances)){
				self::$instances[$uname]=new self();
			
		}
		
		return self::$instances[$uname];
	}


    public function create($fields = array()) {
		if(!$this->_db->insert('patient', $fields)) {
			throw new Exception('There was a problem creating this patient account.');
		}
		else{
			return true;
		}
	}
	public function createUser($fields = array()) {
		if(!$this->_db->insert('user', $fields)) {
			throw new Exception('There was a problem creating this patient account.');
		}
		else{
			return true;
		}
	}
	public function getDetails($uname){
        $result=$this->_db->getCommon('patient','username',$uname);
        return $result;
    }

	public function update($fields = array(),$uname) {
		if(!$this->_db->update('patient',$uname, $fields)) {
			throw new Exception('There was a problem updating this patient account.');
		}
		else{
			return true;
		}
	}
	
	
}
?>