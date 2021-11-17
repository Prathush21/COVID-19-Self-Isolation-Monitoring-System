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
        $enddate = date('Y-m-d', strtotime($startdate . " + " .$duration." days"));
        return $enddate;
    }
}
?>