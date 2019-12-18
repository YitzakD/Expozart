<?php
/**
 *	Expozart
 *	ufound app:	gére les pages non trouvées
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

$SUBPAGE = VIEWS . '/' . ucfirst('errors') . '/parts/';

ob_start();

if((isset($CON) && $CON === "topics")) {

	require $SUBPAGE . $MOD . '.topics.php';

}

elseif((isset($CON) && $CON === "a")) {

	require $SUBPAGE . $MOD . '.artwork.php';

}

elseif((isset($CON) && $CON === "user")) {

	require $SUBPAGE . $MOD . '.user.php';

}

else {

	require $SUBPAGE . $MOD . '.artwork.php';

}


$__unfound = ob_get_clean();

#   Template
require VIEWS . '/' . ucfirst('errors') . '/' . $MOD . '.php';