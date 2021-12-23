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
        $this->_db->updateOne('symptom_record',$col1,'symptom_record_no',$val1,$val2);

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
    
    // public function assignDoctor(){

    //     $prevdocno = $this->_db->getLastRowElement('patient_record','patient_record_no','assigned_doctor_no');
        
        
    //     if (($prevdocno == null) || ($prevdocno == $this->_db->getLastRowElement('doctor','doctor_no','doctor_no'))){
    //         $docno = $this->_db->getFirstRowElement('doctor','doctor_no');            
    //     }
    //     else{
    //         $docno = $prevdocno;
    //         while(true){
    //             $docno++;
    //             $result = $this->_db->getCommon('doctor','doctor_no',$docno)['doctor_no'];
    //             if($result != null)
    //                 break;
    //         }
    //     }
        
    //     return $docno;
       
    // }

    // public function getEndDate($reason,$contacttype,$employment,$vaccination,$startdate){
    //     $duration = 0;
    //     if ($reason == "covid-positive"){
    //         if ($employment == "none"){
    //             $duration = 14;
    //         }
    //         else{
    //             $duration = 10;
    //         }
    //     }
    //     elseif ($reason == "close-contact"){
    //         if($contacttype == "inside"){
    //             if($vaccination == "fully-vaccinated"){
    //                 $duration = 14;
    //             }
    //             else{
    //                 $duration = 21;
    //             }
    //         }
    //         else{
    //             if ($vaccination == "fully-vaccinated"){
    //                 if(($employment == "essential-work") || ($employment == "none")){
    //                     $duration = 10;
    //                 }
    //             }
    //             else{
    //                 $duration = 14;
    //             }
    //         }
    //     }
    //     else{
    //         $duration = 14; //for foreign return - not specified by gov though
    //     }
    //     $enddate = date('Y-m-d', strtotime($startdate . " + " .$duration." days"));
    //     return $enddate;
    // }
}
?>