<?php

// // the message
// $msg = "First line of text\nSecond line of text";

// // use wordwrap() if lines are longer than 70 characters
// $msg = wordwrap($msg,70);

// send email


 
if (mail("prathushan21@gmail.com","My subject","hello")) {
    echo "Email successfully sent to ...";
} else {
    echo "Email sending failed...";
}
?>