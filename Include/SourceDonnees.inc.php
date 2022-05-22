<?php
function SGBDConnect(){
    try { 
 $connexion = new PDO('mysql:host=localhost;dbname=gsb', 'root', ''); 
 $connexion->query('SET NAMES UTF8');  
} catch (PDOException $e) { 
 echo 'Erreur !: ' . $e->getMessage() . '<br />'; 
 exit(); 
} 
return $connexion;
}
function getlistePraticiens() {
        
    $sql = 'select PRA_NUM, concat(PRA_NOM,\' \',PRA_PRENOM) '
            . 'From praticien '
            . 'order by PRA_NOM ,PRA_PRENOM';
    $resultat = SGBDConnect()->query($sql);
    return $resultat;
    
}

function getPraticienInformations($numpraticien) {
    $connexion = SGBDConnect();
    $sql = 'SELECT PRA_NOM, PRA_PRENOM, PRA_ADRESSE, PRA_COEF, TYP_LIEU , concat(PRA_CP,\' \',PRA_VILLE)
FROM praticien
INNER JOIN  type_praticien on praticien.pra_type = type_praticien.typ_code
WHERE praticien.PRA_NUM ="' . $numpraticien . '"';
    $info = $connexion->query($sql);
    return $info;
}

function getlisteFamille() {
        
    $sql = 'select FAM_CODE, FAM_LIBELLE '
            . ' From famille '
            . ' order by FAM_LIBELLE ';
    $resultat = SGBDConnect()->query($sql);
    return $resultat;
    
}

function getlisteMed() {
        
    $sql = 'select MED_CODE, MED_NOM '
            . ' From medicament '
            . ' Where MED_FAMILLE= "'.$_REQUEST['lstFam'].'"'
            . ' order by MED_NOM ';
    $resultat = SGBDConnect()->query($sql);
    return $resultat;
    
}

function getlisteInfos() {
        
    $sql = 'select MED_CODE, MED_NOM, MED_COMPO, MED_EFFETS, MED_CONTREINDIC, LAB_NOM'
            . ' From medicament '
            . ' inner join famille on medicament.med_famille=famille.fam_code'
            . ' inner join laboratoire on laboratoire.lab_code=medicament.med_labo'
            . ' Where medicament.MED_CODE= "'.$_POST['lstMed'].'"'
            . ' order by MED_NOM ';
    $resultat = SGBDConnect()->query($sql);
    return $resultat;
    
}



?>