<?php
/**
 *	Expozart
 *	artwork media post ajax app:	Enregitre les media de l'artwork
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



$y = count($_FILES['aFile']['tmp_name']);

$w = $_POST["arthash"];


$exVar_ext = ex_findall("ex_allowedext");

$bigpath = $RESOURCES . "/public/media/uploads/";

if(!file_exists($bigpath . exAuth_getsession('userid'))) {

	mkdir($bigpath . exAuth_getsession('userid'), 0777);

}
	
if(!file_exists($bigpath . exAuth_getsession('userid') . "/artworks")) {

	mkdir($bigpath . exAuth_getsession('userid') . "/artworks", 0777);

}



$r = $db->prepare("INSERT INTO ex_userlastactivity(uID, lastactivity) VALUES(:uID, :lastactivity)");         

$r->execute([
    'uID' => exAuth_getsession('userid'),
    'lastactivity' => date('Y-m-d H:i:s')
]);



$realpath = $bigpath . exAuth_getsession('userid') . "/artworks/";


$q = $db->prepare("INSERT INTO ex_arts(uID, arthash, created) VALUES(:uID, :arthash, :created)");

$q->execute([
    'uID' => exAuth_getsession('userid'),
    'arthash' => $w,
    'created' => date('Y-m-d H:i:s')
]);


$a_ID = $db->lastInsertId();

$info = ex_findone("ex_arts", "ID", $a_ID);




foreach($_FILES['aFile']['tmp_name'] as $key => $value) {

	$fileExt = strtolower(pathinfo($_FILES['aFile']['name'][$key],PATHINFO_EXTENSION));

	$oldname = $_FILES['aFile']['name'][$key];
	
	$unicFilename = ex_hashgenerator(25, 'AN-1');


	$_FILES['aFile']['name'][$key] = $unicFilename . "." . $fileExt;

	$filename = $_FILES['aFile']['name'][$key];

	$targetfile = $realpath . $filename;

	$fileroad = $WURI . '/resources/public/media/uploads/' . exAuth_getsession('userid') . '/artworks/' . $filename;

	if($fileExt === "jpeg") { $fext = "1"; } 
	elseif($fileExt === "png") { $fext = "2"; }
	elseif($fileExt === "gif") { $fext = "3"; }
	elseif($fileExt === "jpg") { $fext = "4"; }

	$s = $db->prepare("INSERT INTO ex_media(uID, filename, file_ext, fileroad, fileroad_sm, salt, filehash, fileusability) VALUES(:uID, :filename, :file_ext, :fileroad, :fileroad_sm, :salt, :filehash, :fileusability)");

	$s->execute([
	    'uID' => exAuth_getsession('userid'),
	    'filename' => $oldname,
	    'file_ext' => $fext,
	    'fileroad' => $fileroad,
	    'fileroad_sm' => $fileroad,
	    'salt' => $a_ID,
	    'filehash' => $unicFilename,
	    'fileusability' => "1"
	]);

	if($fileExt === "jpg" || $fileExt === "png" || $fileExt === "jpeg" || $fileExt === "gif") {
		
		move_uploaded_file($value, $targetfile);

	}



	$y = $y - 1;

}


if($y === 0)
	
	exit($w);

else

	exit("nfy");


?>