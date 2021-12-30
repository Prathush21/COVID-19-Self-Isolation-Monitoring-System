<?php
require_once 'db.php';
require_once 'patientrecord1.php';
require_once 'recordstate.php';

class Patient{
    private $_db;

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

	public function getRecord($recordno){
		$result=$this->_db->getCommon('patient_record','patient_record_no',$recordno);
        return $result;
	}

	public function getRecordObject($recordno){
		$result=$this->_db->getCommon('patient_record','patient_record_no',$recordno);
		$patientRecord = "";
		if($result['status'] == "ongoing"){
			$patientRecord = new PatientRecord();
			$patientRecord->setState(new Ongoing());
			$patientRecord->setRecordNumber($recordno);
			$patientRecord->setPatientNumber($result['patient_no']);			
		}
		return $patientRecord;

		
	}

	public function getOngoingRecord($uname){
		$patient_no = $this->getPatientNo($uname);
		$records = $this->_db->getAll('patient_record','patient_no',$patient_no);
		foreach($records as $record){
			if($record['status'] == "ongoing"){
				return $record;
			}
		}
	}

	public function getPatientUsername($patient_no){
		return $this->_db->getCommon('patient','patient_no',$patient_no)['username'];
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
	
	public function validatePatientRecordCreation($reason,$contacttype,$employment,$vaccination){
		$valid = true;
		if($reason == "close-contact"){
			if ($contacttype == "outside"){
				if ($vaccination == "fully-vaccinated"){
					if(($employment == "hospital-work") || ($employment == "MOH-work")){
						$valid = false;
					}
				}
			}
		}
		return $valid;
	}

	public function getPatientNo($uname){
        $result = $this->_db->get('patient',$uname);
        return $result['patient_no'];
    }

}
?>