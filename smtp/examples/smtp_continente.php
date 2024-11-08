<h1>hola </h1>
<?php
require '../PHPMailerAutoload.php';
date_default_timezone_set('America/Bogota');



					//Create a new PHPMailer instance
					$mail = new PHPMailer;
					//Tell PHPMailer to use SMTP
					$mail->isSMTP();
					$mail->SMTPDebug = 2;
					//Ask for HTML-friendly debug output
					$mail->Debugoutput = 'html';
					//Set the hostname of the mail server
					$mail->Host = "smtp.une.net.co";
					//Set the SMTP port number - likely to be 25, 465 or 587
					$mail->Port = 25;
					//Whether to use SMTP authentication
					$mail->SMTPAuth = true;
					//$mail->SMTPSecure = 'tls';
					//Username to use for SMTP authentication
					$mail->Username = "continente11@une.net.co";
					$mail->Password = "webmaster2015";

					$mail->setFrom('no-reply@continente.com.co', 'Continente.S.A - www.continente.com.co');
					$mail->addAddress('estebanbacl@gmail.com', 'Esteban Bautista');

					$mail->Subject = 'Bienvenido a Continente S.A.';
					$mail->msgHTML('<!DOCTYPE html><h1>HOLAHOLAHOLA -- HOLA</h1></html>');
					$mail->AltBody = 'Gracias por escribir a Continente S.A';

					//send the message, check for errors
					if (!$mail->send()) {
					    echo "Mailer Error: ".$mail->ErrorInfo;
					} else {
					    echo "Message sent! Usuario";
					}
?>