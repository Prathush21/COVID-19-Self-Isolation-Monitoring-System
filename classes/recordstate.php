<?php

abstract class RecordState{
    
}

class Ongoing extends RecordState{
    private $_db, $mail;

    public function __construct() {
		$this->_db = Db::getInstance();
        $this->mail = new Mail();
        // $this->_db->updateSimple('patient_record','status', 'patient_record_no','ongoing',$patient_record_no);
    }

    public function setStateInDB($patient_record_no){
        $this->_db->updateSimple('patient_record','status', 'patient_record_no','ongoing',$patient_record_no);
    }

    public function sendToHospital($patientRecordObj){
        $record_no = $patientRecordObj->getRecordNumber();
        $patient_email = $this->_db->getCommon('patient','patient_no',$patientRecordObj->getPatientNumber())['email_add'];
        if($this->_db->updateNew('patient_record','patient_record_no',$record_no, array('end_date'=>date('Y-m-d'), 'status'=>'sent to hospital'))){
            $this->mail->sendRecordClosedMail($patient_email);
            return true;
        }
        return false;
    }

    public function acceptPCR($patientRecordObj){
        $record_no = $patientRecordObj->getRecordNumber();
        $patient_email = $this->_db->getCommon('patient','patient_no',$patientRecordObj->getPatientNumber())['email_add'];
        if($this->_db->updateNew('patient_record','patient_record_no',$record_no, array('end_date'=>date('Y-m-d'), 'status'=>'pcr submitted'))){
            $this->mail->sendPCRAcceptedMail($patient_email);
            return true;
        }
        return false;
    }

    public function expireRecord($patientRecordObj){
        $record_no = $patientRecordObj->getRecordNumber();
        $patient_email = $this->_db->getCommon('patient','patient_no',$patientRecordObj->getPatientNumber())['email_add'];
        if($this->_db->updateNew('patient_record','patient_record_no',$record_no, array('end_date'=>date('Y-m-d'), 'status'=>'quarantine ended'))){
            $this->mail->sendQuarantineExpiredMail($patient_email);
            return true;
        }
        return false;
    }
}

class PCRSubmitted extends RecordState{

}

class Hospitalized extends RecordState{
    
}

class QuarantineExpired extends RecordState{

}

?>