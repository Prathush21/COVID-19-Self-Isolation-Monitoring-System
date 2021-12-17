<?php
require_once 'db.php';

class Patient{
    private $db;

    public function __construct($user = null) {
		$this->_db = Db::getInstance();
    }

    public function create($fields = array()) {
		if(!$this->_db->insert('patient', $fields)) {
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