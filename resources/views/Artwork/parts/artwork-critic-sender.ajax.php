<?php
/**
 *	Expozart
 *	artwork-critic-sender ajax app:	gère les enregistrement de commentaires
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

if(isset($_POST["artworkid"]) && is_numeric($_POST["artworkid"])) {

	extract($_POST);

	$q = $db->prepare("INSERT INTO ex_comments(uID, aID, cTYPE, commentbody, created) VALUES(:uID, :aID, :cTYPE, :commentbody, :created)");

	$q->execute([
        'uID' => exAuth_getsession("userid"),
        'aID' => $artworkid,
        'cTYPE' => '1',
        'commentbody' => $msg,
        'created' => date('Y-m-d H:i:s')
    ]);

	if(!$q) {

		exit('critic-not-send');  

	} else {

		$artworkcritics = ex_cellcount("ex_comments", "aID", $artworkid, "AND cTYPE='1'");

		echo $artworkcritics;

	}

}