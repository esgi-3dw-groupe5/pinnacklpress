<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once(__DIR__ . '/../sophwork/autoloader.php');

use sophwork\core\Sophwork;
use sophwork\app\app\SophworkApp;

use controller\controllers\core\Controllers;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

use controller\utils\Users;

use controller\form\Rule;

$app = new SophworkApp();
$appController = $app->appController;

$user = new Users();

// Récupération des variables nécessaires à l'activation
$action = $_GET['part'];
$pseudo = $_GET['log'];
$key = $_GET['key'];

$appController->KDM = new SophworkDM(Sophwork::getConfig());

$options = $appController->KDM->create('pp_option');

$options->findOptionName("sitename");
$sitename = $options->getOptionValue()[0];

$options->findOptionName("siteurl");
$siteUrl = $options->getOptionValue()[0];

if(!empty($action)&&(!empty($pseudo))&&(!empty($key))) {
    
    if($action=='acn') {
        $form=false;
        // Récupération de la clé correspondant au $pseudo dans la base de données
        $user = $appController->KDM->create('pp_user');
        $user->findUserPseudo($pseudo);

        if($user->getUserId()[0]!=null) {

            if($key == $user->getUserKey()[0]) {

                $keybdd = $user->getUserKey()[0];	// Récupération de la clé
                $active = $user->getUserActive()[0]; // $active contiendra alors 0 ou 1

                // On teste la valeur de la variable $active récupéré dans la BDD
                if($active == '1') { // Si le compte est déjà actif on prévient

                    $message = "Votre compte est d&eacute;j&agrave; actif !";
                }
                else { // Si ce n'est pas le cas on passe aux comparaisons

                    if($key == $keybdd) { // On compare nos deux clés	

                        // Si elles correspondent on active le compte !	
                        $message = "Votre compte a bien &eacute;t&eacute; activ&eacute; !";

                        // La requête qui va passer notre champ actif de 0 à 1
                        $user->setUserActive('1');
                        $user->setUserRole('member');
                        $user->save();
                    }
                    else { // Si les deux clés sont différentes on provoque une erreur...

                        $message = "Erreur ! Votre compte ne peut &ecirc;tre activ&eacute;...";
                    }
                }
            }



        }
        else { // Si les deux clés sont différentes on provoque une erreur...

            $message = "Erreur ! Votre compte ne peut &ecirc;tre activ&eacute;...";
        }
        
    }
    
    
    elseif ($action=='pwd') {
        // Récupération de la clé correspondant au $pseudo dans la base de données
        $user = $appController->KDM->create('pp_user');
        $user->findUserPseudo($pseudo);

        if($user->getUserId()[0]!=null) {

            if($key == $user->getUserKey()[0]) {
                
                if(isset($_POST['submit'])) {
                    if(isset($_POST['password'])&&isset($_POST['confirm-password'])) {
                        $rule = new Rule();
                        if($rule->isPassword($_POST['password'],$_POST['confirm-password'])) {
                            $hash_psw = password_hash($_POST['password'], PASSWORD_DEFAULT);
                            $userkey = md5(microtime().rand());

                            $user->setUserPassword($hash_psw);
                            $user->setUserKey($userkey);
                            $user->save();
                            
                            $message = "Votre mot de passe a bien &eacute;t&eacute; modifi&eacute; !";
                            $form = false;
                        }
                        else{
                            $message = "Les mots de passe doivent &ecirc;tre identiques, comporter 8 &agrave; 20 caract&egrave;res avec au moins un chiffre";
                            $form = true;
                        }
                    }
                }
                else {
                    $message = "Veuillez modifier votre mot de passe";
                    $form = true;
                }
                
            }
            else { // Si les deux clés sont différentes on provoque une erreur...

                $message = "Ce lien n'est plus valide";
                $form = false;
            }
        }
        
        else { // Si les deux clés sont différentes on provoque une erreur...

            $message = "Ce lien n'est plus valide";
            $form = false;
        }
    }
}
else
{
    Sophwork::redirect();
}
require_once(__DIR__ . '/mail-confirm.tpl');


?>
