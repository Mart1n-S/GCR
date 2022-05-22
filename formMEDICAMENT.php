<?php
require_once './Include/entete.inc.php';
require_once './Include/SourceDonnees.inc.php';
require_once './Include/Bibliotheque01.inc.php';
$resultat = getlisteFamille();

?>
<div id="bas" >
<h1> Pharmacopée </h1>
    
<form name="formChoixFamille" method="post" action="./index.php?action=200" >
    <?php
    if (isset($_REQUEST['lstFam'])) {
        $num = $_REQUEST['lstFam'];
    } else {
        $num = 0;
    }
        echo formSelectDepuisRecordset('Famille : ', 'lstFam', 'lstFam', $resultat, $num, 10);       
        echo formBoutonSubmit('btnSubmit', 'btnSubmit', 'OK', 11);
       
        
    ?>           
    </form><br></br>
<?php
    require_once'./Include/pied.inc.php';
?>