<?php
class Mail{
    
    public function sendMail($doc_email,$patient_no,$patient_name,$patient_phone){

        $subject="Regarding severity of patient {$patient_no}";

        $msg= "Symptoms of your patient {$patient_name} are severe. Please contatct your patient immediately\n Contact number of the patient is {$patient_phone}";

        mail($doc_email,$subject,$msg);

    }

    public function sendReminderMail($to){
        $content = "Hi! Please record your symptoms for today.";
        mail($to,"Reminder: Record your Symptoms", $content);
    }

    public function sendRecordClosedMail($to){
        $content = "The doctor assigned to you has closed your record. You will be contacted shortly.";
        mail($to,"Your Record is Closed", $content);
    }

    public function SendMailReport($doc_email,$patient_no,$patient_name){

        $subject="Regarding submission of PCR report of patient {$patient_no}";

        $msg= "Your patient {$patient_name} has submitted a PCR report, Please check that report";

        mail($doc_email,$subject,$msg);

    }
}
?>

