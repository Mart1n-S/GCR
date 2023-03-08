<?php
require_once './include/entete.inc.php';
require_once './include/sourceDonnees.inc.php';
require_once './include/bibliotheque01.inc.php';
$resultatListePraticien = getListePraticiens();
?>
<div class="element">
    <h1>Praticiens</h1>

    <form name="formListeRecherche" method="post">

        <?php
        if (isset($_REQUEST['listePraticien'])) {
            $numPraticien = $_REQUEST['listePraticien'];
        } else {
            $numPraticien = 0;
        }

        echo formSelectDepuisRecordSet('listePraticien1', 'Praticien : ', 'listePraticien', 10, $resultatListePraticien, $numPraticien);
        echo formBoutonSubmit('boutonSubmit', 'boutonSubmit1', 'OK', 11, FALSE); ?>

    </form><br></br>
    <form id="formPraticien">

        <?php
        if (isset($_REQUEST['listePraticien'])) {

            $resultatInformationsPraticien = getPraticienInformations($numPraticien);

            echo formInputText('nomPraticien1', 'titreLabel', 'NOM :', 'nomPraticien', 'affichageInformation', $resultatInformationsPraticien['PRA_NOM'], 12, TRUE, FALSE);
            echo formInputText('prenomPraticien1', 'titreLabel', 'PRENOM :', 'prenomPraticien', 'affichageInformation', $resultatInformationsPraticien['PRA_PRENOM'], 13, TRUE, FALSE);
            echo formInputText('adressePraticien1', 'titreLabel', 'ADRESSE :', 'adressePraticien', 'affichageInformation', $resultatInformationsPraticien['PRA_ADRESSE'], 14, TRUE, FALSE);
            echo formInputText('villePraticien1', 'titreLabel', 'VILLE :', 'villePraticien', 'affichageInformation', $resultatInformationsPraticien['concat(PRA_CP,\' \',PRA_VILLE)'], 15, TRUE, FALSE);
            echo formInputText('coefficientNotoriete1', 'titreLabel', 'COEFF NOTORIETE :', 'coefficientNotoriete', 'affichageInformation', $resultatInformationsPraticien['PRA_COEF'], 16, TRUE, FALSE);
            echo formInputText('lieuExercice1', 'titreLabel', 'LIEU D\'EXERCICE :', 'lieuExercice', 'affichageInformation', $resultatInformationsPraticien['TYP_LIEU'], 17, TRUE, FALSE);
        } ?>
    </form>

</div>
<?php require_once './Include/pied.inc.php'; ?>