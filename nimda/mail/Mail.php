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
            $content = "<p>Bienvenue sur votre site</p><p>Nous vous confirmons la bonne configuration de celui-ci. Il est disponible &agrave; cette adresse :</p><p><a href='".$siteUrl."'>".$siteUrl."</a></p>";
            $subject = "Bienvenue sur votre site ".$pseudo." !";
        }   
        elseif($type=='inscription') {
            $content="<p>Bienvenue sur ".$sitename."</p><p>Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur internet</p><p><a href='".$siteUrl."activation/acn/".urlencode($pseudo)."/".urlencode($key)."/'>".$siteUrl."activation/acn/".urlencode($pseudo)."/".urlencode($key)."/</a></p>";
            $subject = "Bienvenue sur ".$sitename." ".$pseudo." !";
        }
        elseif($type=='recovery') {
            $content="<p>Bienvenue sur ".$sitename."</p><p>Pour modifier votre mot de passe, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur internet</p><p><a href='".$siteUrl."activation/pwd/".urlencode($pseudo)."/".urlencode($key)."/'>".$siteUrl."activation/pwd/".urlencode($pseudo)."/".urlencode($key)."/</a></p>";
            $subject = "".$pseudo.", votre nouveau mot de passe sur ".$sitename."  !";
        }
        elseif($type=='test') {
            $content = "<p>".$sitename."</p><p>".$pseudo.", le site est bien configuré. Il est disponible &agrave; cette adresse :</p><p><a href='".$siteUrl."'>".$siteUrl."</a></p>";
            $subject = "Test de configuration de ".$sitename." !";
        }
        
        include(__DIR__ . '/../template/mail.tpl');
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
        
        if($smtpAuth =='true') {
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
        
        if($smtpAuth =='true') {
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
            $_SESSION['form']['error'][]="Vous êtes inscrits. Vous allez recevoir un mail d'activation de compte.";
            Sophwork::redirectFromRef($_SESSION['form']['pp-referer']);
            exit;
        }
        elseif($type=='recovery') {
            $_SESSION['form']['error'][]="Vous allez recevoir un mail pour changer de mot de passe.";
            Sophwork::redirectFromRef($_SESSION['form']['pp-referer']);
            exit;
        }
        
    }
    
    
    
}