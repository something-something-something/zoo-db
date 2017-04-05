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
	function selectHabitatHTML($db,$habID=NULL,$name="habitat"){
		$statment=$db->prepare("select HabitatID,Hname from Habitats");
		$habSelectHTML='<select name="'.$name.'">';
		$selectedoption=false;
		if($statment->execute()){
			$statment->bind_result($id,$hname);
			while($statment->fetch()){
				if($habID===$id){
					$habSelectHTML.='<option selected value="'.$id.'">'.$hname.'</option>';
					$selectedoption=true;
				}
				else{
					$habSelectHTML.='<option value="'.$id.'">'.$hname.'</option>';
				}
			}
		
		}
		if($selectedoption){
			$habSelectHTML.='<option value="none">None</option>';
		}
		else{
			$habSelectHTML.='<option  selected value="none">None</option>';
		}
		$statment->close();
		return $habSelectHTML.'</select>';
	}

}
?>