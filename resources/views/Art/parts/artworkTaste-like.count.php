<?php
/**
 *	Expozart
 *	artwork-like ajax app:	gère les likes
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

	$newcount = ex_cellcount("ex_likes", "aID", $aid, "AND lTYPE='1'");

	echo '<i class="far fa-sm fa-heart"></i> ' .$newcount;

}