<?php

namespace Model;

use W\Model\Model;

class MailModel extends Model {
    
    
    public function envoieMail($to,$msg,$message_html,$object,
                               $username="",$username_sender="webforcelille2@gmail.com",$password="W3bforce",$from="webforcelille2@gmail.com",$smtp="smtp.gmail.com"){

        $mail = new \PHPMailer();

        
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->CharSet = 'UTF-8';
        $mail->Host = $smtp;                                        // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                 // Enable SMTP authentication
        $mail->Username = $username_sender;                                // SMTP username
        $mail->Password = $password;                            // SMTP password
        $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                      // TCP port to connect to

        $mail->setFrom($from,'BookKeeper');
        $mail->addReplyTo($from,'BookKeeper');

        $mail->addAddress($to, $username);                      // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Body = $message_html;

        $mail->Subject = $object;
        $mail->AltBody = $msg;

        //var_dump($mail->AltBody);

        if(!$mail->send()) {
            $message= ['type' => 'warning', 'message' => "Une erreur inconnu s'est produite pendant l'envoie du mail, veuillez ré-essayér."];
        }
        else
        {
            $message = ['type' => 'success', 'message' => "Le mail a bien été envoyé, si vous le recevez pas veuillez verifier votre dossier de spam ."];
        }

        return $message;
    }

}