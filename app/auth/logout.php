<?php
/**
 *	Expozart
 *	logout app:	deconnexion de l'utilisateur
 *	Code:	yitzakD
 */




if(exAuth_islogged()) {
	
	session_destroy();
	
	$_SESSION = [];
	
	$_COOKIE = [];

	header('Location:' . WURI);

}

?>