<?php
/**
 *	Expozart
 *	register app:	gére les inscriptions des utilisateurs
 *	Code:	yitzakD
 */




if(!exAuth_islogged()) {

	$fwURI = $_SERVER['REQUEST_URI'];

	$_SESSION['forwardingURI'] = $fwURI;

	ex_redirect(WURI . '/login');

}

?>

<h1>Home</h1>