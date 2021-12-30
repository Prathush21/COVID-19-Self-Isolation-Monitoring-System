<?php

require_once 'db.php';
require_once 'mail.php';

class PatientRecord{
    private $_db, $mail, $currentState, $patient_record_no, $patient_no, $reason, $vaccination, $employment, $time, $startdate, $contacttype;

    // public function __construct($patient_no, $reason, $vaccination, $employment, $time, $startdate, $contacttype){
    //     $this->_db = Db::getInstance();
    //     $docno = $this->assignDoctor();
    //     $enddate = $this->getEndDate($reason,$contacttype,$employment,$vaccination,$startdate);
    //     if($this->create(array(
    //         'patient_no' => $patient_no,
    //         'reason' => $reason,
    //         'vaccination' => $vaccination,
    //         'employment' => $employment,
    //         'email_time' => $time,
    //         'start_date' => $startdate,
    //         'contact_type' => $contacttype,
    //         'assigned_doctor_no' => $docno,
    //         'end_date' => $enddate,
    //     ))){
    //         $result = $this->_db->getCommon('patient_record','status',NULL);
    //         $this->patient_record_no = $result['patient_record_no'];
    //         $this->currentState = new Ongoing($this->patient_record_no);
    //         $this->patient_no = $result['patient_no'];
    //     }
        
    // }

    public function __construct(){
        $this->_db = Db::getInstance();
        $this->mail = new Mail();
    }

    public function create($fields = array()){
        $docno = $this->assignDoctor();
        $enddate = $this->getEndDate($fields['reason'],$fields['contact_type'],$fields['employment'],$fields['vaccination'],$fields['startdate']);
        $fields['assigned_doctor_no'] = $docno;
        $fields['end_date'] = $enddate;
        if (!$this->_db->insert('patient_record',$fields)){
            throw new Exception('There was a problem in creating this patient record.');
        }
        else{
            $result = $this->_db->getCommon('patient_record','status',NULL);
            $this->patient_record_no = $result['patient_record_no'];
            $this->currentState = new Ongoing();
            $this->currentState->setStateInDB($this->patient_record_no);
            return true;
        }
    }

    public function sendToHospital(){
        return $this->currentState->sendToHospital($this);
    }

    public function acceptPCR(){
        return $this->currentState->acceptPCR($this);
    }

    public function rejectPCR($patient_uname, $recordno){
        $email = $this->_db->getCommon('patient','username',$patient_uname)['email_add'];
        $this->_db->updateSimple('patient_record','pcr_report', 'patient_record_no',NULL,$recordno);
        $this->mail->sendPCRRejectedMail($email);
    }

    public function setState($newState){
        $this->currentState = $newState;
    }

    public function setRecordNumber($recordno){
        $this->patient_record_no = $recordno;
    }

    public function setPatientNumber($patientno){
        $this->patient_no = $patientno;
    }

    public function getPatientNumber(){
        return $this->patient_no;
    }

    public function getRecordNumber(){
        return $this->patient_record_no;
    }

    public function getPCR($recordno){
        $pcr = $this->_db->getCommon('patient_record','patient_record_no',$recordno)['pcr_report'];
        return $pcr;
    }
    
    public function assignDoctor(){

        $prevdocno = $this->_db->getLastRowElement('patient_record','patient_record_no','assigned_doctor_no');
        
        
        if (($prevdocno == null) || ($prevdocno == $this->_db->getLastRowElement('doctor','doctor_no','doctor_no'))){
            $docno = $this->_db->getFirstRowElement('doctor','doctor_no');            
        }
        else{
            $docno = $prevdocno;
            while(true){
                $docno++;
                $result = $this->_db->getCommon('doctor','doctor_no',$docno)['doctor_no'];
                if($result != null)
                    break;
            }
        }
        
        return $docno;
       
    }

    public function getEndDate($reason,$contacttype,$employment,$vaccination,$startdate){
        $duration = 0;
        if ($reason == "covid-positive"){
            if ($employment == "none"){
                $duration = 14;
            }
            else{
                $duration = 10;
            }
        }
        elseif ($reason == "close-contact"){
            if($contacttype == "inside"){
                if($vaccination == "fully-vaccinated"){
                    $duration = 14;
                }
                else{
                    $duration = 21;
                }
            }
            else{
                if ($vaccination == "fully-vaccinated"){
                    if(($employment == "essential-work") || ($employment == "none")){
                        $duration = 10;
                    }
                }
                else{
                    $duration = 14;
                }
            }
        }
        else{
            $duration = 14; //for foreign return - not specified by gov though
        }
        $enddate = date('Y-m-d', strtotime($startdate . " + " .$duration." days"));
        return $enddate;
    }

    public function getRecord($val){
        $result=$this->_db->getMaxRecord('patient_record', $val,'patient_record_no');
        return $result;

    }
}
?>

