<?php
$jsFichier = 'crVisite.js';
require_once './Include/entete.inc.php';
require_once './Include/Bibliotheque01.inc.php';
require_once './Include/SourceDonnees.inc.php';
?>
<div id="bas">
    <h1>Nouveau compte-rendu de visite</h1>
    <form name="frmCompteRenduVisite" method="post" action="recupRAPPORT_VISITE.php">
        <?php
        $indexTabulation = 10;
        $laListe = getListePraticiensTab();
        $lesMotifsVisite = [[1, 'Périodicité'],
            [2, 'Nouveauté/actualisation'],
            [3, 'Relance (remontage)'],
            [4, 'Sollicitation du praticien'],
            [5, 'Autre']];

        echo formInputText('DATE VISITE : ', 'txtDateVisite', 'txtDateVisite', '', 12, 10, $indexTabulation, FALSE, TRUE) . '<br />';
//        echo formSelectDepuisRecordset('PRATICIEN : ', 'lstPrat', 'lstPrat', $laListe, '', $indexTabulation += 10);
        echo formSelectDepuisTab2D('PRATICIEN : ', 'lstPrat', 'lstPrat', $laListe, '', $indexTabulation += 10, FALSE);
        echo formInputCheckBox(TRUE, 'REMPLA&Ccedil;ANT', 'chkRemplacant', 'chkRemplacant', FALSE, $indexTabulation += 10, FALSE);

//        echo formSelectDepuisRecordset('', 'lstRemplacant', 'lstRemplacant', $laListe, '', $indexTabulation += 10) . '<br />';
        echo formSelectDepuisTab2D('', 'lstRemplacant', 'lstRemplacant', $laListe, '', $indexTabulation += 10, TRUE) . '<br />';
        echo formInputNumber('COEFFICIENT DE CONFIANCE : ', 'numCoeffConfiance', 'numCoeffConfiance', '50', '0', '100', '0.5', $indexTabulation += 10, FALSE, TRUE) . '<br />';
        echo formSelectDepuisTab2D('MOTIF : ', 'lstMotif', 'lstMotif', $lesMotifsVisite, 1, $indexTabulation += 10);
        echo formInputText('', 'txtMotifExplication', 'txtMotifExplication', '', 50, 50, $indexTabulation += 10, TRUE, FALSE) . '<br />';
        echo formTextArea('BILAN : ', 'taBilan', 'taBilan', '', 50, 5, 255, $indexTabulation += 10, FALSE) . '<br />';
        ?>
        <h3>Produits présentés</h3>
        <ol id="listeProduitsPresentes">
            <li>
                <?php
                $laListe = getListeCompleteMedicaments();

                echo formSelectDepuisTab2D(NULL, 'lstProduitsPresentes[0]', NULL, $laListe, NULL, $indexTabulation += 10);
                echo formButton('btnAjouterPP', 'btnAjouterPP', '1', '+', $indexTabulation += 10, FALSE);
                ?>
            </li>
        </ol>
        <h3 id="h3EchantillonsDistribues">&Eacute;chantillons distribués <?php echo formButton('btnAjouterPremierED', 'btnAjouterPremierED', '1', 'Ajouter un échantillon', $indexTabulation += 10, FALSE); ?></h3>
        <p>
            <?php
            echo formInputCheckBox(TRUE, 'SAISIE D&Eacute;FINITIVE', 'chkSaisieDefinitive', 'chkSaisieDefinitive', FALSE, $indexTabulation += 10, FALSE);
            echo formInputSubmit('btnSubmit', 'btnSubmit', 'Enregistrer', $indexTabulation += 100);
            echo formInputReset('btnReset', 'btnReset', 'Réinitialiser', $indexTabulation += 10);
            ?>
        </p>
    </form>
</div>
<?php
require_once './Include/pied.inc.php';
?>