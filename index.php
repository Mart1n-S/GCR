<?php
require_once './include/securite.inc.php';

// on vérifie toujours si la demande viens d'un utilisateur connecté
// si l'utilisateur n'est pas connecté et que $_REQUEST['action'] n'est pas définie
if (!utilisateurConnecte() && !isset($_REQUEST['action'])) {
    // alors on initalise 
    $_REQUEST['action'] = 1;
} elseif (!utilisateurConnecte() && $_REQUEST['action'] != 1) {
    // si si l'utilisateur n'est pas connecté et qu'il essaie de se rendre sur un page on le redirige sur le formulaire de connexion
    header('Location: index.php?action=1');
    exit();
}
switch ($_REQUEST['action']) {
    case 1: // Afficher le formulaire d'identification
        require_once './identification.php';
        break;
    case 5: // Afficher le menu
        require_once './include/entete.inc.php';
        require_once './include/pied.inc.php';
        break;
    case 10: // Form contre rendu visite
        require_once './formCR_VISITE.php';
        break;
    case 11: // Form contre rendu visite
        require_once './recapitulatifCR.php';
        break;
    case 15: // affiche liste déroulante des familles des médicaments
        require_once './familleMedicament.php';
        break;
    case 20: // affiche liste déroulante de tous les médicaments de la famille séléctionné
        require_once './choixMedicament.php';
        break;
    case 25: // affiche les informations du médicament
        require_once './informationsMedicament.php';
        break;
    case 30: // affiche liste déroulante de tous les praticiens
        require_once './praticien.php';
        break;
    case 35: // Form visiteur
        require_once './visiteur.php';
        break;

    case 40: // Form visiteur
        fermeSessionUtilisateur();
        // require_once './identification.php';
        // break;
        header('Location: index.php?action=1');
        exit();
    default: // si action n'existe pas ou n'est pas définie 
        // on vérifie si l'utilisateur est connecté et on le renvoie sur le menu (pas utile de verifier s'il est connecté car si on est dans le switch la vérification a déja été faite)
        if (utilisateurConnecte()) {
            header('Location: index.php?action=5');
            exit();
        } else {
            require_once './identification.php';
        }
        break;
}
