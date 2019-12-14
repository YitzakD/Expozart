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

		$fut = ex_findone("ex_usertopics", "uID", exAuth_getsession("userid"), "AND tID='$TID'");

		$fuc = ex_findone("ex_usercategories", "uID", exAuth_getsession("userid"), "AND cID='$TID'");

		ex_deleteone("ex_usertopics", "ID", $fut->ID);

		ex_deleteone("ex_usercategories", "ID", $fuc->ID);

	}

}

?>