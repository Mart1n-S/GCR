<?php require './choixMedicament.php'; ?>

<form name="formInformationsMedicament">
    <?php if (isset($_POST['listeMedicament'])) {

        $codeMedicamentInformation = $_POST['listeMedicament'];
        $resultatInformationsMedicament = getListeInformationsMedicament($codeMedicamentInformation);

        echo formInputText('nomMedicament1', 'titreLabel', 'NOM COMMERCIAL : ', 'nomMedicament', 'affichageInformation', $resultatInformationsMedicament['MED_NOM'], 15, TRUE, FALSE);
        echo formTextArea('compositionMedicament1', 'titreLabel', 'COMPOSITION : ', 'compositionMedicament', 255, 50, 5, 16, TRUE, $resultatInformationsMedicament['MED_COMPO']);
        echo formTextArea('effetsMedicament1', 'titreLabel', 'EFFETS : ', 'effetsMedicament', 255, 50, 5, 17, TRUE, $resultatInformationsMedicament['MED_EFFETS']);
        echo formTextArea('contreIndicationMedicament1', 'titreLabel', 'CONTRE INDIC : ', 'contreIndicationMedicament', 255, 50, 5, 18, TRUE, $resultatInformationsMedicament['MED_CONTREINDIC']);
        echo formInputText('nomLaboratoire1', 'titreLabel', 'LABORATOIRE : ', 'nomLaboratoire', 'affichageInformation', $resultatInformationsMedicament['LAB_NOM'], 19, TRUE, FALSE);
    }; ?>
</form>
</div>
<?php require_once './include/pied.inc.php'; ?>