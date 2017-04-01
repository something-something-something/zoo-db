<?php
/*for pages that use mysql this will create a conection to the database using information in db.json 
$db is this connection.
*/
function connectZooDB(){
	$db_info=json_decode(file_get_contents($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/settings/files/db.json'),true);
	return new mysqli($db_info['host'],$db_info['user'],$db_info['pass'],$db_info['name']);
}
$db=connectZooDB();
?>
