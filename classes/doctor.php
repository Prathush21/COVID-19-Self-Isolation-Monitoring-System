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
					$record_no = $result['patient_record_no'];
					$patients += array($result['patient_no']=>[$patientname, $record_no]);
				}
			}
		}
        return $patients;           
	}


	public function checkRecord($sym_num_array, $comment_array, $symptom_record_no){
		$checked = true;
		$i = 0;
		foreach($sym_num_array as $num){
			if (!($this->_db->updateNew('symptom_record', 'symptom_record_no', $num, array('comments' => $comment_array[$i], 'status' => 'checked')))){
				$checked = false;
			}
			$i +=1 ;
		}
		return $checked;

		// if ($this->_db->updateNew('symptom_record', 'symptom_record_no', $symptom_record_no, array('comments' => $comment, 'status' => 'checked'))){
		// 	return true;
		// }
		// else{
		// 	throw new Exception('Error in confirmation.');
		// }
	}
	
}
?>