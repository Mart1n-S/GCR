<?php
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'listePraticien';
}
$action = $_REQUEST['action'];

switch ($action) {
        // on affiche la liste déroulante pour choisir un praticien
    case 'listePraticien': {
            $resultatListePraticien = getListePraticiens();
            include("vues/v_entete.php");
            include("vues/v_praticien.php");
            include("vues/v_pied.php");
            break;
        }
        // on affiche les informations du praticien
    case 'infosPraticien': {
            $resultatListePraticien = getListePraticiens();
            $resultatInformationsPraticien = getPraticienInformations($_REQUEST['listePraticien']);
            include("vues/v_entete.php");
            include("vues/v_praticien.php");
            include("vues/v_pied.php");
            break;
        }
}
