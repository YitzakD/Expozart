<?php
/**
 *	Expozart
 *	artwork-critics-updater ajax app:	gère les MAJ des commentaires
 *	Code:	yitzakD
 */




/** Constantes d'environnement	*/
$WEBROOT = dirname(dirname(dirname(__FILE__)));

$ROOT = dirname(dirname($WEBROOT));

$DS = DIRECTORY_SEPARATOR;

$CORE = $ROOT.$DS.'core';


$URI = $_SERVER["HTTP_REFERER"];

$URL = array_filter(explode('http://', $URI));

$URL = explode('/', $URI, -1);

$WURI = $URL[0] . '//' . $URL[2];


session_start();

include_once $CORE.$DS.'database/db-config.php';

include_once $CORE.$DS.'app/global.func.php';

include_once $CORE.$DS.'app/auth.func.php';

include_once $CORE.$DS.'includes/account.var.php';

if(isset($_POST["aid"]) && is_numeric($_POST["aid"])) {

	extract($_POST);

	$q = $db->prepare("UPDATE ex_comments SET commentbody=:commentbody WHERE ID=:ID");

	$q->execute([
        'commentbody' => $commentbody,
        'ID' => $aid,
    ]);

	if(!$q) { exit("not-updated"); } else { echo $commentbody; }

}
