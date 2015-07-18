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

$app = new SophworkApp();
$appController = $app->appController;

$user = new Users();

// Récupération des variables nécessaires à l'activation
$pseudo = $_GET['log'];
$key = $_GET['cle'];

if(!empty($pseudo)&&(!empty($key))) {
    
    // Récupération de la clé correspondant au $pseudo dans la base de données
    $appController->KDM = new SophworkDM(Sophwork::getConfig());
    $user = $appController->KDM->create('pp_user');
    $user->findUserPseudo($pseudo);
    
    if($user->getUserId()[0]!=null) {
        
        if($key == $user->getUserKey()[0]) {
        
            $keybdd = $user->getUserKey()[0];	// Récupération de la clé
            $active = $user->getUserActive()[0]; // $active contiendra alors 0 ou 1

            // On teste la valeur de la variable $active récupéré dans la BDD
            if($active == '1') { // Si le compte est déjà actif on prévient
            
                Sophwork::redirect();
            }
            else { // Si ce n'est pas le cas on passe aux comparaisons
            
                if($key == $keybdd) { // On compare nos deux clés	
                
                    // Si elles correspondent on active le compte !	
                    $message = "Votre compte a bien &eacute;t&eacute; activ&eacute; !";

                    // La requête qui va passer notre champ actif de 0 à 1
                    $user->setUserActive('1');
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
else
{
    Sophwork::redirect();
}


require_once(__DIR__ . '/../template/mail/mail-confirm.tpl');

?>
