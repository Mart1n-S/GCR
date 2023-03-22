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
// affiche une liste déroulante à partir d'un tableau de tableau
function formSelectDepuisTab2D($id, $classLabelCss, $label, $name, $tabIndex, $tableaux, $valeurOptionnel, $disabled)
{
    $disabledValue = $disabled ? 'disabled="disabled"' : '';
    $idHtml = '';
    if ($id !== NULL) {
        $idHtml = 'id="' . $id . '"';
    }
    $codeHtml = '';
    if ($label !== NULL) {
        $codeHtml .= '<label for="' . $id . '" class="' . $classLabelCss . '">' . $label . '</label>';
    }
    $codeHtml .= '<select name="' . $name . '" ' . $idHtml . ' class="formulaireSelect" tabindex="' . $tabIndex . '">';
    foreach ($tableaux as $row) {
        $selected = '';
        if ($row[0] == $valeurOptionnel) {
            $selected = 'selected="selected"';
        }
        $codeHtml .= '<option value="' . $row[0] . '" ' . $selected . ' ' . $disabledValue . '>' . $row[1] . '</option>' . "\n";
    }
    $codeHtml .= '</select>';

    return $codeHtml;
}

//zone de saisie à cocher checkbox
function formInputCheckBox($affichageAvantLabel, $id, $name, $label, $checked, $tabIndex, $lectureSeule)
{
    $checkedValue = $checked ? 'checked="checked"' : '';
    $readOnlyValue = $lectureSeule ? 'disabled="disabled"' : '';
    $labelCode = '<label for="' . $id . '">' . $label . '</label>';
    $inputCode = '<input type="checkbox" id="' . $id . '" name="' . $name . '" class="inputCheckBox" ' . $checkedValue . ' tabindex="' . $tabIndex . '" ' . $readOnlyValue . '>';

    if ($affichageAvantLabel) {
        $codeHtml = $inputCode . $labelCode;
        return $codeHtml;
    } else {
        $codeHtml = $labelCode . $inputCode;
        return $codeHtml;
    }
}

//zone de saisie de type numérique
function formInputNumber($id, $classLabelCss, $name, $label, $minValue, $maxValue, $step, $tabIndex, $lectureSeule, $required, $placeholder)
{
    $requiredValue = $required ? 'required="required"' : '';
    $readOnlyValue = $lectureSeule ? 'readonly="readonly"' : '';
    $placeholderValue = $placeholder ? 'placeholder="' . $placeholder . '"' : '';
    $idHtml = '';
    if ($id !== NULL) {
        $idHtml = 'id="' . $id . '"';
    }
    $codeHtml = '';

    if ($label !== NULL) {
        $codeHtml .= '<label for="' . $id . '" class="' . $classLabelCss . '">' . $label . '</label>';
    }
    $codeHtml .= '<input type="number" ' . $idHtml . ' name="' . $name . '" class="inputNumber"  min="' . $minValue . '" max="' . $maxValue . '" step="' . $step . '" tabindex="' . $tabIndex . '" ' . $readOnlyValue . ' ' . $requiredValue . ' ' . $placeholderValue . '>';

    return $codeHtml;
}


// affiche input un lecture ou écriture
function formInputText($id, $classLabelCss, $label, $name, $classInputCss, $valeur, $tabIndex, $lectureSeule, $required)
{
    $codeHtml = '<label for="' . $id . '" class="' . $classLabelCss . '">' . $label . '</label>';
    // $codeHtml .= '<input type="text" name="' . $name . '" class="' . $classInputCss . '" value="' . $valeur . '" ' . ($lectureSeule == TRUE ? ' readonly="readonly"' : '') . ($required == TRUE ? ' required="required"' : '') . '><br><br>';
    $codeHtml .= '<input type="text" name="' . $name . '" id="' . $id . '" class="' . $classInputCss . '"' . ($valeur !== '' ? ' value="' . $valeur . '"' : '') . 'tabindex="' . $tabIndex . '" ' . ($lectureSeule == TRUE ? ' readonly="readonly"' : '') . ($required == TRUE ? ' required="required"' : '') . '><br><br>';

    return $codeHtml;
}

// affiche input type date 
function formInputDate($id, $classLabelCss, $label, $name, $classInputCss, $valeur, $tabIndex, $lectureSeule, $required)
{
    $codeHtml = '<label for="' . $id . '" class="' . $classLabelCss . '">' . $label . '</label>';
    $codeHtml .= '<input type="date" name="' . $name . '" class="' . $classInputCss . '"' . ($valeur !== '' ? ' value="' . $valeur . '"' : '') . 'tabindex="' . $tabIndex . '" ' . ($lectureSeule == TRUE ? ' readonly="readonly"' : '') . ($required == TRUE ? ' required="required"' : '') .  ' max="' . date('Y-m-d') . '" ><br><br>';

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
function formBoutonSubmit($name, $id, $valeur, $tabIndex, $lectureSeule = FALSE)
{
    $readOnlyValue = $lectureSeule ? 'readonly' : '';
    $codeHTML = '<input type="submit" name="' . $name . '" id="' . $id . '" value="' . $valeur . '" tabindex="' . $tabIndex . '" ' . $readOnlyValue . '>';

    return $codeHTML;
}
// affiche bouton de reset
function formInputReset($name, $id, $valeur, $tabIndex, $lectureSeule = FALSE)
{
    $readOnlyValue = $lectureSeule ? 'readonly="readonly"' : '';
    $codeHtml = '<input type="reset" name="' . $name . '" id="' . $id . '" value="' . $valeur . '" tabindex="' . $tabIndex . '" ' . $readOnlyValue . '>';

    return $codeHtml;
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

// affiche un bouton
function formButton($name, $id, $value, $text, $tabIndex, $desactive)
{
    $idHtml = '';
    if ($id !== NULL) {
        $idHtml = 'id="' . $id . '"';
    }
    $disabled = $desactive ? 'disabled="disabled"' : '';
    $codeHtml = '<button type="button" name="' . $name . '" ' . $idHtml . ' value="' . $value . '" tabindex="' . $tabIndex . '" ' . $disabled . '>' . $text . '</button>';

    return $codeHtml;
}
