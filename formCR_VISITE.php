<?php
$jsFichier = 'crVisite.js';
require_once './include/entete.inc.php';
require_once './include/bibliotheque01.inc.php';
require_once './include/sourceDonnees.inc.php';
?>

<div class="element">
    <h1>Nouveau compte-rendu de visite</h1>
    <form name="frmCompteRenduVisite" id="frmCompteRenduVisite1" method="post" action="./index.php?action=11">
        <?php
        $indexTabulation = 10;
        $laListe = getListePraticiensTab();
        $lesMotifsVisite = [
            [1, 'Périodicité'],
            [2, 'Nouveauté/actualisation'],
            [3, 'Relance (remontage)'],
            [4, 'Sollicitation du praticien'],
            [5, 'Autre']
        ];

        echo formInputDate('txtDateVisite1', 'titreLabel', 'DATE VISITE : ', 'txtDateVisite', '', '', $indexTabulation, FALSE, TRUE);
        echo formSelectDepuisTab2D('listePraticienCR1', 'titreLabel', 'PRATICIEN : ', 'listePraticienCR', $indexTabulation += 10,  $laListe, '', FALSE);
        echo formInputCheckBox(TRUE, 'checkRemplacement1', 'checkRemplacement', 'chkRemplaçant', FALSE, $indexTabulation += 10, FALSE) . '<br><br>';
        echo formSelectDepuisTab2D('listeRemplacant1', 'titreLabel', 'REMPLAÇANT : ', 'listeRemplacant', $indexTabulation += 10,  $laListe, '', TRUE) . '<br><br>';
        echo formInputNumber('numCoeffConfiance1', 'titreLabel', 'numCoeffConfiance', 'COEFFICIENT DE CONFIANCE : ', '0', '100', '0.5', $indexTabulation += 10, FALSE, TRUE, '50') . '<br><br>';
        echo formSelectDepuisTab2D('listeMotif1', 'titreLabel', 'MOTIF : ', 'listeMotif', $indexTabulation += 10,  $lesMotifsVisite, '', FALSE) . '<br><br>';
        echo formInputText('txtMotifExplication1', 'titreLabel', 'MOTIF EXPLICATION : ', 'txtMotifExplication', 'affichageInformation', '', $indexTabulation += 10, FALSE, TRUE);
        echo formTextArea('taBilan1', 'titreLabel', 'BILAN : ', 'taBilan', 255, 50, 5, $indexTabulation += 10, FALSE, '') . '<br><br>'
        ?>
        <h3>Produits présentés</h3>
        <ol id="listeProduitsPresentes">
            <li>
                <?php
                $laListe = getListeCompleteMedicaments();

                echo formSelectDepuisTab2D(NULL, NULL, NULL, 'listeProduitsPresentes[0]', $indexTabulation += 10,  $laListe, '', FALSE);
                echo formButton('btnAjouterPP', 'btnAjouterPP1', '1', '+', $indexTabulation += 10, FALSE);
                ?>
            </li>
        </ol>
        <h3 id="h3EchantillonsDistribues">&Eacute;chantillons distribués <?php echo formButton('btnAjouterPremierED', 'btnAjouterPremierED1', '1', 'Ajouter un échantillon', $indexTabulation += 10, FALSE); ?></h3>
        <p>
            <?php
            echo formInputCheckBox(TRUE, 'chkSaisieDefinitive1', 'chkSaisieDefinitive', 'SAISIE DÉFINITIVE', FALSE, $indexTabulation += 10, FALSE);
            echo formBoutonSubmit('boutonSubmitCR', 'boutonSubmit2', 'Enregistrer', $indexTabulation += 100, FALSE);
            echo formInputReset('btnReset', 'btnReset1', 'Réinitialiser', $indexTabulation += 10, $lectureSeule = FALSE);
            ?>
        </p>
    </form>
</div>
<?php
require_once './Include/pied.inc.php';
?>