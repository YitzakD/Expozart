<?php
/**
 *	Expozart
 *	choice ajax app:	effectue les choix de l'utilisateur dans sa liste d'affiliation  
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

		if(!ex_isalreadyuse("ex_usercategories", "cID", $TID, "AND uID=" . exAuth_getsession("userid"))) {

			$q = $db->prepare("INSERT INTO ex_usercategories(uID, cID) VALUES(:uID, :cID)");
    
	    	$r = $db->prepare("INSERT INTO ex_usertopics(uID, tID) VALUES(:uID, :tID)");

	    	$q->execute([
	            'uID' => exAuth_getsession("userid"),
	            'cID' => $TID
	        ]);

	        $r->execute([
	            'uID' => exAuth_getsession("userid"),
	            'tID' => $TID
	        ]);

		} else { exit('alreadyused'); }

	}

}

?>