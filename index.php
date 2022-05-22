<?php
if(!isset($_REQUEST['action'])){
    $_REQUEST['action']=5;
}
switch ($_REQUEST['action']){
    case 5: //Afficher le menu
        $titrePage='test';
        require_once './Include/entete.inc.php';
        require_once './Include/pied.inc.php';
        break;
    case 30: //form praticien
        require'./formPRATICIEN.php';
        break;
    case 25: //form choixFamilleMed
        require'./formMEDICAMENT.php';
        break;
    case 200: //form choixmedicament
        require'./formChoixMed.php';
        break;
    case 201: //form infosmedicament
        require'./formInfosMed.php';
        break;
    case 20: //form rapport_visite
        require'./formRAPPORT_VISITE.php';
        break;
    case 15: //form visiteur
        require'./formVISITEUR.php';
        break;
} 

?>

