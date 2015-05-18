<?php

namespace nimda\mail;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

class Mail {
    
    protected $KDM;
    protected $fields = [];
    protected $where;


    public fonction sendMail($pseudo,$email,$nameEmail,$cle){
        
        
        
        $content = $this->KDM->create('pp_mail');
        $content->findMailName($nameEmail);
        //TODO : SELECT mail_content WHERE mail_name = nameEmail
        $this->setViewData('mail-content', $content);
        
        ob_start(); // turn on output buffering
        include('template/mail.tpl');
        $res = ob_get_contents(); // get the contents of the output buffer
        ob_end_clean(); //  clean (erase) the output buffer and turn off output buffering
        
        $mail = $email; // Déclaration de l'adresse de destination.
        if (!preg_match("#^[a-z0-9._-]+@(gmail|hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
        {
            $passage_ligne = "\r\n";
        }
        else
        {
            $passage_ligne = "\n";
        }
        


        $message_html = $res;


        //=====Définition du sujet.
        $subject = $this->KDM->select('pp_mail',$where,'subject');
        //=========

        require_once('nimda/mail/PHPMailerAutoload.php');

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.pinnackl.com';                    // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'noreply@pinnackl.com';                 // SMTP username
        $mail->Password = 'Icge0ylb!';                           // SMTP password
        // $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->From = 'noreply@pinnackl.com';
        $mail->FromName = 'Pinnackl.com';
        $mail->addAddress($email);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('pinnackl.work@gmail.com', 'Information');
        // $mail->addCC('pinnackl.work@gmail.com');
        // $mail->addBCC('bcc@example.com');

        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

              
        $message= $passage_ligne.$message_html.$passage_ligne;

        $mail->Subject = $sujet;
        $mail->Body    = $message;
        $mail->AltBody = $message;

        if(!$mail->send()) {
            // echo 'Message could not be sent.';
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            // echo 'Message has been sent';
        }
    }
    
    
    
}