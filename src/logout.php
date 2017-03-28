<?php
		require_once('includes/initses.php');
		require_once('includes/checkcsrf.php');
		$_SESSION['EMPLID']=NULL;
		header('Location: /loginform.php');

?>