<?php
		require_once('includes/initses.php');
		require_once('includes/checkcsrf.php');
		$_SESSION['MEMID']=NULL;
		$_SESSION['EMPLUSERNAME']=NULL;
		header('Location: /memloginform.php');

?>
