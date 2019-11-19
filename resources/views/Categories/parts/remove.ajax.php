<?php
/**
 *	Expozart
 *	remove ajax app:	supprime les choix de l'utilisateur dans sa liste d'affiliation  
 *	Code:	yitzakD
 */




/** Constantes d'environnement	*/
$WEBROOT = dirname(dirname(dirname(__FILE__)));

$ROOT = dirname(dirname($WEBROOT));

$DS = DIRECTORY_SEPARATOR;

$CORE = $ROOT.$DS.'core';

session_start();

include_once $CORE.$DS.'database/db-config.php';

include_once $CORE.$DS.'app/global.func.php';

include_once $CORE.$DS.'app/auth.func.php';

include_once $CORE.$DS.'includes/account.var.php';

if(exAuth_getsession("userid") && exAuth_getsession("userhash")) {

	if(isset($_POST["cToAffiliate"]) && is_numeric($_POST["cToAffiliate"])) {

		extract($_POST);

		$TID = $cToAffiliate;

		ex_deleteall("ex_usertopics", "tID", $TID, "AND uID=" . exAuth_getsession("userid"));

		ex_deleteall("ex_usercategories", "cID", $TID, "AND uID=" . exAuth_getsession("userid"));

	}

}

?>