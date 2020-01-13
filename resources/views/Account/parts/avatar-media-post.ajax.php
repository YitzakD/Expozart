<?php
/**
 *	Expozart
 *	avatar media post ajax app:	Enregitre les media de l'avatar
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



$y = count($_FILES['avf']['tmp_name']);


$exVar_ext = ex_findall("ex_allowedext");

$bigpath = $RESOURCES . "/public/media/uploads/";

if(!file_exists($bigpath . exAuth_getsession('userid'))) {

	mkdir($bigpath . exAuth_getsession('userid'), 0777);	

}
	
if(!file_exists($bigpath . exAuth_getsession('userid') . "/avatar")) {

	mkdir($bigpath . exAuth_getsession('userid') . "/avatar", 0777);

}



$r = $db->prepare("INSERT INTO ex_userlastactivity(uID, lastactivity) VALUES(:uID, :lastactivity)");         

$r->execute([
    'uID' => exAuth_getsession('userid'),
    'lastactivity' => date('Y-m-d H:i:s')
]);



$realpath = $bigpath . exAuth_getsession('userid') . "/avatar/";

$info = ex_findone("ex_media", "ID", exAuth_getsession("userid"), " AND salt='" . exAuth_getsession("userid") . "' AND fileusability='0'");




foreach($_FILES['avf']['tmp_name'] as $key => $value) {

	$fileExt = strtolower(pathinfo($_FILES['avf']['name'][$key],PATHINFO_EXTENSION));

	$oldname = $_FILES['avf']['name'][$key];
	
	$unicFilename = ex_hashgenerator(14, 'N');


	$_FILES['avf']['name'][$key] = $unicFilename . "." . $fileExt;

	$filename = $_FILES['avf']['name'][$key];

	$targetfile = $realpath . $filename;

	$fileroad = $WURI . '/resources/public/media/uploads/' . exAuth_getsession('userid') . '/avatar/' . $filename;

	if($fileExt === "jpeg") { $fext = "1"; } 
	elseif($fileExt === "png") { $fext = "2"; }
	elseif($fileExt === "gif") { $fext = "3"; }
	elseif($fileExt === "jpg") { $fext = "4"; }

	if(ex_isalreadyuse("ex_media", "uID", exAuth_getsession("userid"), " AND salt='" . exAuth_getsession("userid") . "' AND fileusability='0'")) {

		$avi = ex_findone("ex_media", "uID", exAuth_getsession("userid"), " AND salt='" . exAuth_getsession("userid") . "' AND fileusability='0'");

		$s = $db->prepare("UPDATE ex_media SET filename=:filename, file_ext=:file_ext, fileroad=:fileroad, fileroad_sm=:fileroad_sm, filehash=:filehash WHERE ID=:ID");

		$s->execute([
		    'filename' => $oldname,
		    'file_ext' => $fext,
		    'fileroad' => $fileroad,
		    'fileroad_sm' => $fileroad,
		    'filehash' => $unicFilename,
		    'ID' => $avi->ID
		]);

	} else {

		$s = $db->prepare("INSERT INTO ex_media(uID, filename, file_ext, fileroad, fileroad_sm, salt, filehash, fileusability) VALUES(:uID, :filename, :file_ext, :fileroad, :fileroad_sm, :salt, :filehash, :fileusability)");

		$s->execute([
		    'uID' => exAuth_getsession('userid'),
		    'filename' => $oldname,
		    'file_ext' => $fext,
		    'fileroad' => $fileroad,
		    'fileroad_sm' => $fileroad,
		    'salt' => exAuth_getsession('userid'),
		    'filehash' => $unicFilename,
		    'fileusability' => "0"
		]);

	}

	if($fileExt === "jpg" || $fileExt === "png" || $fileExt === "jpeg" || $fileExt === "gif") {
		
		move_uploaded_file($value, $targetfile);

	}



	$y = $y - 1;

}


if($y === 0)
	
	die();

else

	exit("nfy");


?>