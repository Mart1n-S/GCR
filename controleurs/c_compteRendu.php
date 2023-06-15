<?php
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'compteRenduVisite';
}
$action = $_REQUEST['action'];

switch ($action) {
        // on affiche le formulaire pour le compte rendu d'une visite
    case 'compteRenduVisite': {
            $jsFichier = 'crVisite.js';
            $laListe = getListePraticiensTab();
            $laListe2 = getListeCompleteMedicaments();
            include("vues/v_entete.php");
            include("vues/v_compteRenduVisite.php");
            include("vues/v_pied.php");
            break;
        }
        // on affiche le recapitulatif du compte rendu
    case 'recapitulatifCompteRenduVisite': {

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
            $laListe = getListePraticiensTab();
            $laListe2 = getListeCompleteMedicaments();
            include("vues/v_entete.php");
            include("vues/v_recapitulatifCompteRenduVisite.php");
            include("vues/v_pied.php");
            break;
        }
}
