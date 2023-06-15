<div class="containerFormulaireIdentification">
    <fieldset>
        <legend>Identifiez-vous</legend>
        <form name="formIdentification" id="formIdentification1" method="post" action="index.php?uc=connexion&action=valideConnexion">
            <?php
            echo formInputText('identifiant1', 'titreLabel', 'Utilisateur', 'identifiant', 'entreeIdentifiant', $_POST["identifiant"], 2, FALSE, TRUE);
            ?>
            <div class="containerMdpBtn">
                <?php
                echo formInputPassword('motDePasse1', 'titreLabel', 'Mot de passe', 'motDePasse', 'entreeMotDePasse', '', 30, 3, TRUE);
                echo formBoutonSubmit('boutonSubmit', 'boutonSubmit3', 'Valider', 4, FALSE); ?>
            </div>
            <?= $erreur; ?>
        </form>
    </fieldset>
</div>