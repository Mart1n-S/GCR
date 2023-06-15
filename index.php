<?php
session_start();
require_once 'modele/securite.inc.php';
require_once 'modele/bibliotheque01.inc.php';
require_once 'modele/sourceDonnees.inc.php';

// on vérifie toujours si la demande viens d'un utilisateur connecté
// si l'utilisateur n'est pas connecté ou que $_REQUEST['action'] n'est pas définie
if (!isset($_REQUEST['uc']) || !utilisateurConnecte()) {
    $_REQUEST['uc'] = 'connexion';
}

switch ($_REQUEST['uc']) {
    case 'connexion': // appel controleur pour afficher le formulaire d'identification
        include("controleurs/c_connexion.php");
        break;
    case 'praticien': // appel controleur pour afficher liste déroulante de tous les praticiens
        include("controleurs/c_praticien.php");
        break;
    case 'medicament': // appel controleur pour afficher liste déroulante des familles de medicament
        include("controleurs/c_medicament.php");
        break;
    case 'rapportVisite': // appel controleur pour afficher le formulaire du compte rendu visite
        include("controleurs/c_compteRendu.php");
        break;
    case 'accueil': // affiche l'accueil
        if (utilisateurConnecte()) {
            include("vues/v_entete.php");
            include("vues/v_pied.php");
        } else {
            include("vues/v_entete2.php");
            include("vues/v_identification.php");
            include("vues/v_pied.php");
        }
        break;
    default: // si action n'existe pas ou n'est pas définie 
        // on vérifie si l'utilisateur est connecté et on le renvoie sur le menu (pas utile de verifier s'il est connecté car si on est dans le switch la vérification a déja été faite)
        if (utilisateurConnecte()) {
            header('Location: index.php?uc=connexion&action=valideConnexion');
            exit();
        } else {
            include("controleurs/c_connexion.php");
        }
        break;
}
