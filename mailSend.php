<?php
	$nombreUser = $_POST['name'];   
	$emailUser = $_POST['email'];	
	$messageUser = $_POST['message'];  
	require 'smtp/PHPMailerAutoload.php';
	date_default_timezone_set('America/Bogota');
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 2;
	$mail->Debugoutput = 'html';
	$mail->Host = "mail.navesoft.com"; // Nombre Servidor SMTP a utilizar
	$mail->Port = 2525;//asignar puerto SMTP 	
	$mail->SMTPAuth = true;
	$mail->Username = "info@intermodal.com.co";//correo que enviara el mail
	$mail->Password = "Navesoft0580"; //password correo que enviara el mail    
	$mail->setFrom($emailUser, 'Intermodal');
	//Cambio de correo que recibe las notificaciones
    $mail->addAddress('notificaciones@intermodal.com.co', 'notificaciones@intermodal.com.co');
	$mail->addAddress('shidalgo@navesoft.com', 'shidalgo@navesoft.com');
    //correo de destino y nombre de destinatario bog.sales@aircanada.ca
    $mail->Subject = 'Formulario Contacto Intermodal';
	$mail->msgHTML('<!DOCTYPE html><html lang="ES"><head> <meta charset="UTF-8"><meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <meta name="description" content=""> <meta name="author" content=""> <title>Bienvenido</title> <link rel="shortcut icon" href=""> <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> 
	<style> body { padding-top: 50px; } .starter-template { padding: 40px 15px; text-align: center; } </style></head>
	<style> .cotnent-campos { width: 100%; max-width: 400px; margin: 0px auto; } input[type="text"] { width: 100%; height: 30px; padding: 5px 15px; } .w100 { width: 100%; text-align: left; padding-top: 6px; padding-bottom: 6px; margin: 0px auto; border-radius: 5px; } .w100 a { color: darkblue; text-align: left; }</style><body> <div class="container"> <div class="starter-template"> <br> 
	<br> <h3>FORMULARIO CONTACTO INTERMODAL</h3> 
	<p class="lead">Datos del usuario:</p> </div> 
	<div class="cotnent-campos">  
	<p>Nombre: '.$nombreUser.'</p> 
	<p>Correo Electronico : '.$emailUser.'</p> 
	<p>Mensaje : '.$messageUser.'</p><br><hr><br> 
	</div></div>
	<div class="footer"> </div></body></html>');
	$mail->AltBody = 'Gracias por escribir a Intermodal';
	
	if (!$mail->send()) {
	    echo "Mailer Error: ".$mail->ErrorInfo;
	} else {
	    echo "Message sent! Usuario";
	}
?>
