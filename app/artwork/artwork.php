<?php
/**
 *	Expozart
 *	artwork app:	afichage de l'artwork sélectionné et des artworks de la même catégorie
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

$SUBPAGE = VIEWS . '/' . ucfirst("artwork") . '/parts/';

if(isset($CON) && ($CON == $ID) && (ex_isalreadyuse("ex_arts", "arthash", $ID) > 0)) {

	/**
	 *  exVar_artwork
	 *  permet de récupérer à la volée un artwork
	 */
	$exVar_artwork = ex_findone("ex_arts", "arthash", $ID);



	$createdtime = strtotime($exVar_artwork->created);

	$created = ex_getTimeAgo($createdtime);


	$tastMediacount = ex_cellcount("ex_media", "salt", $exVar_artwork->ID, "AND fileusability='1'");

	if($tastMediacount > 1) {

		$artworkmedia = ex_findall("ex_media", "WHERE salt='$exVar_artwork->ID' AND fileusability='1'");

	} else {

		$artworkmedia = ex_findone("ex_media", "salt", $exVar_artwork->ID, "AND fileusability='1'");

		if(!$artworkmedia) { $fileroad = ""; } else { $fileroad = $artworkmedia->fileroad_sm; }

	}

	/*$artworkmedia = ex_findone("ex_media", "salt", $exVar_artwork->ID, "AND fileusability='1'");

	if(!$artworkmedia) { $fileroad = ""; } else { $fileroad = $artworkmedia->fileroad_sm; }*/



	$artworkowner = ex_findone("ex_users", "ID", $exVar_artwork->uID);

	if(!$artworkowner) { $exUsername = "Expozart"; } else { $exUsername = $artworkowner->username; }

	$in =  explode(" ", $exUsername);

	$artworkownerAvatar = ex_findone("ex_media", "uID", $exVar_artwork->uID, "AND salt='$exVar_artwork->uID' AND fileusability='0'");

	if(!$artworkownerAvatar) { $avatar = false; $useravatar = $avatarname = $in[0][0]; }

	else { $avatar = true; $useravatar = $artworkownerAvatar->fileroad_sm; }



	$artworklikes = ex_cellcount("ex_likes", "aID", $exVar_artwork->ID, "AND lTYPE='1'");

	$artworkcritics = ex_cellcount("ex_comments", "aID", $exVar_artwork->ID, "AND cTYPE='1'");



	$logeduseralreadyliked = ex_cellcount("ex_likes", "aID", $exVar_artwork->ID, "AND uID=" . exAuth_getsession("userid") . " AND lTYPE='1'");

	$artwork = $exVar_artwork;

	$userAvatar = ex_findone("ex_media", "uID", exAuth_getsession("username"), "AND salt='" . exAuth_getsession("username") . "' AND fileusability='0'");

	

	ob_start();

	require $SUBPAGE . '/artwork.main.php';

	$__artwork = ob_get_clean();


	#   Template
	require VIEWS . '/' . ucfirst("artwork") . '/artwork.php';


	/*}*/

} else {

	ex_setflashnotification("Nous n'arrivons pas à trouver cet artwork, peut-être a t-il été déplacer?" . "&nbsp;<i class='far fa-lg fa-grin-beam-sweat'></i>", "info");

	ex_redirect(WURI . '/unfound/a/' . $ID);

}

?>