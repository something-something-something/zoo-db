<?php
if(isset($_SESSION['CSRF'],$_POST['csrf'])){
	if($_SESSION['CSRF']!==$_POST['csrf']){
		die();
	}
}
else{
	die();
}

?>