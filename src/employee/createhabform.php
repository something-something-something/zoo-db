<?php
	require_once('../includes/initses.php');
	require_once('../includes/aftersetup.php');
	require_once('../includes/mysqlcon.php');
	require_once('../func/empluser.php');
	require_once('../func/hab.php');
	EmplUser\restrictPageToPositions($db,['superUser']);
		require_once('../func/fancy.php');
?>
<?php Fancy\printHeader($db,'Habitats','employee','hab'); ?>
<form action="createhab.php" method="POST">
	Name: <input type="text" value="Some Place" name="name" required><br>
	Type: <?php echo Habitat\selectTypeHTML(); ?><br>
	Status:<?php echo Habitat\selectStatusHTML(); ?><br>
	<input type="hidden" value="<?php echo($_SESSION['CSRF']);?>" name="csrf">
	<input type="submit">
</form>
<?php Fancy\printFooter(); ?>