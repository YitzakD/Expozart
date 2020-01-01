<?php
/**
 *	Expozart
 *	artwork conten post ajax app:	publie le contenue d'un artwork
 *	Code:	yitzakD
 */




/** Constantes d'environnement	*/
$WEBROOT = dirname(dirname(dirname(__FILE__)));

$ROOT = dirname(dirname($WEBROOT));

$DS = DIRECTORY_SEPARATOR;

$CORE = $ROOT.$DS.'core';

$RESOURCES = $ROOT.$DS.'resources';


$URI = $_SERVER["HTTP_REFERER"];

$URL = array_filter(explode('http://', $URI));

$URL = explode('/', $URI, -1);

$WURI = $URL[0] . '//' . $URL[2];


session_start();

include_once $CORE.$DS.'database/db-config.php';

include_once $CORE.$DS.'app/global.func.php';

include_once $CORE.$DS.'app/auth.func.php';

include_once $CORE.$DS.'includes/account.var.php';



if(isset($_POST["artworkhash"]) && is_numeric($_POST["artworkhash"])) {

	extract($_POST);

	$iTopic =  ex_findone("ex_usertopics", "ID", $topic);

	$iArtwork = ex_findone("ex_arts", "arthash", $artworkhash);

	$q = $db->prepare("UPDATE ex_arts SET cID=:cID, tID=:tID, artcontent=:artcontent, created=:created WHERE ID=:ID");

	$q->execute([
        'cID' => $iTopic->cID,
        'tID' => $iTopic->tID,
        'artcontent' => $msg,
        'created' => date('Y-m-d H:i:s'),
        'ID' => $iArtwork->ID
    ]);

    $r = $db->prepare("INSERT INTO ex_userlastactivity(uID, lastactivity) VALUES(:uID, :lastactivity)");         

	$r->execute([
	    'uID' => exAuth_getsession('userid'),
	    'lastactivity' => date('Y-m-d H:i:s')
	]);

	if(!$q) {

		exit('post-not-send');  

	}

}