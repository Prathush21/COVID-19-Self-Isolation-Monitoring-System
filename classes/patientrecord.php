<?php
require_once 'db.php';

class PatientRecord{
    private $db;

    public function __construct(){
        $this->_db = Db::getInstance();
    }

    public function create($fields = array()){
        if (!$this->_db->insert('patient_record',$fields)){
            throw new Exception('There was a problem in creating this patient record.');
        }
        else
            return true;
    }

    public function getPatientNo($uname){
        $result = $this->_db->get('patient',$uname);
        return $result['patient_no'];
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

    public function getRecordDetails($patient_no){
        $result=$this->_db->getAll('patient_record','patient_no',$patient_no);
        return $result;
    }
}
?>