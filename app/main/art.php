<?php
/**
 *	Expozart
 *	art app:	afichage de l'artwork sélectionné et des artworks de la même catégorie
 *	Code:	yitzakD
 */




if(!exAuth_islogged()) {

	$fwURI = $_SERVER['REQUEST_URI'];

	$_SESSION['forwardingURI'] = $fwURI;

	ex_redirect(WURI . '/login');

}




global $router;

global $db;

global $match;

global $MOD; global $CON; global $VUE; global $RVUE;

$SUBPAGE = VIEWS . '/' . ucfirst($MOD) . '/parts/';



#   Template
require VIEWS . '/' . ucfirst($MOD) . '/' . $MOD . '.php';

?>