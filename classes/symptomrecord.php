<?php
require_once 'db.php';

class SymptomRecord{
    private $db;

    public function __construct(){
        $this->_db = Db::getInstance();
    }

    public function create($fields = array()){
        if (!$this->_db->insert('symptom_record',$fields)){
            throw new Exception('There was a problem in creating this patient record.');
        }
        else
            return true;
    }

    public function getPatientRecordNo($patientno){
        $result = $this->_db->getMaxRecord('patient_record',$patientno,'patient_record_no');
        return $result;
    }

    public function getSymptomNo($val){
        $result=$this->_db->getMax('symptom_record','symptom_record_no',$val,'patient_record_no');
        return $result;
    }

    public function updateSymptom($col1,$val1,$val2){
        $result=$this->_db->updateSimple('symptom_record',$col1,'symptom_record_no',$val1,$val2);

    }


    public function checkSeverity($oxygen,$p1,$p2,$pulse,$temp){
        $count=0;
        if($oxygen<94){
            $count++;
        }
        if($p1>130 or $p2>90 ){
            $count++;
        }

        if($pulse>100){
            $count++;
        }

        if($temp>100.4){
            $count++;
        }

        return $count;
    }
 
}
?>