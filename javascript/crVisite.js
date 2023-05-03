/**################################################GESTIONNAIRE EVENT MOTIF########################################################################## */
// On ajoute un gestionnaire d'événement à l'élément #listeMotif1 qui est la liste déroulante de motif pour l'événement "change"
$(document).ready(function () {
    // Lorsque l'événement "change" est déclenché, on appelle la fonction rendreDisponibleExplicationMotif() en lui passant le formulaire parent
    $('#listeMotif1').change(function () {
        rendreDisponibleExplicationMotif(this.form);
    }).trigger('change');// Cette ligne déclenche l'événement "change" sur l'élément #listeMotif1 lorsque la page est chargé
});

// Cette fonction reçoit en paramètre le formulaire parent
function rendreDisponibleExplicationMotif(form) {
    // On récupère l'élément select de motif grâce à son name
    var motifSelect = form.elements['listeMotif'];
    // On récupère l'élément input de motif explication grâce à son name
    var explicationInput = form.elements['txtMotifExplication'];
    // On récupère l'option sélectionnée dans l'élément select grâce à l'index de l'option pour récupérer la value de l'index
    var selectedOption = motifSelect.options[motifSelect.selectedIndex];
    // Si la valeur de l'option sélectionnée est égale à 5 donc à "Autre", on active le champ explication et on lui donne le focus
    if (selectedOption.value === '5') {
        explicationInput.disabled = false;
        explicationInput.focus();
    } else {
        // Sinon, on vide le champ explication et on le désactive
        explicationInput.value = '';
        explicationInput.disabled = true;
    }
}

/**################################################GESTIONNAIRE EVENT CHECKBOX REMPLACANT########################################################################## */
// On ajoute un gestionnaire d'événement à l'élément #checkRemplacement1 qui est la case à cocher s'il y a un remplaçant 
$(document).ready(function () {
    // Lorsque l'événement "change" est déclenché, on appelle la fonction rendreDisponibleListeRemplacants() en lui passant le formulaire parent
    $('#checkRemplacement1').change(function () {
        rendreDisponibleListeRemplacants(this.form);
    }).trigger('change');// Cette ligne déclenche l'événement "change" sur l'élément #checkRemplacement1 lorsque la page est chargé
});

function rendreDisponibleListeRemplacants(form) {
    // On récupère l'élément input ckeckbox à son name
    var checkRemplacant = form.elements['checkRemplacement'];
    // On récupère l'élément select de remplaçant grâce à son name
    var listeRemplacant = form.elements['listeRemplacant'];
    // Si la case est cochée on active la liste déroulante des remplaçants et on lui donne le focus
    if (checkRemplacant.checked) {
        listeRemplacant.disabled = false;
        listeRemplacant.focus();
        // permet de mettre le disabled des options à false
        for (var i = 0; i < listeRemplacant.options.length; i++) {
            listeRemplacant.options[i].disabled = false;
        }
    } else {
        // Sinon, on vide le champ et on le désactive
        listeRemplacant.disabled = true;
        listeRemplacant.value = ''
    }
}

/**################################################GESTIONNAIRE EVENT BOUTON '+' ########################################################################## */

// On ajoute un gestionnaire d'événement à l'élément #btnAjouterPP1 qui est le boutton '+'
$(document).ready(function () {
    // Lorsque l'événement "click" est déclenché, on appelle la fonction ajouterLigneProduitPresente() en lui passant le dernier élément 'li' enfant de l'élément ayant l'identifiant listeProduitsPresentes
    $('#btnAjouterPP1').click(function () {
        ajouterLigneProduitPresente($('#listeProduitsPresentes li:last-child'));
    });
});

// function permettant d'ajouter une nouvelle ligne de produits présenté
function ajouterLigneProduitPresente(ligneProduitPresente) {

    // Supprime le bouton "+" de la dernière ligne
    var dernierBoutonAjout = ligneProduitPresente.find('button[id^="btnAjouterPP"]');
    dernierBoutonAjout.remove();

    // Clone la dernière ligne
    var nouvelleLigne = ligneProduitPresente.clone();

    // Renomme la liste déroulante de la nouvelle ligne
    nouvelleLigne.find('select').attr('name', 'listeProduitsPresentes[' + ($('#listeProduitsPresentes li').length) + ']');

    // Ajuste le tabindex de la nouvelle liste déroulante
    var dernierTabIndex = parseInt(ligneProduitPresente.find('select').attr('tabindex'));
    nouvelleLigne.find('select').attr('tabindex', dernierTabIndex + 1);

    // Créer un bouton "-" 
    var nouveauTabIndex = dernierTabIndex + 2;
    var nouveauBoutonSuppression = jqFormButton('btnSupprimerPP', 'btnSupprimerPP1', 'boutonSupprimer', '2', '-', nouveauTabIndex, false);

    // Ajouter le gestionnaire d'événement pour le bouton "-"
    $(document).ready(function () {
        $('#btnSupprimerPP1').click(function () {
            supprimerLigneProduitPresente($('#listeProduitsPresentes li:last-child'), $('#listeProduitsPresentes li:first-child'));
        });
    });

    // Ajouter le bouton "-" à la nouvelle ligne
    nouvelleLigne.append(nouveauBoutonSuppression);

    // Ajouter la nouvelle ligne à la liste des produits présentés
    $('#listeProduitsPresentes').append(nouvelleLigne);

}

function supprimerLigneProduitPresente(ligneProduitPresenteSupprime, ligneProduitPresentePremier) {
    // Créer un bouton "+" avec un nouvel id et tabindex
    var nouveauBoutonAjout = jqFormButton('btnAjouterPP', 'btnAjouterPP1', 'boutonAjout', '1', '+', '100', false);

    //Ajouter le gestionnaire de l'événement click 
    $(document).ready(function () {
        $('#btnAjouterPP1').click(function () {
            ajouterLigneProduitPresente($('#listeProduitsPresentes li:last-child'));
        });
    });

    // Supprime la ligne produit et son bouton '-'
    ligneProduitPresenteSupprime.remove();

    // Ajouter le bouton "+" à la ligne restante.
    ligneProduitPresentePremier.last().append(nouveauBoutonAjout);

}

/**################################################GESTIONNAIRE EVENT BOUTON 'Ajouter un échantillon' ########################################################################## */
$(document).ready(function () {
    $('#btnAjouterPremierED1').click(function () {
        creerListeEchantillonsDistribuesAvecPremiereLigne();
    });
});

function creerListeEchantillonsDistribuesAvecPremiereLigne() {
    // Créer une copie de la liste déroulante (<option>) des produits présentés 
    var listeProduitsCopie = $('select[name="listeProduitsPresentes[0]"]').clone().find('option');

    // Créer la liste numérotée 
    var listeEchantillonsDistribues = $("<ol></ol>")
        .attr("id", "listeEchantillonsDistribues");

    // Insérer la liste après le titre "Échantillons distribués"
    $("#h3EchantillonsDistribues").after(listeEchantillonsDistribues);

    // Récupère le tabindex de bouton 'Ajouter un échantillon'
    var tabindex = $('#btnAjouterPremierED1').attr('tabindex');

    tabindex++;

    // Supprimer le bouton "Ajouter un échantillon"
    $("#btnAjouterPremierED1").remove();

    // Ajouter une première ligne de saisie à la liste
    var premiereLigne = creerLigneEchantillonDistribue(listeProduitsCopie, "listeProduitEchantillons[0]", tabindex++, "quantiteProduitEchantillons[0]", true);

    listeEchantillonsDistribues.append(premiereLigne);
    $('select[name="listeProduitEchantillons[0]"]').focus();

}

/**################################################GESTIONNAIRE EVENT BOUTON '+ et - échantillon'  ########################################################################## */
function ajouterLigneEchantillonDistribue(listeDeroulanteProduitsCopiee) {

    // Récupération du nombre de lignes actuelles de la liste d'échantillons distribués (pour donner un name unique ? ) après on récupère peut être tout sous forme d'un gros tableau et donc 
    var nbLignes = $('#listeEchantillonsDistribues li').length;

    if (nbLignes < 10) {
        // on copie les options de la liste déroulante des echantillons distribues
        var listeProduitsCopie2 = listeDeroulanteProduitsCopiee.clone().find('option');

        // On créer le nouveau name de la nouvelle liste déroulante
        var nomListeProduits = 'listeProduitEchantillons[' + nbLignes + ']';

        // Récupère le tabindex de bouton '+' de Ajouter un échantillon
        var tabIndex = $('#btnAjouterED1').attr('tabindex');
        tabIndex = tabIndex * 1 + 10;

        // On créer le nouveau name de la nouvelle saisie number
        var nomControleQuantite = 'quantiteProduitEchantillons[' + nbLignes + ']'

        // Suppression du bouton "+" de la dernière ligne actuelle de la liste
        $('#listeEchantillonsDistribues li:last-child .boutonAjout').remove();

        // Création de la nouvelle ligne
        var nouvelleLigne = creerLigneEchantillonDistribue(listeProduitsCopie2, nomListeProduits, tabIndex, nomControleQuantite, true);

        // Ajout de la nouvelle ligne à la liste d'échantillons distribués
        $('#listeEchantillonsDistribues').append(nouvelleLigne);

        // Met le focus sur le select de la nouvelle ligne créer
        $('#listeEchantillonsDistribues li:last-child').find('select').focus();
        if (nbLignes == 9) {
            $('#btnAjouterED1').hide();
        }
    }
}
// ######################################SUPPRESSION ECHANTILLON################################
function supprimerLigneEchantillonDistribue(indiceLigne) {

    // Suppression de la ligne correspondant à l'indice passé en paramètre
    $('#listeEchantillonsDistribues li').eq(indiceLigne).remove();

    // Vérification si le bouton "+" est présent dans la dernière ligne
    if ($('#listeEchantillonsDistribues li:last-child #btnAjouterED1').length == 0) {

        // Ajout du bouton "+" à la dernière ligne avec le bon tabindex 
        var tabindex = $('#listeEchantillonsDistribues li:last-child .boutonSupprimerE').attr('tabindex');
        tabindex++;

        var nouveauBoutonAjout = jqFormButton('btnAjouterED', 'btnAjouterED1', 'boutonAjout', '3', '+', tabindex, false);

        //Ajout du bouton créer après le dernier enfant de la liste donc après le dernier bouton '-'
        $('#listeEchantillonsDistribues li:last-child').append(nouveauBoutonAjout);
        //Ajout du gestionnaire d'événement au nouveau bouton
        $(document).ready(function () {
            nouveauBoutonAjout.click(function () {
                ajouterLigneEchantillonDistribue($('#listeEchantillonsDistribues li:last-child'));
            });
        });
    }

    //Renumérotation des indices pour ne pas avoir d'incohérence
    /**
    *  each() permet de parcourir chaque élément de la liste ayant l'id listeEchantillonsDistribues.
    *  Pour chaque élément, il sélectionne les champs de saisie (inputs) dont l'attribut name commence par la chaîne "listeProduitEchantillons" ou "quantiteProduitEchantillons". 
    *  Ensuite, il modifie la valeur de l'attribut name de ces champs pour y inclure l'index de l'élément dans la liste pour pas qu'il y ai d'incohérence.
    */
    $('#listeEchantillonsDistribues li').each(function (index) {
        $(this).find('[name^="listeProduitEchantillons"]').attr('name', 'listeProduitEchantillons[' + index + ']');
        $(this).find('[name^="quantiteProduitEchantillons"]').attr('name', 'quantiteProduitEchantillons[' + index + ']');
    });

    // Vérifier s'il reste des lignes dans la liste
    if ($('#listeEchantillonsDistribues li').length == 0) {

        // Si la liste est vide, supprimer la liste et recréer le bouton "Ajouter un échantillon"
        $('#listeEchantillonsDistribues').remove();

        // On remet le bouton "Ajouter un échantillon"
        var nouveauBoutonAjoutEchantillon = jqFormButton('btnAjouterPremierED', 'btnAjouterPremierED1', 'boutonAjout', '1', 'Ajouter un échantillon', '110', false);
        $('#h3EchantillonsDistribues').append(nouveauBoutonAjoutEchantillon);
        $(document).ready(function () {
            $('#btnAjouterPremierED1').click(function () {
                creerListeEchantillonsDistribuesAvecPremiereLigne();
            });
        });
        // On lui place le focus
        $('#btnAjouterPremierED1').focus();
    } else {
        // Si la liste contient encore des lignes, placer le focus sur la liste déroulante de la dernière ligne
        // dont l'attribut name commence par la chaîne de caractères gra^ce à '^=' qui signifie 'commence par'
        $('#listeEchantillonsDistribues li:last-child select[name^="listeProduitEchantillons"]').focus();
    }
}

//####################################################################CONFIRMER FORMULAIRE######################################################
// Gestionnaire d'événement du changement d'état de la checkbox 'Saisie définitive'

$(document).ready(function () {
    // On crée une fonction pour désactiver les champs du formulaire
    function disableFormFields() {
        $('input:not(:disabled), textarea').prop('readonly', true);
        $('input[type="checkbox"], input[type="reset"], button').not('#chkSaisieDefinitive1, #boutonSubmit2').prop('disabled', true);
        $('select:not(:disabled)').each(function () {
            var select = $(this);
            var selectedOption = select.find('option:selected');
            var optionText = selectedOption.text();
            select.before('<input type="text" readonly name="' + select.attr('name') + '" value="' + optionText + '" />');
            select.hide();
        });
    }

    // On crée une fonction pour réactiver les champs du formulaire
    function enableFormFields() {
        $('input, textarea').prop('readonly', false);
        $('input[type="checkbox"], input[type="reset"], button').prop('disabled', false);
        $('select:hidden').each(function () {
            var select = $(this);
            var inputText = $('input[name="' + select.attr('name') + '"]');
            select.show();
            inputText.remove();
        });
    }

    $('#chkSaisieDefinitive1').change(function () {
        var valeurListeMotif = $('#listeMotif1').val();

        if ($(this).is(':checked')) {
            if ($('#frmCompteRenduVisite1').valid()) {
                disableFormFields();
            } else {
                alert("Veuillez remplir tous les champs requis avant de cocher la case 'Saisie définitive'.");
                $(this).prop('checked', false);
            }
        } else {
            // On réactive tous les champs qui ne sont pas désactivés de base
            enableFormFields();

            if (valeurListeMotif != '5') {
                // Si la valeur de la liste est différente de 5, on réactive les champs spécifiques
                $('input, textarea').not('#txtMotifExplication1').prop('readonly', false);
            }
        }
    });
});

// Cette fonction est appelée lorsque le bouton de soumission est cliqué
$('#boutonSubmit2').click(function (eventSoumissionFormulaire) {
    // Si la checkbox #chkSaisieDefinitive1 n'est pas cochée
    if (!$('#chkSaisieDefinitive1').is(':checked')) {
        alert("Veuillez cocher la case 'Saisie définitive' avant d'enregistrer le compte-rendu.");
        eventSoumissionFormulaire.preventDefault(); // Empêche l'envoi du formulaire
    } else {
        if (confirm("Êtes-vous sûr de vouloir enregistrer ce compte-rendu ?")) {
            //envoie du formulaire
        } else {
            eventSoumissionFormulaire.preventDefault(); // Empêche l'envoi du formulaire si l'utilisateur a annulé la confirmation
        }
    }
});

// Partie AJAX pour mettre le coef par défaut du praticien ou du remplacant
$(document).ready(function () {

    function updateCoeffConfiance(praticien) {
        $.ajax({
            url: './include/sourceDonnees.inc.php',
            type: 'post',
            data: { praticien: praticien },
            success: function (data) { $('#numCoeffConfiance1').val(data); }
        });
    }

    $('#listePraticienCR1').on('change', function () {
        if (!$('#checkRemplacement1').is(':checked')) { updateCoeffConfiance($(this).val()); }
    });

    $('#checkRemplacement1').change(function () {
        if ($(this).is(':checked')) {
            $('#listeRemplacant1').on('change', function () { updateCoeffConfiance($(this).val()); });
        } else { updateCoeffConfiance($('#listePraticienCR1').val()); }
    });

    // initialisation de la valeur de numCoeffConfiance1
    updateCoeffConfiance($('#listePraticienCR1').val());

});
