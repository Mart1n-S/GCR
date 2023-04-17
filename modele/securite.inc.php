<?php
// require_once './include/sourceDonnees.inc.php';

function validationInformationsCompteUtilisateur($codeUtilisateur, $motDePasseUtilisateur)
{
    $mdpHash = md5($motDePasseUtilisateur);

    if (existeCompteVisiteur($codeUtilisateur, $mdpHash)) {
        return True;
    } else {
        return False;
    }
}

function existeCompteVisiteur($codeUtilisateur, $mdp)
{
    $existance = FALSE;

    $sql = SGBDConnect()->prepare('SELECT VIS_CODE, VIS_PASSE 
    FROM visiteur
    WHERE VIS_CODE = :codeUtilisateur
    AND VIS_PASSE = :mdpVisiteur');
    $sql->bindParam(":codeUtilisateur", $codeUtilisateur, PDO::PARAM_STR);
    $sql->bindParam(":mdpVisiteur", $mdp, PDO::PARAM_STR);
    $sql->execute();

    $resultat = $sql->rowCount();

    if ($resultat == 1) {
        $existance = TRUE;
    }

    return $existance;
}

function ouvreSessionUtilisateur($idCodeUtilisateur)
{
    $_SESSION['idUser'] = $idCodeUtilisateur;
    $informationUser = getInformationsUtilisateur($idCodeUtilisateur);

    $_SESSION['nomUser'] = $informationUser['VIS_NOM'];
    $_SESSION['prenomUser'] = $informationUser['VIS_PRENOM'];
    if (isset($informationUser)) {
        switch ($informationUser['AFF_ROLE']) {
            case 1: // Afficher le formulaire d'identification
                $infoRole = 'Visiteur';
                $_SESSION['roleUser'] = $infoRole;
                break;
            case 2: // Afficher le formulaire d'identification
                $infoRole = 'Délégué régional';
                $_SESSION['roleUser'] = $infoRole;
                break;
            case 3: // Afficher le formulaire d'identification
                $infoRole = 'Responsable de secteur';
                $_SESSION['roleUser'] = $infoRole;
                break;
        }
    }
    // $_SESSION['roleUser'] = $informationUser['TRA_ROLE'];
    $_SESSION['regionUser'] = $informationUser['REG_NOM'];
}

function utilisateurConnecte()
{
    if (isset($_SESSION['idUser']) && $_SESSION['idUser'] !== '') {
        return TRUE;
    } else {
        return FALSE;
    }
}

function fermeSessionUtilisateur()
{
    session_destroy();
}
