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
				if(($result['end_date'] >= $today) && ($result['status'] == 'ongoing')){
					$patientname = $this->_db->getCommon('patient','patient_no',$result['patient_no'])['patient_name'];
					$record_no = $result['patient_record_no'];
					$patients += array($result['patient_no']=>[$patientname, $record_no]);
				}
			}
		}
        return $patients;           
	}


	// public function checkRecord($sym_num_array, $comment_array){
	// 	$checked = true;
	// 	$i = 0;
	// 	foreach($sym_num_array as $num){
	// 		if (!($this->_db->updateNew('symptom_record', 'symptom_record_no', $num, array('comments' => "Good", 'status' => 'checked')))){
	// 			$checked = false;
	// 		}
	// 		$i +=1 ;
	// 	}
	// 	return true;

	// 	// if ($this->_db->updateNew('symptom_record', 'symptom_record_no', $symptom_record_no, array('comments' => $comment, 'status' => 'checked'))){
	// 	// 	return true;
	// 	// }
	// 	// else{
	// 	// 	throw new Exception('Error in confirmation.');
	// 	// }
	// }

	// public function checkRecord($status){
	// 	$correctcount = 0;
	// 	foreach($status as $symrecno){
	// 		if($this->_db->updateSimple('symptom_record','status','symptom_record_no',"checked",$symrecno)){
	// 			$correctcount += 1;
	// 		}
	// 	}
	// 	if ($correctcount == count($status)){
	// 		return true;
	// 	}
	// 	else{
	// 		return false;
	// 	}
		
	// }
	
	public function updateComment($comments, $status, $patient_record_no){
		// $correctcount = 0;
		// $correctcount2 = 0;
		// $iterationcounter1 = 0;
		// $iterationcounter2 = 0;
		$correct = true;
		$commentno = 0;
		$symptom_record = $this->_db->getAllRelevant('symptom_record', 'patient_record_no', $patient_record_no);
		$reversed_record = array_reverse($symptom_record);
		foreach($reversed_record as $row){
			if($row['status'] == "Pending"){
				if($comments[$commentno] != $row['symptom_record_no']){
					if($this->_db->updateSimple('symptom_record','comments','symptom_record_no',$comments[$commentno],$row['symptom_record_no'])){
						// $correctcount += 1;
					}
					else{
						$correct = false;
					}
					$commentno += 1;
					// $iterationcounter1 += 1;
				}
			}
		}
		$correctcount = 0;
		foreach($status as $symrecno){
			if($this->_db->updateSimple('symptom_record','status','symptom_record_no',"checked",$symrecno)){
				// $correctcount2 += 1;
			}
			else{
				$correct = false;
			}
			// $iterationcounter2 = 0;
		}
		// if(($correctcount == $iterationcounter1) && ($correctcount2 == $iterationcounter2)){
		// 	return true;
		// }
		// else{
		// 	return false;
		// }
		return $correct;
		
	}

}
?>