
<?php

require("class.phpmailer.php");
require("class.smtp.php");

function mailSend($toemail, $name, $subject, $msg){

  $mail = new PHPMailer();

  $mail->IsSMTP();                                      // set mailer to

  $mail->Host = "smtp.dondominio.com";  // specify main and backup server
  $mail->SMTPAuth = true;     // turn on SMTP authentication
  $mail->Username = "";  // SMTP username
  $mail->Password = ""; // SMTP password

  $mail->From = "contacto@somosindia.cl";
  $mail->FromName = "";        // remitente
  $mail->AddAddress($toemail, $name);        // destinatario

  //$mail->AddReplyTo("tu-correo@tu-nombre-de-dominio.com", "respuesta a");    // responder a

  $mail->WordWrap = 50;     // set word wrap to 50 characters
  $mail->IsHTML(true);     // set email

  $mail->Subject = $subject;
  $mail->Body    = $msg;
  $mail->AltBody = "Somos India"; //no imprime...

  if(!$mail->Send())
  {
     //echo "Message could not be sent.\n";
     //echo "Mailer Error: " . $mail->ErrorInfo."\n";
     echo "false";
     // exit;
  }

  //echo "Succes Mail\n";
  echo "true";

}

?>
