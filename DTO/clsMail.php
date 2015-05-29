<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clsMail
 *
 * @author tokaai
 */

 require 'PHPMailer/PHPMailerAutoload.php';	
 
class clsMail {    
    function __construct($email, $subject, $message, $headerSubject) {	
		
		$mail = new PHPMailer;
		$mail->isSMTP();      
		$mail->Host = ''; 
		$mail->SMTPAuth = true;                              
		$mail->Username = '';
		$mail->Password = '';
		$mail->SMTPSecure = 'tls';                           
		$mail->Port = 587; 
		
		$mail->From = '';
		$mail->FromName = 'Dragon Agent CV';
		$mail->addAddress($email, $headerSubject); 

		$mail->isHTML(true); 

		$mail->Subject = $subject;
		$mail->Body    = $message;
		$mail->AltBody = 'Your email cannot support mail from dragon agent';
		
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
}
