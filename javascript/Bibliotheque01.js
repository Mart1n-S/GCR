
/**
 * 
 * Retourne un contrôle de saisie de type button sous la forme d'un objet JQuery.
 * 
 * @param {string} unNom null si l'objet n'a pas de nom.
 * @param {string} unId null si l'objet n'a pas d'id.
 * @param {string} uneValeur
 * @param {string} unTexte
 * @param {int} unIndexTab
 * @param {boolean} uneLectureSeule
 * @returns {jQuery} L'objet button.
 * 
 */
function jqFormButton(unNom, unId, classe, uneValeur, unTexte, unIndexTab, uneLectureSeule) {

    return $('<button type="button" class="'
        + classe + '" '
        + (unId === null ? '' : ' id="' + unId + '"')
        + (unNom === null ? '' : ' name="' + unNom + '"')
        + ' value="' + uneValeur
        + '" tabindex="' + unIndexTab
        + '" >' + unTexte + '</button>').prop('disabled', uneLectureSeule); // Pour prop() voir http://api.jquery.com/prop/#entry-longdesc-1

}

// fonction de création d'un contrôle de saisie de type number
function jqFormInputNumber(id, name, minValue, maxValue, step, tabIndex, lectureSeule, required, placeholder) {
    return $('<input type="number"'
        + (id === null ? '' : ' id="' + id + '"')
        + (name === null ? '' : ' name="' + name + '"')
        + ' min="' + minValue
        + '" max="' + maxValue
        + '" step="' + step
        + '" tabindex="' + tabIndex + '" '
        + (placeholder === null ? '' : ' placeholder="' + placeholder + '"')
        + (required === null ? '' : ' required="required"')
        + '" />').prop('disabled', lectureSeule);
}

// fonction d'ajout d'un bouton "+" à une ligne de saisie d'un échantillon 
function ajouterBoutonPlusLigne(ligne, tabIndex) {
    ligne.append(jqFormButton('btnAjouterED', 'btnAjouterED1', 'boutonAjout', '3', '+', tabIndex, false));
    $(document).ready(function () {
        $('#btnAjouterED1').click(function () {
            ajouterLigneEchantillonDistribue($('#listeEchantillonsDistribues li:last-child'));
        });
    });
}


// fonction de création d'une ligne de saisie d'un échantillon
function creerLigneEchantillonDistribue(listeProduits, nameListeProduits, tabIndexListeProduits, nameQuantite, afficherBoutonPlus) {
    // Création de la ligne
    var ligne = $('<li></li>');

    // Création de la liste déroulante des produits
    var listeDeroulanteProduits = $('<select></select>')
        .attr('name', nameListeProduits)
        .attr('tabindex', tabIndexListeProduits);

    // Ajout des options de la liste déroulante des produits
    for (var i = 0; i < listeProduits.length; i++) {
        var produit = listeProduits[i];
        listeDeroulanteProduits.append($('<option></option>')
            .attr('value', produit.value)
            .text(produit.innerText));
    }

    var nouveauTabindexListeProduits = tabIndexListeProduits * 1 + 10;

    // Création du contrôle de saisie du nombre de produit
    var champQuantite = jqFormInputNumber(null, nameQuantite, 1, 10, 1, nouveauTabindexListeProduits, false, true, "0");

    var nouveauTabindexLBtnSup = nouveauTabindexListeProduits * 1 + 10;

    var nbLignes = $('#listeEchantillonsDistribues li').length;

    var nameBoutonSupprimer = 'btnSupprimerED' + nbLignes;

    // Création du bouton "-"
    var boutonMoins = jqFormButton('btnSupprimerED', nameBoutonSupprimer, 'boutonSupprimer', "-", "-", nouveauTabindexLBtnSup, false);

    // Ajout du gestionnaire d'événement pour récupérer l'index et le passer en paramètre de la fonction qui s'occupe de la suppression
    $(document).ready(function () {
        boutonMoins.click(function () {
            var index = $('li .boutonSupprimer').index(this);
            supprimerLigneEchantillonDistribue(index);
        });
    });

    // Ajout des éléments à la ligne
    ligne.append(listeDeroulanteProduits)
        .append(champQuantite)
        .append(boutonMoins);

    var nouveauTabindexLBtnAdd = nouveauTabindexLBtnSup * 1 + 10;

    // Ajout du bouton "+" si nécessaire
    if (afficherBoutonPlus) {
        var boutonPlus = ajouterBoutonPlusLigne(ligne, nouveauTabindexLBtnAdd);
        ligne.append(boutonPlus)
    }

    return ligne;
}