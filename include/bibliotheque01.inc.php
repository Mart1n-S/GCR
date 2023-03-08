<?php
// affiche une liste déroulante
function formSelectDepuisRecordSet($id, $label, $name, $tabIndex, $jeuEnregistrement, $valeurOptionnel)
{
    $codeHtml = '<label for="' . $id . '">' . $label . '</label>';
    $codeHtml .= '<select name="' . $name . '" id="' . $id . '" class="formulaireSelect" tabindex="' . $tabIndex . '">';
    foreach ($jeuEnregistrement as $row) {
        $selected = '';
        if ($row[0] == $valeurOptionnel) {
            $selected = 'selected="selected"';
        }
        $codeHtml .= '<option value="' . $row[0] . '" ' . $selected . '>' . $row[1] . '</option>' . "\n";
    }
    $codeHtml .= '</select>';

    return $codeHtml;
}

// affiche input un lecture ou écriture
function formInputText($id, $classLabelCss, $label, $name, $classInputCss, $valeur, $tabIndex, $lectureSeule, $required)
{
    $codeHtml = '<label for="' . $id . '" class="' . $classLabelCss . '">' . $label . '</label>';
    // $codeHtml .= '<input type="text" name="' . $name . '" class="' . $classInputCss . '" value="' . $valeur . '" ' . ($lectureSeule == TRUE ? ' readonly="readonly"' : '') . ($required == TRUE ? ' required="required"' : '') . '><br><br>';
    $codeHtml .= '<input type="text" name="' . $name . '" class="' . $classInputCss . '"' . ($valeur !== '' ? ' value="' . $valeur . '"' : '') . 'tabindex="' . $tabIndex . '" ' . ($lectureSeule == TRUE ? ' readonly="readonly"' : '') . ($required == TRUE ? ' required="required"' : '') . '><br><br>';

    return $codeHtml;
}

// affiche input tupe password
function formInputPassword($id, $classLabelCss, $label, $name, $classInputCss, $valeur, $tailleMax, $tabIndex, $required)
{
    $codeHtml = '<label for="' . $id . '" class="' . $classLabelCss . '">' . $label . '</label>';
    $codeHtml .= '<input type="password" name="' . $name . '" class="' . $classInputCss . '"' . ($valeur !== '' ? ' value="' . $valeur . '"' : '') . 'maxlenght="' . $tailleMax . '" tabindex="' . $tabIndex . '" ' . ($required == TRUE ? ' required="required"' : '') . '><br><br>';

    return $codeHtml;
}

// affiche bouton de soumission
function formBoutonSubmit($name, $id, $valeur, $tabIndex, $lectureSeule)
{
    $codeHTML = '<input type="submit" name="' . $name . '" id="' . $id . '" value="' . $valeur . '" tabindex="' . $tabIndex . '" ' . ($lectureSeule == TRUE ? ' disabled="disabled"' : '') . '>';

    return $codeHTML;
}

// permet de conserver le code de la famille de médicament
function formInputHidden($id, $name, $valeur)
{
    $codeHtml = '<input type="hidden" id="' . $id . '" name="' . $name . '" value="' . $valeur . '"><br><br>';

    return $codeHtml;
}

// affichage des informations dans un textarea
function formTextArea($id, $classLabelCss, $label, $name, $caracteresMax, $largeur, $hauteur, $tabIndex, $lectureSeule, $valeur)
{

    $codeHtml = '<label for="' . $id . '" class="' . $classLabelCss . '">' . $label . '</label>';
    $codeHtml .= '<textarea name="' . $name . '" id="' . $id . '" maxlength="' . $caracteresMax . '" cols="' . $largeur . '" rows="' . $hauteur . '" tabindex="' . $tabIndex . '"' . ($lectureSeule == TRUE ? ' readonly="readonly"' : '') . '>' . $valeur . '</textarea><br><br>';

    return $codeHtml;
}
