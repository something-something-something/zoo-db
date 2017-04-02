<?php
		require_once('includes/initses.php');
		require_once('includes/checkcsrf.php');
		$_SESSION['MEMID']=NULL;
		header('Location: /memloginform.php');

?>