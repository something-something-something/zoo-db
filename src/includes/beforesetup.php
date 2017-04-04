<?php
/*if setup has already ocured pages that require this will not run.*/
$ALREADYSETUPhtml=<<<'ALREADYSETUP'

<!doctype html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		Setup is complete!
	</body>
</html>
ALREADYSETUP;
if(file_exists($_SERVER['DOCUMENT_ROOT'].'/settings/files/db.json')){
	die($ALREADYSETUPhtml);
}
?>