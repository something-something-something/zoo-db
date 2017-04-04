<?php
namespace Habitat{
	const TYPES=[['cage','Cage'],['aquarium','Aquarium'],['fence','Fenced in area']];
	const STATUSES=[['undergoing-maintenance','Undergoing Maintenance'],['okay','Okay',],['needs-maintenance','Needs Maintenance']];
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
	function selectStatusHTML($statusSelected='okay',$name='status'){
		$statusSelectHTML='<select required name="'.$name.'">';
		foreach(STATUSES as $statusOp){
			if($statusSelected===$statusOp[0]){
				$statusSelectHTML.='<option selected value="'.$statusOp[0].'">'.$statusOp[1].'</option>';	
			}
			else{
				$statusSelectHTML.='<option value="'.$statusOp[0].'">'.$statusOp[1].'</option>';
			}
		}
		return $statusSelectHTML.'</select>';
	}
}
?>