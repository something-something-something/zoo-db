<?php
	require_once('includes/initses.php');
	require_once('includes/aftersetup.php');
	require_once('includes/mysqlcon.php');
	require_once('func/fancy.php');
?>
<?php Fancy\printHeader($db,'Home'); ?>
<?php $arrImages=['/img/zoo.png','/img/dino.png']; ?>
<img style="width:100%;height:auto;" src="<?php echo $arrImages[random_int(0,1)]; ?>">
<?php Fancy\printFooter(); ?>