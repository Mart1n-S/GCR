<?php
require_once './Include/entete.inc.php';
require_once './Include/SourceDonnees.inc.php';
require_once './Include/Bibliotheque01.inc.php';
$resultat = getlistePraticiens();

?>
<div class="bas">
<h1> Praticiens </h1>

<form name="formListeRecherche" method="post">
    
    <?php
    if (isset($_REQUEST['lstPrat'])) {
        $num = $_REQUEST['lstPrat'];
    } else {
        $num = 0;
    }
    
    echo formSelectDepuisRecordset('Praticien : ', 'lstPrat', 'listPraticien', $resultat, $num, 10);
    
    ?>
    <input type="submit" name="btnSubmit" id="btnSubmit" value="OK" tabindex="30" />
    </form><br></br>
    <form id = "formPraticien">
    
    <?php
    if (isset($_REQUEST['lstPrat'])) {

        $resultat = getPraticienInformations($num);
        $ligne = $resultat->fetch(PDO::FETCH_ASSOC);

        echo formInputText('titre', 'txtNom', 'NOM :', 50, 'ZONE', $ligne['PRA_NOM'], TRUE,FALSE);
        echo formInputText('titre', 'txtPrenom', 'PRENOM :', 50, 'ZONE', $ligne['PRA_PRENOM'], TRUE,FALSE);
        echo formInputText('titre', 'txtADR', 'ADRESSE :', 50, 'ZONE', $ligne['PRA_ADRESSE'], TRUE,FALSE);
        echo formInputText('titre', 'txtVILLe', 'VILLE :', 50, 'ZONE', $ligne['concat(PRA_CP,\' \',PRA_VILLE)'], TRUE,FALSE);
        echo formInputText('titre', 'txtCN', 'COEFF NOTORIETE :', 50, 'ZONE', $ligne['PRA_COEF'], TRUE,FALSE);
        echo formInputText('titre', 'txtLE', 'LIEU D\'EXERCICE :', 50, 'ZONE', $ligne['TYP_LIEU'],TRUE ,FALSE);
    }
    ?></form>

</div>
    <?php
    require_once'./Include/pied.inc.php';
    ?>