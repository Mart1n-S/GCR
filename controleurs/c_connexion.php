<?php
if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];

$erreur = '';
$_POST['identifiant'] = '';
switch ($action) {
	case 'demandeConnexion': {
			include("vues/v_entete2.php");
			include("vues/v_identification.php");
			include("vues/v_pied.php");
			break;
		}
	case 'valideConnexion': {
			$login = $_REQUEST['identifiant'];
			$mdp = $_REQUEST['motDePasse'];
			if (validationInformationsCompteUtilisateur($login, $mdp)) {
				ouvreSessionUtilisateur($login);
				include("vues/v_entete.php");
				include("vues/v_pied.php");
			} else {
				$erreur = '<p class="erreur">Utilisateur et/ou mot de passe invalide(s)</p>';
				$login = $_REQUEST['identifiant'];
				include("vues/v_entete2.php");
				include("vues/v_identification.php");
				include("vues/v_pied.php");
			}
			break;
		}

	case 'deconnexion': {
			// Code ajouté par moi. Sans cela les informations de sessions
			// ne sont pas supprimées lors d'une déconnexion.
			fermeSessionUtilisateur();
			include("vues/v_entete2.php");
			include("vues/v_identification.php");
			include("vues/v_pied.php");
			break;
		}

	default: {
			include("vues/v_entete2.php");
			include("vues/v_identification.php");
			include("vues/v_pied.php");
			break;
		}
}
