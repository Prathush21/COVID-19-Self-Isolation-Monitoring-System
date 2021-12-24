<?php

class Mail{

    public function sendMail($doc_email,$patient_no,$patient_name,$patient_phone){

        $subject="Regarding severity of patient {$patient_no}";

        $msg= "Symptoms of your patient {$patient_name} are severe. Please contatct your patient immediately\n Contact number of the patient is {$patient_phone}";

        mail($doc_email,$subject,$msg);

    }
}

// // the message
// $msg = "First line of text\nSecond line of text";

// // use wordwrap() if lines are longer than 70 characters
// $msg = wordwrap($msg,70);

// // send email


 
// if (mail("190197p@gmail.com","My subject",$msg)) {
//     echo "Email successfully sent to ...";
// } else {
//     echo "Email sending failed...";
// }
?>