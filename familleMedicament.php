<?php
require_once './include/entete.inc.php';
require_once './include/sourceDonnees.inc.php';
require_once './include/bibliotheque01.inc.php';
$resultatListeFamilleMedicament = getListeFamilleMedicament();

?>
<div class="element">
    <h1>Pharmacopée</h1>

    <form name="formChoixFamille" method="post" action="./index.php?action=20">
        <?php
        if (isset($_REQUEST['listeFamilleMedicament'])) {
            $codeFamille = $_REQUEST['listeFamilleMedicament'];
        } else {
            $codeFamille = NULL;
        }

        echo formSelectDepuisRecordSet('listeFamilleMedicament1', 'Famille : ', 'listeFamilleMedicament', 10, $resultatListeFamilleMedicament, $codeFamille);
        echo formBoutonSubmit('boutonSubmit', 'boutonSubmit1', 'OK', 11, FALSE); ?>
    </form>
    <br></br>