<?php
require './formChoixMed.php';
?>

<form name="formInfosMed">
         <?php if (isset($_REQUEST['lstMed'])) {
             
              $resultat = getlisteInfos($_POST['lstMed']);
              $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
        echo formInputText('titre', 'txtNom', 'NOM COMMERCIAL : ', 50, 'ZONE', $ligne['MED_NOM'], TRUE, FALSE);             
        echo formTextArea('COMPOSITION : ', 'txtCompo', 'txtCompo', $ligne['MED_COMPO'], 50, 5, 200, 15, TRUE);
        echo formTextArea('EFFETS : ', 'txtEffets', 'txtEffets', $ligne['MED_EFFETS'], 50, 5, 200, 16, TRUE);
        echo formTextArea('CONTRE INDIC : ', 'txtCI', 'txtCI', $ligne['MED_CONTREINDIC'], 50, 5, 200, 17, TRUE);
        echo formInputText('titre', 'txtLab', 'LABORATOIRE : ', 50, 'ZONE', $ligne['LAB_NOM'], TRUE, FALSE);
                      
         };?>
    </form>
</div>
