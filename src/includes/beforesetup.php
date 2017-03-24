<?php
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
if(file_exists('settings/files/db.json')){
	die($ALREADYSETUPhtml);
}
?>