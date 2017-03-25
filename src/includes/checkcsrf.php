<?php
/*prevents csrfs from happinf for form submisions on pages that requres this only require for the page where the form is being submited not the page with the form */
if(isset($_SESSION['CSRF'],$_POST['csrf'])){
	if($_SESSION['CSRF']!==$_POST['csrf']){
		die();
	}
}
else{
	die();
}

?>