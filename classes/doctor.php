<?php
require_once 'db.php';

class Doctor{
    private $db;

    public function __construct($user = null) {
		$this->_db = Db::getInstance();
    }

    public function create($fields = array()) {
		if(!$this->_db->insert('doctor', $fields)) {
			throw new Exception('There was a problem creating this patient account.');
		}
		else{
			return true;
		}
	}

    public function update($fields = array(),$uname) {
		if(!$this->_db->update('doctor',$uname, $fields)) {
			throw new Exception('There was a problem updating this patient account.');
		}
		else{
			return true;
		}
	}

    public function getDetails($uname){
        $result=$this->_db->getCommon('doctor','username',$uname);
        return $result;
    }

	public function getPatientList($uname){
		$docno = $this->_db->getCommon('doctor','username',$uname)['doctor_no'];
		$results = $this->_db->getAll("patient_record");
		$today = date('Y-m-d');
		$patients = array();
		foreach($results as $result){
			if ($result['assigned_doctor_no'] == $docno){
				if($result['end_date'] >= $today){
					$patientname = $this->_db->getCommon('patient','patient_no',$result['patient_no'])['patient_name'];
					$patients += array($result['patient_no']=>$patientname);
				}
			}
		}
        return $patients;           
	}
	
}
?>