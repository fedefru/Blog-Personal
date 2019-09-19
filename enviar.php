<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

//Habilitar en gmail el "Acceso de aplicaciones poco seguras"
//	https://myaccount.google.com/lesssecureapps

// seteo el timezone correcto
date_default_timezone_set('America/Argentina/Buenos_Aires');

$nombre=$_POST["name"];
$correo=$_POST["email"];;
$mensaje=$_POST["message"];
$contenido="Nombre: ".$nombre."\nCorreo: ".$correo."\nMensaje: ".$mensaje;


//incluyo la libreria
require 'vendor/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

// use
$mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
//$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "fru.federico@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "federicofrutos";

//Set who the message is to be sent from
$mail->setFrom('fru.federico@gmail.com', utf8_decode('Frutos Federico'));

//Set an alternative reply-to address
#$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress($correo);

//Set the subject line
$mail->Subject = utf8_decode('Email Web');

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->MsgHTML(utf8_decode($contenido));

//Replace the plain text body with one created manually
$mail->AltBody = 'Este es un cuerpo de mensaje de texto sin formato';

//Attach an image file 
#$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if(!$mail->send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}else{
	echo "Mensaje enviado!";
}
?>

<br><br>
<button onclick="location.href='index.html'">Regresar</button>