<?php
/**
 *	Expozart
 *	post app:	Permet le post d'artwork
 *	Code:	yitzakD
 */




if(!exAuth_islogged()) {

	$fwURI = $_SERVER['REQUEST_URI'];

	$_SESSION['forwardingURI'] = $fwURI;

	ex_redirect(WURI . '/login');

}




global $router;

global $db;

global $match;

global $MOD; global $CON; global $VUE; global $RVUE; global $ID;

$SUBPAGE = VIEWS . '/' . ucfirst($MOD) . '/parts/';


$artworkowner = ex_findone("ex_users", "ID", exAuth_getsession("userid"));

if(!$artworkowner) { $exUsername = "Expozart"; } else { $exUsername = $artworkowner->username; }

$in =  explode(" ", $exUsername);

$artworkownerAvatar = ex_findone("ex_media", "uID", exAuth_getsession("userid"), "AND salt='" . exAuth_getsession("userid") . "' AND fileusability='0'");

if(!$artworkownerAvatar) { $avatar = false; $useravatar = $avatarname = $in[0][0]; }

else { $avatar = true; $useravatar = $artworkownerAvatar->fileroad_sm; }

ob_start();

if((isset($CON) && $CON === "new")) {

	require $SUBPAGE . "new.php";

}

elseif((isset($CON) && $CON === "edit")) {

	if((isset($VUE)) && $VUE === $ID && ex_isalreadyuse("ex_arts", "arthash", $VUE)) {

		#

		$artwork = ex_findone("ex_arts", "arthash", $VUE);

		$artworkmedias = ex_findall("ex_media", "WHERE uID='" . exAuth_getsession("userid") . "' AND salt='$artwork->ID' AND fileusability='1'");

		$usertopics = ex_findall("ex_usertopics", "WHERE uID='" . exAuth_getsession("userid") . "'");

		require $SUBPAGE . "edit.php";

	} else {

		ex_setflashnotification("Nous n'arrivons pas à trouver cet artwork, peut-être a t-il été déplacer?" . "&nbsp;<i class='far fa-lg fa-grin-beam-sweat'></i>", "info");

		ex_redirect(WURI . '/unfound/a/' . $ID);

	}

}

else {

	require $SUBPAGE . "new.php";

}

$__post = ob_get_clean();


#   Template
require VIEWS . '/' . ucfirst($MOD) . '/' . $MOD . '.php';

?>
