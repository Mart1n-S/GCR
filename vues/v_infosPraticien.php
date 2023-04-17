<form id="formPraticien">

    <?php
    echo formInputText('nomPraticien1', 'titreLabel', 'NOM :', 'nomPraticien', 'affichageInformation', $resultatInformationsPraticien['PRA_NOM'], 12, TRUE, FALSE);
    echo formInputText('prenomPraticien1', 'titreLabel', 'PRENOM :', 'prenomPraticien', 'affichageInformation', $resultatInformationsPraticien['PRA_PRENOM'], 13, TRUE, FALSE);
    echo formInputText('adressePraticien1', 'titreLabel', 'ADRESSE :', 'adressePraticien', 'affichageInformation', $resultatInformationsPraticien['PRA_ADRESSE'], 14, TRUE, FALSE);
    echo formInputText('villePraticien1', 'titreLabel', 'VILLE :', 'villePraticien', 'affichageInformation', $resultatInformationsPraticien['concat(PRA_CP,\' \',PRA_VILLE)'], 15, TRUE, FALSE);
    echo formInputText('coefficientNotoriete1', 'titreLabel', 'COEFF NOTORIETE :', 'coefficientNotoriete', 'affichageInformation', $resultatInformationsPraticien['PRA_COEF'], 16, TRUE, FALSE);
    echo formInputText('lieuExercice1', 'titreLabel', 'LIEU D\'EXERCICE :', 'lieuExercice', 'affichageInformation', $resultatInformationsPraticien['TYP_LIEU'], 17, TRUE, FALSE);
    ?>
</form>