<?php 
	include ("classConnexion.php");
	$laBase = new clstBDD;
	$laBase->connecte("dsn_swiss","","");
	if ($laBase->getConnexion() != null) { 
	//on interroge la base
	$curseur = $laBase->requeteSelect('select PRA_NOM, PRA_PRENOM, PRA_ADRESSE, concat(PRA_CP,\' \','
                . 'PRA_VILLE), PRA_COEF, TYP_LIEU from praticien '
                . 'inner join type_praticien on praticien.pra_type = type_praticien.typ_code where pra_num='
                .$_POST["pratNum"]); 
	$res=odbc_fetch_array($curseur);

	//s'il reste un enregistrement non lu
	if ($res != "") {
		//on positionne les champs avec les valeurs de la table
		
	}	
	$laBase->close();
	}
?>