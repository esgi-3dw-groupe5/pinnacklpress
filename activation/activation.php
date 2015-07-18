<?php
if(!isset($source)) $source = $_SERVER['DOCUMENT_ROOT']."/";
require_once($source."/model/dbconnect.php");
require_once($source."controller/accessControl.php");


$db=db_connect();
// Récupération des variables nécessaires à l'activation
$pseudo = $_GET['log'];
$cle = $_GET['cle'];

if(!empty($pseudo)&&(!empty($cle)))
{
    // Récupération de la clé correspondant au $pseudo dans la base de données
    $req = $db->prepare("SELECT cle,actif FROM pp_users WHERE pseudo like :pseudo ");
    if($req->execute(array(':pseudo' => $pseudo)) && $row = $req->fetch())
    {
        $clebdd = $row['cle'];	// Récupération de la clé
        $actif = $row['actif']; // $actif contiendra alors 0 ou 1





        // On teste la valeur de la variable $actif récupéré dans la BDD
        if($actif == '1') // Si le compte est déjà actif on prévient
        {
            $message = "Votre compte est d&eacute;j&agrave; actif !";
        }
        else // Si ce n'est pas le cas on passe aux comparaisons
        {
            if($cle == $clebdd) // On compare nos deux clés	
            {
                // Si elles correspondent on active le compte !	
                $message = "Votre compte a bien &eacute;t&eacute; activ&eacute; !";

                // La requête qui va passer notre champ actif de 0 à 1
                $req = $db->prepare("UPDATE pp_users SET actif = 1 WHERE pseudo like :pseudo ");
                $req->bindParam(':pseudo', $pseudo);
                $req->execute();
            }
            else // Si les deux clés sont différentes on provoque une erreur...
            {
                $message = "Erreur ! Votre compte ne peut &ecirc;tre activ&eacute;...";
            }
        }



    }
    else // Si les deux clés sont différentes on provoque une erreur...
    {
        $message = "Erreur ! Votre compte ne peut &ecirc;tre activ&eacute;...";
    }
}
else
{
    redirect();
}


require_once($source."template/confirmail.tpl");

?>
