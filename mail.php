<?php
//define the receiver of the email
$to = 'surabhiojha12@gmail.com';
//define the subject of the email
$subject = 'The Key '; 
//define the message to be sent. Each line should be separated with \n
$message = "Hello citizen this is your key \n\ndont share with anyone"; 
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: indiancitizenportal@india.com\r\nReply-To: indiancitizenportal@india.com";
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "Mail sent" : "Mail failed";
?>