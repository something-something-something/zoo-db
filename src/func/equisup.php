<?php
namespace EquiSup{
	const TYPES=[['small-tools','Small Tools'],['large-tools','Large Tools'],['human-food-meat','Human Food Meat'],['vehicle','Vehicle'],['human-food-vegtable','Human Food Vegtable'],['animal-food-meat','Animal Food Meat'],['animal-food-vegtable','Animal Food Vegtable']];
	function selectTypeHTML($typeSelected='cage',$name='type'){
		$typeSelectHTML='<select required name="'.$name.'">';
		foreach(TYPES as $typeOp){
			if($typeSelected===$typeOp[0]){
				$typeSelectHTML.='<option selected value="'.$typeOp[0].'">'.$typeOp[1].'</option>';	
			}
			else{
				$typeSelectHTML.='<option value="'.$typeOp[0].'">'.$typeOp[1].'</option>';
			}
		}
		return $typeSelectHTML.'</select>';
	}
}



?>