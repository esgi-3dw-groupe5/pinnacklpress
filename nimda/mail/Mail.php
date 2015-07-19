<?php

namespace nimda\mail;

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;


class Mail {
    
    protected $KDM;
    protected $fields = [];
    protected $where;


    public function sendMail($pseudo,$email,$type,$key=null){
        $app = new SophworkApp();
        $controller = $app->appController;
        $page = $controller->page;
        $KDM = $controller->KDM;
        
        $options = $KDM->create('pp_option');
        $options->findOptionName("sitename");
        $sitename = $options->getOptionValue()[0];
        
        $siteUrl = Sophwork::getUrl();
        
        ob_start(); // turn on output buffering
        
        if($type=='install') {
            $content = "<p>Bienvenue sur votre site</p><p>Vous confirmons la bonne configuration de celui-ci. Il est disponible &agrave; cette adresse :</p><p><a href='".$siteUrl."'>".$siteUrl."</a></p>";
            include(__DIR__ . '/../template/mail-install.tpl');
            $subject = "Bienvenue sur votre site ".$pseudo." !";
        }   
        elseif($type=='inscription') {
            $content="<p>Bienvenue sur ".$sitename."</p><p>Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur internet</p><p><a href='".$siteUrl."activation/".urlencode($pseudo)."/".urlencode($key)."/'>".$siteUrl."activation/".urlencode($pseudo)."/".urlencode($key)."/</a></p>";
            include(__DIR__ . '/../template/mail-inscription.tpl');
            $subject = "Bienvenue sur ".$sitename." ".$pseudo." !";
        }
            
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
        $message= $passage_ligne.$message_html.$passage_ligne;
        
        
        $options = $KDM->create('pp_option');
        $options->findOptionName("smtp_email");
        $smtpEmail = $options->getOptionValue()[0];
        
        $options = $KDM->create('pp_option');
        $options->findOptionName("smtp_host");
        $smtpHost = $options->getOptionValue()[0];
        
        $options = $KDM->create('pp_option');
        $options->findOptionName("smtp_auth");
        $smtpAuth = $options->getOptionValue()[0];
        
        if($auth =='true') {
            $options = $KDM->create('pp_option');
            $options->findOptionName("smtp_username");
            $smtpUsername = $options->getOptionValue()[0];
            
            $options = $KDM->create('pp_option');
            $options->findOptionName("smtp_password");
            $smtpPassword = $options->getOptionValue()[0];
            
            $options = $KDM->create('pp_option');
            $options->findOptionName("smtp_port");
            $smtpPort = $options->getOptionValue()[0];
            
        }
        
        
        require_once('PHPMailerAutoload.php');

        $mail = new \PHPMailer;

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $smtpHost;                    // Specify main and backup SMTP servers
        
        if($auth =='true') {
            $mail->SMTPAuth = $smtpAuth;                               // Enable SMTP authentication
            $mail->Username = $smtpUsername;                 // SMTP username
            $mail->Password = $smtpPassword;                           // SMTP password
            $mail->Port = $smtpPort;                                    // TCP port to connect to
        }

        $mail->From = $smtpEmail;
        $mail->FromName = $sitename;
        $mail->addAddress($email);     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = $message;

        if(!$mail->send()) {
             echo 'Message could not be sent.';
             echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
             echo 'Message has been sent';
        }
        
        
        if($type=='install'){
            Sophwork::redirect('install/settings');
        }
        elseif($type=='inscription') {
            $_SESSION['form']['error'][]="Vous êtes inscrits";
            Sophwork::redirectFromRef($_SESSION['form']['pp-referer']);
            exit;
        }
        
    }
    
    
    
}