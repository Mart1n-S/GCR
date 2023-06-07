<?php
// connexion à la base de données
// function SGBDConnect()
// {
//     require 'configurationBDD.php';
//     try {
//         $connexion = new PDO($bddDNS, $bddUser, $bddMotDePasse, $options);
//     } catch (PDOException $e) {
//         echo 'Erreur !: ' . $e->getMessage() . '<br />';
//         exit();
//     }
//     return $connexion;
// };
// connexion à la base de données Lycée
function SGBDConnect()
{
    try {
        $connexion = new PDO('mysql:host=svrslam02;dbname=gsb1_1', 'PPEgsb', 'PPEgsb');
        $connexion->query('SET NAMES UTF8');
    } catch (PDOException $e) {
        echo 'Erreur !: ' . $e->getMessage() . '<br />';
        exit();
    }
    return $connexion;
}
// récupère une partie des informations des praticiens
function getListePraticiens()
{
    $sql = SGBDConnect()->prepare('SELECT PRA_NUM, concat(PRA_NOM,\' \',PRA_PRENOM)  AS NOM_COMPLET
    FROM praticien 
    ORDER BY PRA_NOM ,PRA_PRENOM');
    $sql->execute();

    $resultat = $sql->fetchAll(PDO::FETCH_NUM);

    return $resultat;
}

// récupère le reste des informations du praticien séléctionné
// function getPraticienInformations($numPraticien)
// {

//     $sql = SGBDConnect()->prepare('SELECT PRA_NOM, PRA_PRENOM, PRA_ADRESSE, PRA_COEF, TYP_LIEU, concat(PRA_CP,\' \',PRA_VILLE) 
//     FROM praticien 
//     INNER JOIN type_praticien ON praticien.pra_type = type_praticien.typ_code
//     WHERE praticien.PRA_NUM = :numPraticien');
//     $sql->bindParam(":numPraticien", $numPraticien, PDO::PARAM_INT);
//     $sql->execute();

//     $resultat = $sql->fetch(PDO::FETCH_ASSOC);

//     return $resultat;
// }
function getPraticienInformations($numPraticien)
{

    $sql = SGBDConnect()->prepare('SELECT PRA_NOM, PRA_PRENOM, PRA_ADRESSE1 AS PRA_ADRESSE, PRA_COEF, TP_LIEU_EXERCICE AS TYP_LIEU, concat(PRA_CP,\' \',PRA_VILLE) 
    FROM praticien 
    INNER JOIN type_praticien ON praticien.TP_CODE = type_praticien.TP_CODE
    WHERE praticien.PRA_NUM = :numPraticien');
    $sql->bindParam(":numPraticien", $numPraticien, PDO::PARAM_INT);
    $sql->execute();

    $resultat = $sql->fetch(PDO::FETCH_ASSOC);

    return $resultat;
}

// récupère les familles de médicaments
// function getListeFamilleMedicament()
// {

//     $sql = SGBDConnect()->prepare('SELECT FAM_CODE, FAM_LIBELLE 
//     FROM famille 
//     ORDER BY FAM_LIBELLE');
//     $sql->execute();

//     $resultat = $sql->fetchAll(PDO::FETCH_NUM);

//     return $resultat;
// }
function getListeFamilleMedicament()
{

    $sql = SGBDConnect()->prepare('SELECT FM_CODE AS FAM_CODE, FM_LIBELLE AS FAM_LIBELLE 
    FROM famille_medicament 
    ORDER BY FM_LIBELLE');
    $sql->execute();

    $resultat = $sql->fetchAll(PDO::FETCH_NUM);

    return $resultat;
}

// récupère les médicaments en fonction de la famille séléctionné
// function getListeMedicament()
// {

//     $sql = SGBDConnect()->prepare('SELECT MED_CODE, MED_NOM 
//     FROM medicament
//     WHERE MED_FAMILLE = :familleMedicament
//     ORDER BY MED_NOM');
//     $sql->bindParam(":familleMedicament", $_REQUEST['listeFamilleMedicament'], PDO::PARAM_STR);
//     $sql->execute();

//     $resultat = $sql->fetchAll(PDO::FETCH_NUM);

//     return $resultat;
// }

function getListeMedicament()
{

    $sql = SGBDConnect()->prepare('SELECT MED_CODE, MED_NOM 
    FROM medicament
    WHERE FM_CODE = :familleMedicament
    ORDER BY MED_NOM');
    $sql->bindParam(":familleMedicament", $_REQUEST['listeFamilleMedicament'], PDO::PARAM_STR);
    $sql->execute();

    $resultat = $sql->fetchAll(PDO::FETCH_NUM);

    return $resultat;
}

// récupère les informations de médicament séléctionné
// function getListeInformationsMedicament($codeMedicamentInformation)
// {

//     $sql = SGBDConnect()->prepare('SELECT MED_CODE, MED_NOM, MED_COMPO, MED_EFFETS, MED_CONTREINDIC, LAB_NOM
//     FROM medicament
//     INNER JOIN famille ON medicament.med_famille = famille.fam_code
//     INNER JOIN laboratoire ON laboratoire.lab_code=medicament.med_labo
//     WHERE medicament.MED_CODE = :codeMedicament
//     ORDER BY MED_NOM');
//     $sql->bindParam(":codeMedicament", $codeMedicamentInformation, PDO::PARAM_STR);
//     $sql->execute();

//     $resultat = $sql->fetch(PDO::FETCH_ASSOC);

//     return $resultat;
// }

function getListeInformationsMedicament($codeMedicamentInformation)
{

    $sql = SGBDConnect()->prepare('SELECT MED_CODE, MED_NOM, MED_COMPO, MED_EFFETS, MED_CONTREINDIC, LAB_NOM
    FROM medicament
    INNER JOIN famille_medicament ON medicament.FM_CODE = famille_medicament.FM_CODE
    INNER JOIN laboratoire ON laboratoire.LAB_CODE=medicament.LAB_CODE
    WHERE medicament.MED_CODE = :codeMedicament
    ORDER BY MED_NOM');
    $sql->bindParam(":codeMedicament", $codeMedicamentInformation, PDO::PARAM_STR);
    $sql->execute();

    $resultat = $sql->fetch(PDO::FETCH_ASSOC);

    return $resultat;
}

// récupère les informations de l'utilisateur
// function getInformationsUtilisateur($idCodeUtilisateur)
// {
//     $sql = SGBDConnect()->prepare('SELECT VIS_NOM, VIS_PRENOM, TRA_ROLE, REG_NOM
//     FROM visiteur
//     INNER JOIN travail ON visiteur.VIS_CODE = travail.TRA_VIS
//     INNER JOIN region ON region.REG_CODE = travail.TRA_REG
//     WHERE VIS_CODE = :codeUtilisateur
//     AND TRA_DATAFF = (
//     SELECT MAX(TRA_DATAFF)
//     FROM travail
//     WHERE TRA_VIS = visiteur.VIS_CODE)');
//     $sql->bindParam(":codeUtilisateur", $idCodeUtilisateur, PDO::PARAM_STR);
//     $sql->execute();

//     $resultat = $sql->fetch(PDO::FETCH_ASSOC);

//     return $resultat;
// }

// function getInformationsUtilisateur($idCodeUtilisateur)
// {
//     $sql = SGBDConnect()->prepare('SELECT VIS_NOM, VIS_PRENOM
//     FROM visiteur
//     WHERE VIS_CODE = :codeUtilisateur');
//     $sql->bindParam(":codeUtilisateur", $idCodeUtilisateur, PDO::PARAM_STR);
//     $sql->execute();

//     $resultat = $sql->fetch(PDO::FETCH_ASSOC);

//     return $resultat;
// }
function getInformationsUtilisateur($idCodeUtilisateur)
{
    $sql = SGBDConnect()->prepare('SELECT VIS_NOM, VIS_PRENOM, AFF_ROLE, REG_NOM
    FROM visiteur
    INNER JOIN visite ON visiteur.VIS_CODE = visite.VIS_CODE
    INNER JOIN affectation ON visite.VISITE_NUM = affectation.AFF_NUM
    INNER JOIN region ON affectation.REG_CODE = region.REG_CODE
    WHERE visiteur.VIS_CODE = :codeUtilisateur
    AND visiteur.VIS_CODE = visite.VIS_CODE
    AND visite.VISITE_NUM = affectation.AFF_NUM
    AND affectation.REG_CODE = region.REG_CODE
    AND AFF_DATE = (
    SELECT MAX(AFF_DATE)
    FROM affectation
    WHERE VIS_CODE = visiteur.VIS_CODE)');
    $sql->bindParam(":codeUtilisateur", $idCodeUtilisateur, PDO::PARAM_STR);
    $sql->execute();

    $resultat = $sql->fetch(PDO::FETCH_ASSOC);

    return $resultat;
}


function getListePraticiensTab()
{
    $sql = SGBDConnect()->prepare('SELECT PRA_NUM, concat(PRA_NOM,\' \',PRA_PRENOM) AS NOM_COMPLET, PRA_COEF
    FROM praticien 
    ORDER BY PRA_NOM ,PRA_PRENOM');
    $sql->execute();

    $resultat = $sql->fetchAll(PDO::FETCH_NUM);

    return $resultat;
}


function getListeCompleteMedicaments()
{
    $sql = SGBDConnect()->prepare('SELECT MED_CODE, MED_NOM
    FROM medicament 
    ORDER BY MED_NOM');
    $sql->execute();

    $resultat = $sql->fetchAll(PDO::FETCH_BOTH);

    return $resultat;
}

function getDerniereVisite($idUser)
{
    $sql = SGBDConnect()->prepare('SELECT MAX(VISITE_NUM) AS NUM_VISITE
    FROM visite
    WHERE VIS_CODE = :idVisiteur');
    $sql->bindParam(":idVisiteur", $idUser, PDO::PARAM_STR);
    $sql->execute();
    $resultat = $sql->fetch(PDO::FETCH_ASSOC);

    return $resultat;
}

function insertNouveauCompteRendu($idUser, $numVisite, $numPraticien, $numRemplacant, $date, $dateHeureCompteRendu, $motifVisite, $motifExplication, $bilan)
{
    $sql = SGBDConnect()->prepare('INSERT INTO visite
    VALUES (:idVisiteur, :numVisite, :numPraticien, :numRemplacant, :date, :dateHeure, :numMotif, :motifExplication, :bilan)');
    $sql->bindParam(':idVisiteur', $idUser);
    $sql->bindParam(':numVisite', $numVisite);
    $sql->bindParam(':numPraticien', $numPraticien);
    $sql->bindParam(':numRemplacant', $numRemplacant);
    $sql->bindParam(':date', $date);
    $sql->bindParam(':dateHeure', $dateHeureCompteRendu);
    $sql->bindParam(':numMotif', $motifVisite);
    $sql->bindParam(':motifExplication', $motifExplication);
    $sql->bindParam(':bilan', $bilan);
    $sql->execute();

    if ($sql) {
        return true;
    }
}

function updateCoefPraticien($coefPraticien, $numPraticien)
{
    $sql = SGBDConnect()->prepare('UPDATE praticien 
    SET PRA_COEF = :coefPraticien
    WHERE PRA_NUM = :numPraticien');
    $sql->bindParam(':coefPraticien', $coefPraticien);
    $sql->bindParam(':numPraticien', $numPraticien);
    $sql->execute();

    if ($sql) {
        return true;
    }
}

function insertMedicamentPresente($idUser, $numVisite, $codeMedicament)
{
    $sql = SGBDConnect()->prepare('INSERT INTO medicament_presente
    VALUES (:idVisiteur, :numVisite, :codeMedicament)');
    $sql->bindParam(':idVisiteur', $idUser);
    $sql->bindParam(':numVisite', $numVisite);
    $sql->bindParam(':codeMedicament', $codeMedicament);
    $sql->execute();

    if ($sql) {
        return true;
    }
}

function insertEchantillonDistribue($idUser, $numVisite, $codeMedicament, $quantiteEchantillon)
{
    $sql = SGBDConnect()->prepare('INSERT INTO echantillon_distribue
    VALUES (:idVisiteur, :numVisite, :codeMedicament, :quantiteEchantillon)');
    $sql->bindParam(':idVisiteur', $idUser);
    $sql->bindParam(':numVisite', $numVisite);
    $sql->bindParam(':codeMedicament', $codeMedicament);
    $sql->bindParam(':quantiteEchantillon', $quantiteEchantillon);
    $sql->execute();

    if ($sql) {
        return true;
    }
}

function getPraticien()
{
    $sql = SGBDConnect()->prepare('SELECT PRA_COEF
    FROM praticien 
    WHERE PRA_NUM = :numPraticien');
    $sql->bindParam(':numPraticien', $_POST['praticien']);
    $sql->execute();

    $resultat = $sql->fetch(PDO::FETCH_ASSOC);

    $data = $resultat['PRA_COEF'];

    echo $data;
}
getPraticien();
