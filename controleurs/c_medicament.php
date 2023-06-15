<?php
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'listeFamilleMedicament';
}
$action = $_REQUEST['action'];

switch ($action) {
        // on affiche la liste déroulante pour choisir une famille de médicament
    case 'listeFamilleMedicament': {
            $resultatListeFamilleMedicament = getListeFamilleMedicament();
            include("vues/v_entete.php");
            include("vues/v_choixFamilleMedicament.php");
            include("vues/v_pied.php");
            break;
        }
        // on affiche la liste déroulante pour choisir un médicament
    case 'listeMedicament': {
            $resultatListeFamilleMedicament = getListeFamilleMedicament();
            $resultatListeMedicament = getListeMedicament();
            include("vues/v_entete.php");
            include("vues/v_choixFamilleMedicament.php");
            include("vues/v_choixMedicament.php");
            include("vues/v_pied.php");
            break;
        }
        // on affiche les informations du médicament
    case 'infosMedicament': {
            $codeMedicamentInformation = $_POST['listeMedicament'];
            $resultatListeFamilleMedicament = getListeFamilleMedicament();
            $resultatListeMedicament = getListeMedicament();
            $resultatInformationsMedicament = getListeInformationsMedicament($codeMedicamentInformation);
            include("vues/v_entete.php");
            include("vues/v_choixFamilleMedicament.php");
            include("vues/v_choixMedicament.php");
            include("vues/v_infosMedicament.php");
            include("vues/v_pied.php");
            break;
        }
}
