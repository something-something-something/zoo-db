<?php
function connectZooDB(){
	$db_info=json_decode(file_get_contents('settings/files/db.json'),true);
	return new mysqli($db_info['host'],$db_info['user'],$db_info['pass'],$db_info['name']);
}
$db=connectZooDB();
?>