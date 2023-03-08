<?php
require_once './include/entete2.inc.php';
require_once './include/sourceDonnees.inc.php';
require_once './include/bibliotheque01.inc.php';
require_once './include/securite.inc.php';

if (!(isset($_POST["identifiant"]))) {
    $_POST["identifiant"] = "";
}

?>
<div class="containerFormulaireIdentification">
    <fieldset>
        <legend>Identifiez-vous</legend>
        <form name="formIdentification" id="formIdentification1" method="post">
            <?php
            echo formInputText('identifiant1', 'titreLabel', 'Utilisateur', 'identifiant', 'entreeIdentifiant', $_POST["identifiant"], 2, FALSE, TRUE);
            ?>
            <div class="containerMdpBtn">
                <?php
                echo formInputPassword('motDePasse1', 'titreLabel', 'Mot de passe', 'motDePasse', 'entreeMotDePasse', '', 30, 3, TRUE);
                echo formBoutonSubmit('boutonSubmit', 'boutonSubmit3', 'Valider', 4, FALSE); ?>
            </div>
            <?php
            // // permet de vérifier que les informations ont bien été envoyer avec la méthode post
            // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //     if (isset($_POST['boutonSubmit'])) {
            //         if (validationInformationsCompteUtilisateur($_POST["identifiant"], $_POST["motDePasse"])) {
            //             ouvreSessionUtilisateur($_POST["identifiant"]);
            //             header("Location: index.php?action=5");
            //             exit();
            //         } else {
            //             echo '<p class="erreur">Utilisateur et/ou mot de passe invalide(s)</p>';
            //         }
            //     }
            // } else {
            //     header("Location: ");
            //     exit();
            // } 

            // on vérifie si le formulaire à bien été soumis
            if (isset($_POST['boutonSubmit'])) {
                if (validationInformationsCompteUtilisateur($_POST["identifiant"], $_POST["motDePasse"])) {
                    ouvreSessionUtilisateur($_POST["identifiant"]);
                    header("Location: index.php?action=5");
                    exit();
                } else {
                    echo '<p class="erreur">Utilisateur et/ou mot de passe invalide(s)</p>';
                }
            }
            ?>
        </form>
    </fieldset>
</div>