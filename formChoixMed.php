<?php
require './formMEDICAMENT.php';
?>
 <form name="formChoixMedicament" method="post" action="./index.php?action=201" >
    
    <?php   
    $resultat= getlisteMed();
    if (isset($_REQUEST['lstMed'])) {
        $num = $_REQUEST['lstMed'];
    } else {
        $num = 0;
    }
        echo formSelectDepuisRecordset('Médicament : ', 'lstMed', 'lstMed', $resultat, $num, 12);
        echo formBoutonSubmit('btnSubmit', 'btnSubmit', 'OK', 13);
        echo formInputHidden('hidFamMed', 'hidFamMed', 'lstFam');
        
    
    ?>
        
    </form><br></br>

