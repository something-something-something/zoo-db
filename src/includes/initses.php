<?php
/*initialises session cookies for storing information about users. must be required on almost all pages*/
session_start();
/*for preventing csrf*/
if(!isset($_SESSION['CSRF'])){
	/*probaly dont need so many bytes*/
	$_SESSION['CSRF']=bin2hex(random_bytes(4096));
}
/*if null then not logged in as employee if logged in then $_SESSION['EMPLID'] will be the users employee id*/
if(!isset($_SESSION['EMPLID'])){
	$_SESSION['EMPLID']=NULL;
}
?>