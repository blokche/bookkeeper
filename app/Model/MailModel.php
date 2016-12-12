<?php

namespace Model;

use W\Model\Model;

class MailModel extends Model {
    
    
    public function envoieMail($to,$message,$message_html,$object,
                               $username="",$username_sender="webforcelille2@gmail.com",$password="W3bforce",$from="webforcelille2@gmail.com",$smtp="smtp.gmail.com"){

        $retour=[];
        $mail = new \PHPMailer();

        
        $mail->isSMTP();                                            // Set mailer to use SMTP
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
        $mail->AltBody = $message;

        var_dump($mail->AltBody);

        if(!$mail->send()) {
            $retour['errors-mail']="Erreur une erreur inconnu s'est produite pendant l'envoie du mail, veuillez ré-essayér.";
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        else {
            $retour['message-mail']="Le mail a bien été envoyé, si vous le recevez pas veuillez verifier votre dossier de spam .";
        }

        return $retour;
    }

}