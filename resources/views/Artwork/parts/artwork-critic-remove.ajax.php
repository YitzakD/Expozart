<?php
/**
 *	Expozart
 *	artwork-critic-remove ajax app:	gère les commentaires supprimés
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

if(isset($_POST["aid"]) && is_numeric($_POST["aid"])) {

	extract($_POST);

	$critic = ex_findone("ex_comments", "ID", $aid);

	$cid = $critic->aID;

	$q = $db->prepare("DELETE FROM ex_comments WHERE ID=:ID");

	$q->execute(['ID' => $aid]);

	$artworkcritics = ex_cellcount("ex_comments", "aID", $cid, "AND cTYPE='1'");

	if(!$q) { exit('not-removed'); } else {

		if($artworkcritics > 1) {
			
			echo ex_getRealnumber($artworkcritics) . " critiques";

		} else {

			echo $artworkcritics . " critique";

		}


	}

}