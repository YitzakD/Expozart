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

	if(!ex_cellcount("ex_likes", "aID", $aid, "AND uID=" . exAuth_getsession("userid") . " AND lTYPE='1'")) {

		$q = $db->prepare("INSERT INTO ex_likes(uID, aID, lTYPE, created) VALUES(:uID, :aID, :lTYPE, :created)");

		$q->execute([
	        'uID' => exAuth_getsession("userid"),
	        'aID' => $aid,
	        'lTYPE' => '1',
	        'created' => date('Y-m-d H:i:s')
	    ]);

    	if($q) {

    		$newcount = ex_cellcount("ex_likes", "aID", $aid, "AND lTYPE='1'");

    		echo ex_getRealnumber($newcount); 

    	} else { exit('not-liked'); }
	
	}

}