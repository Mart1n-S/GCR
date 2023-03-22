<?php
require_once './include/entete.inc.php';
require_once './include/bibliotheque01.inc.php';
require_once './include/sourceDonnees.inc.php';
if (isset($_POST['boutonSubmitCR'])) {
    // On récupère les données du formulaire
    $date = $_POST['txtDateVisite'];
    $numPraticien = $_POST['listePraticienCR'];
    $numRemplacant = isset($_POST['listeRemplacant']) ? $_POST['listeRemplacant'] : null;
    $coefPraticien = $_POST['numCoeffConfiance'];
    $motifVisite = $_POST['listeMotif'];
    $motifExplication = isset($_POST['txtMotifExplication']) ? $_POST['txtMotifExplication'] : null;
    $bilan = $_POST['taBilan'];
    $produitsPresentes = $_POST['listeProduitsPresentes'];
    $echantillonDistribue = isset($_POST['listeProduitEchantillons']) ? $_POST['listeProduitEchantillons'] : null;
    $quantiteEchantillon = isset($_POST['quantiteProduitEchantillons']) ? $_POST['quantiteProduitEchantillons'] : null;
    // Ici la date et l'heure pour enregistrer quand le compte rendu a été fait
    date_default_timezone_set('Europe/Paris');
    $dateHeureCompteRendu = date('Y-m-d H:i:s');

    // On récupère le dernier numero de visite qui à été incrémenté de +1 
    $resultatNumVisite = getDerniereVisite($_SESSION['idUser']);
    if ($resultatNumVisite != false) {
        $numVisite = (int) max($resultatNumVisite) + 1;
    } else {
        $numVisite = 1;
    }

    $resultatInsertionCompteRendu = insertNouveauCompteRendu($_SESSION['idUser'], $numVisite, $numPraticien, $numRemplacant, $date, $dateHeureCompteRendu, $motifVisite, $motifExplication, $bilan);

    if ($numRemplacant != null) {
        $resultatUpdateCoefPraticien = updateCoefPraticien($coefPraticien, $numRemplacant);
    } else {
        $resultatUpdateCoefPraticien = updateCoefPraticien($coefPraticien, $numPraticien);
    }


    foreach ($produitsPresentes as $codeMedicament) {
        $resultatInsertionMedicamentPresente = insertMedicamentPresente($_SESSION['idUser'], $numVisite, $codeMedicament);
    }
    if ($echantillonDistribue != null) {
        foreach (array_map(null, $echantillonDistribue, $quantiteEchantillon) as list($echantillon, $quantite)) {
            $resultatInsertionEchantillonDistribue = insertEchantillonDistribue($_SESSION['idUser'], $numVisite, $echantillon, $quantite);
        }
    }
    if ($resultatInsertionCompteRendu) { ?>
        <div class="element">
            <h1>Récapitulatif du compte-rendu de visite enregistré</h1>
            <form name="frmRecapCompteRenduVisite" id="frmReacpCompteRenduVisite1" method="post" action="index.php?action=10">
                <?php
                $laListe = getListePraticiensTab();
                $lesMotifsVisite = [
                    [1, 'Périodicité'],
                    [2, 'Nouveauté/actualisation'],
                    [3, 'Relance (remontage)'],
                    [4, 'Sollicitation du praticien'],
                    [5, 'Autre']
                ];
                $indexTabulation = 10;
                echo formInputDate('txtDateVisite1', 'titreLabel', 'DATE VISITE : ', 'txtDateVisite', '', $date, $indexTabulation, TRUE, TRUE);
                echo formSelectDepuisTab2D('listePraticienCR1', 'titreLabel', 'PRATICIEN : ', 'listePraticienCR', $indexTabulation += 10,  $laListe, $numPraticien, TRUE);
                if ($numRemplacant != null) {
                    echo formInputCheckBox(TRUE, 'checkRemplacement1', 'checkRemplacement', 'chkRemplaçant', TRUE, $indexTabulation += 10, TRUE) . '<br><br>';
                    echo formSelectDepuisTab2D('listeRemplacant1', 'titreLabel', 'REMPLAÇANT : ', 'listeRemplacant', $indexTabulation += 10,  $laListe, $numRemplacant, TRUE) . '<br><br>';
                } else {
                    echo formInputCheckBox(TRUE, 'checkRemplacement1', 'checkRemplacement', 'chkRemplaçant', FALSE, $indexTabulation += 10, TRUE) . '<br><br>';
                    echo formSelectDepuisTab2D('listeRemplacant1', 'titreLabel', 'REMPLAÇANT : ', 'listeRemplacant', $indexTabulation += 10,  $laListe, '', TRUE) . '<br><br>';
                }
                echo formInputNumber('numCoeffConfiance1', 'titreLabel', 'numCoeffConfiance', 'COEFFICIENT DE CONFIANCE : ', '0', '100', '0.5', $indexTabulation += 10, TRUE, TRUE, $coefPraticien) . '<br><br>';
                echo formSelectDepuisTab2D('listeMotif1', 'titreLabel', 'MOTIF : ', 'listeMotif', $indexTabulation += 10,  $lesMotifsVisite, $motifVisite, TRUE) . '<br><br>';
                if ($motifVisite == 5) {
                    echo formInputText('txtMotifExplication1', 'titreLabel', 'MOTIF EXPLICATION: ', 'txtMotifExplication', 'affichageInformation', $motifExplication, $indexTabulation += 10, TRUE, TRUE);
                } else {
                    echo formInputText('txtMotifExplication1', 'titreLabel', 'MOTIF EXPLICATION: ', 'txtMotifExplication', 'affichageInformation', '', $indexTabulation += 10, TRUE, TRUE);
                }

                echo formTextArea('taBilan1', 'titreLabel', 'BILAN : ', 'taBilan', 255, 50, 5, $indexTabulation += 10, TRUE, $bilan) . '<br><br>'
                ?>
                <h3>Produits présentés</h3>
                <ol id="listeProduitsPresentes">

                    <?php
                    $laListe = getListeCompleteMedicaments();
                    foreach ($produitsPresentes as $produit) {
                        echo '<li>' . formSelectDepuisTab2D(NULL, NULL, NULL, 'listeProduitsPresentes', $indexTabulation += 10,  $laListe, $produit, TRUE) . '</li>';
                    }
                    ?>

                </ol>
                <h3 id="h3EchantillonsDistribues">&Eacute;chantillons distribués </h3>
                <?php
                if ($echantillonDistribue != null) {
                    echo '<ol id="listeEchantillonsDistribues">';
                    foreach (array_map(null, $echantillonDistribue, $quantiteEchantillon) as list($echantillon, $quantite)) {
                        $resultatMedE = getListeInformationsMedicament($echantillon);
                        echo '<li>' . formSelectDepuisTab2D(NULL, NULL, NULL, 'listeProduitEchantillons', $indexTabulation += 10,  $laListe, $echantillon, TRUE)
                            . formInputNumber(NULL, NULL, 'quantiteProduitEchantillons', NULL, '0', '100', '0.5', $indexTabulation += 10, TRUE, TRUE, $quantite) . '</li>';
                    }
                    echo '</ol>';
                } ?>
                <p>
                    <?php
                    echo formInputCheckBox(TRUE, 'chkSaisieDefinitive1', 'chkSaisieDefinitive', 'SAISIE DÉFINITIVE', TRUE, $indexTabulation += 10, TRUE);
                    echo formBoutonSubmit('btnRetour', 'btnRetour1', 'Retour nouveau compte-rendu', $indexTabulation += 100, FALSE);
                    ?>
                </p>
            </form>
        </div>
<?php }
}
require_once './Include/pied.inc.php';
?>