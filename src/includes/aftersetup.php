<?php
/*for files that include this it ensure they are not accesed before setup is complete.*/
/* if db.json exists the database was probably already setup*/
if(!file_exists('settings/files/db.json')){
	die();
}
?>