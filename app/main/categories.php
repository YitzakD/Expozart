<?php
/**
 *	Expozart
 *	categories app:	gére la page des catégories
 *	Code:	yitzakD
 */




if(!exAuth_islogged()) {

	$fwURI = $_SERVER['REQUEST_URI'];

	$_SESSION['forwardingURI'] = $fwURI;

	ex_redirect(WURI . '/login');

}




global $router;

global $db;

global $MOD;

global $exVar_usercategoriesAffiliation;

global $exVar_allcategories;

$SUBPAGE = VIEWS . '/' . ucfirst($MOD) . '/parts/';

ob_start();

if(count($exVar_usercategoriesAffiliation) < 5) {

	require $SUBPAGE . $MOD . '.choice.php';

}

else {

	require $SUBPAGE . $MOD . '.main.php';

}


$__categories = ob_get_clean();

#   Template
require VIEWS . '/' . ucfirst($MOD) . '/' . $MOD . '.php';

?>