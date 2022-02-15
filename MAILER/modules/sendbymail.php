
<?php

require("class.phpmailer.php");
require("class.smtp.php");

function mailSend($toemail, $name, $subject, $msg){

  $mail = new PHPMailer();

  $mail->IsSMTP();                                      // set mailer to

  $mail->Host = "smtp.example.com";  // specify main and backup server
  $mail->SMTPAuth = true;     // turn on SMTP authentication
  $mail->Username = "email@example.com";  // SMTP username
  $mail->Password = ""; // SMTP password

  $mail->From = "email@example.com";
  $mail->FromName = "From Name";        // remitente
  $mail->AddAddress($toemail, $name);        // destinatario

  //$mail->AddReplyTo("tu-correo@tu-nombre-de-dominio.com", "respuesta a");    // responder a

  $mail->WordWrap = 50;     // set word wrap to 50 characters
  $mail->IsHTML(true);     // set email

  $mail->Subject = $subject;
  $mail->Body    = $msg;
  $mail->AltBody = "Alt Body"; //no imprime...

  if(!$mail->Send()){
    return false;
  }else{
    return true;
  }

}

?>
