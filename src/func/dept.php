<?php
namespace Dept{
	function selectDeptHTML($db,$deptID=NULL,$name="dept"){
		$statment=$db->prepare("select departmentID,name from Department");
		$deptSelectHTML='<select name="'.$name.'">';
		$selectedoption=false;
		if($statment->execute()){
			$statment->bind_result($id,$dname);
			while($statment->fetch()){
				if($deptID===$id){
					$deptSelectHTML.='<option selected value="'.$id.'">'.$dname.'</option>';
					$selectedoption=true;
				}
				else{
					$deptSelectHTML.='<option value="'.$id.'">'.$dname.'</option>';
				}
			}
		
		}
		if($selectedoption){
			$deptSelectHTML.='<option value="none">None</option>';
		}
		else{
			$deptSelectHTML.='<option  selected value="none">None</option>';
		}
		$statment->close();
		return $deptSelectHTML.'</select>';
	}
}

?>