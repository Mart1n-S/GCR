<?php
require './familleMedicament.php';
?>
<form name="formChoixMedicament" id="formChoixMedicament1" method="post" action="./index.php?action=25">

    <?php
    $resultatListeMedicament = getListeMedicament();
    if (isset($_REQUEST['listeMedicament'])) {
        $codeMedicament = $_REQUEST['listeMedicament'];
    } else {
        $codeMedicament  = NULL;
    }

    echo formSelectDepuisRecordSet('listeMedicament1', 'Médicament : ', 'listeMedicament', 12, $resultatListeMedicament, $codeMedicament);
    echo formBoutonSubmit('boutonSubmit', 'boutonSubmit2', 'OK', 13, FALSE);
    echo formInputHidden('hiddenCodeFamille1', 'listeFamilleMedicament', $codeFamille); ?>
</form><br></br>