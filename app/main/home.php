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




global $router;

global $db;

global $match;

global $MOD; global $CON; global $VUE; global $RVUE;

$SUBPAGE = VIEWS . '/' . ucfirst('home') . '/parts/';

$userAvatar = ex_findone("ex_media", "uID", exAuth_getsession("userrid"), "AND salt='" . exAuth_getsession("userrid") . "' AND fileusability='0'");

$in =  explode(" ", exAuth_getsession("username"));

#   Template
require VIEWS . '/' . ucfirst('home') . '/home.php';

?>