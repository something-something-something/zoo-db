<?php
namespace Vendor{
	const TYPES=[['food','Food'],['retail','Retail'],['ride','Ride']];
	function selectTypeHTML($typeSelected='food',$name='type'){
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
	function selectVendorHTML($db,$vendID=NULL,$name="id"){
		$statment=$db->prepare("select vendorID,Vname from Vendor");
		$vendSelectHTML='<select name="'.$name.'">';
		$selectedoption=false;
		if($statment->execute()){
			$statment->bind_result($id,$vname);
			while($statment->fetch()){
				if($vendID===$id){
					$vendSelectHTML.='<option selected value="'.$id.'">'.$id.' '.$vname.'</option>';
					$selectedoption=true;
				}
				else{
					$vendSelectHTML.='<option value="'.$id.'">'.$id.' '.$vname.'</option>';
				}
			}
		
		}
		$statment->close();
		return $vendSelectHTML.'</select>';
	}
	function selectVendorInEmplDeptHTML($db,$emplID,$vendID=NULL,$name="id"){
		$statment=$db->prepare("select vendorid,Vname from Vendor where department=(select departmentid from Employee where employeeid=?)");
		$statment->bind_param('i',$emplID);
		$vendSelectHTML='<select name="'.$name.'">';
		$selectedoption=false;
		if($statment->execute()){
			$statment->bind_result($id,$vname);
			while($statment->fetch()){
				if($vendID===$id){
					$vendSelectHTML.='<option selected value="'.$id.'">'.$id.' '.$vname.'</option>';
					$selectedoption=true;
				}
				else{
					$vendSelectHTML.='<option value="'.$id.'">'.$id.' '.$vname.'</option>';
				}
			}
		
		}
		$statment->close();
		return $vendSelectHTML.'</select>';
	}
}
?>