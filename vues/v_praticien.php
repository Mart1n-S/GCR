<div class="element">
    <h1>Praticiens</h1>

    <form name="formListeRecherche" method="post" action="index.php?uc=praticien&action=infosPraticien">

        <?php
        if (isset($_REQUEST['listePraticien'])) {
            $numPraticien = $_REQUEST['listePraticien'];
        } else {
            $numPraticien = 0;
        }

        echo formSelectDepuisRecordSet('listePraticien1', 'Praticien : ', 'listePraticien', 10, $resultatListePraticien, $numPraticien);
        echo formBoutonSubmit('boutonSubmit', 'boutonSubmit1', 'OK', 11, FALSE); ?>

    </form><br></br>
    <?php
    if (isset($_POST['boutonSubmit'])) {
        include("vues/v_infosPraticien.php");
    }
    ?>

</div>