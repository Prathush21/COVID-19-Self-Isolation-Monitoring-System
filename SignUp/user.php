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
	}


}
?>