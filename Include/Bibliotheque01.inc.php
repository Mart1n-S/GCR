<?php
function formSelectDepuisRecordset($unLabel, $unName ,$id, $jeuEnregistrement, $valeuroptionnel, $unTabindex){
     $codeHTML = '<label for="' . $id . '">' . $unLabel . '</label>'
            . '<select name="'.$unName.'" id="' . $id . '" tabindex="' . $unTabindex . '">';
    $jeuEnregistrement->setFetchMode(PDO::FETCH_NUM);
    $ligne = $jeuEnregistrement->fetch();
          while ($ligne == true) {
            $codeHTML .='<option';
            if ($ligne[0] == $valeuroptionnel) {
                $codeHTML .= ' selected ="selected"';
            }
            $codeHTML .=' value="' . $ligne[0] . '">' . $ligne[1] . '</option>' . "\n";
            $ligne = $jeuEnregistrement->fetch();
        }
    $codeHTML .='</select>';
    return $codeHTML;
}

function formInputText($css, $nom, $nomlabel, $size, $css2, $valeur, $lectureSeule,$required) {
    $codeHTML = 
'<label class="' . $css . '" for="' . $nom . '">' . $nomlabel . '</label>
<input type="text" value="' . $valeur . '" size="' . $size . '" name="' . $nom . '" class="' . $css2 . '"'
            . ($lectureSeule == TRUE ? ' readonly="readonly"' : '') 
             . ($required == TRUE ? ' required="required"' : '') .'/>'
            ."</br></br>";
    

    return $codeHTML;
}

function formBoutonSubmit($nomBtn, $id, $valeur, $indexTab){
    $codeHTML=
            '<input type="submit" name="'.$nomBtn.'" id="'.$id.'" value="'.$valeur.'" tabindex="'.$indexTab.'" />';
    return $codeHTML;
}

function formInputHidden($nomControle, $id, $valeur){
    $codeHTML= 
            '<label for="'.$id.'"></label>'
            . '<input type="hidden" value="' . $valeur . '" name="' . $nomControle . '" id="' . $id . '"'         
            ."</br></br>";
    return $codeHTML;
}

function formTextArea($label, $nom, $id, $valeur, $largeur, $hauteur, $longueur, $indexTab, $lectureSeule){
     $codeHTML= 
           '<label class="titre" for="' . $id . '">' . $label . '</label>
           <textarea id="'.$id.'" name="'.$nom.'" cols="'.$largeur.'" rows="'.$hauteur.'" size="'.$longueur.'" tabindex="'.$indexTab.'" '
             .($lectureSeule == TRUE ? ' readonly="readonly"' : '').'>'.$valeur.'</textarea>'
             ."</br></br>";
    return $codeHTML;
    
}
?>