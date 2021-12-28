
<?php
class Mail{
    private $headers;

    public function __construct(){
        // $this->headers = "From: 190197p@gmail.com";
    }

    public function sendReminderMail($to){
        $content = "Hi! Please record your symptoms for today.";
        mail($to,"Reminder: Record your Symptoms", $content);
    }

    public function sendRecordClosedMail($to){
        $content = "The doctor assigned to you has closed your record. You will be contacted shortly.";
        mail($to,"Your Record is Closed", $content);
    }
}
?>
