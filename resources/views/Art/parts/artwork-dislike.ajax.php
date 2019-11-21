<?php
/**
 *	Expozart
 *	artwork-dislike ajax app:	gère les dislikes
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

	if(ex_cellcount("ex_likes", "aID", $aid, "AND uID=" . exAuth_getsession("userid") . " AND lTYPE='1'")) {

		$q = $db->prepare("DELETE FROM ex_likes WHERE uID=:uID AND aID=:aID AND lTYPE=:lTYPE");

		$q->execute([
	        'uID' => exAuth_getsession("userid"),
	        'aID' => $aid,
	        'lTYPE' => '1'
	    ]);

    	if($q) { exit('disliked'); } else { exit('not-disliked'); }
	
	}

}