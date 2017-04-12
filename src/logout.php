<?php
		require_once('includes/initses.php');
		require_once('includes/checkcsrf.php');
		$_SESSION['EMPLID']=NULL;
		$_SESSION['EMPLUSERNAME']=NULL;
		header('Location: /loginform.php');

?>
