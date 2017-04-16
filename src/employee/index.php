<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/fancy.php');
	/*visiting this page will print something if loged in*/
?>
<?php
	EmplUser\restrictPageToLoggedIn();
?>
<?php Fancy\printHeader($db,'Welcome Employee','employee'); ?>
<?php $arrImages=['/img/zoo.png','/img/dino.png']; ?>
<img style="width:100%;height:auto;" src="<?php echo $arrImages[random_int(0,1)]; ?>">
<?php Fancy\printFooter(); ?>