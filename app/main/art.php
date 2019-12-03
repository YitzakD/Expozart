<?php
/**
 *	Expozart
 *	art app:	afichage de l'artwork sélectionné et des artworks de la même catégorie
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

if(isset($CON) && ($CON == $ID)) {

	if(ex_isalreadyuse("ex_arts", "arthash", $ID) > 0) {

		/**
		 *  exVar_artwork
		 *  permet de récupérer à la volée un artwork
		 */
		$exVar_artwork = ex_findone("ex_arts", "arthash", $ID);



		$createdtime = strtotime($exVar_artwork->created);

		$created = ex_getTimeAgo($createdtime);



		$artworkmedia = ex_findone("ex_media", "salt", $exVar_artwork->ID, "AND fileusability='1'");

		if(!$artworkmedia) { $fileroad = ""; } else { $fileroad = $artworkmedia->fileroad_sm; }



		$artworkowner = ex_findone("ex_users", "ID", $exVar_artwork->uID);

		if(!$artworkowner) { $exUsername = "Expozart"; } else { $exUsername = $artworkowner->username; }

		$in =  explode(" ", $exUsername);

		$artworkownerAvatar = ex_findone("ex_media", "uID", $exVar_artwork->uID, "AND salt='$exVar_artwork->uID' AND fileusability='0'");

		if(!$artworkownerAvatar) { $avatar = false; $useravatar = $avatarname = $in[0][0]; }

		else { $avatar = true; $useravatar = $artworkownerAvatar->fileroad_sm; }



		$artworklikes = ex_cellcount("ex_likes", "aID", $exVar_artwork->ID, "AND lTYPE='1'");

		$artworkcritics = ex_cellcount("ex_comments", "aID", $exVar_artwork->ID, "AND cTYPE='1'");



		$logeduseralreadyliked = ex_cellcount("ex_likes", "aID", $exVar_artwork->ID, "AND uID=" . exAuth_getsession("userid") . " AND lTYPE='1'");
		
		$q = $db->prepare("
			SELECT 
			ex_arts.*, 
			ex_media.fileroad_sm AS newfileroad
			FROM ex_arts 
			INNER JOIN ex_media 
			ON ex_arts.ID = ex_media.salt 
			WHERE cID IN(SELECT cID FROM ex_usertopics WHERE uID=:userid) 
			AND ex_media.fileusability='1' ORDER BY ex_arts.ID DESC
		");

        $q->execute(['userid' => exAuth_getsession("userid")]);

        $data = $q->fetchAll(PDO::FETCH_OBJ);

       	$counter = $data;

		$currentKey = array_search($exVar_artwork->ID, array_column($counter, 'ID'));

		$next = ex_nextElement($counter, $currentKey);

		$prev = ex_prevElement($counter, $currentKey);


		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

			$artwork = array(
				"ID" => $exVar_artwork->ID,
				"arthash" => $ID,
				"uID" => $exVar_artwork->uID,
				"cID" => $exVar_artwork->cID,
				"tID" => $exVar_artwork->tID,
				"artcontent" => $exVar_artwork->artcontent,
				"newfileroad" => $fileroad,
				"created" => $created,
				"username" => ucfirst($exUsername),
				"avatar" => $avatar,
				"useravatar" => $useravatar,
				"userliked" => $logeduseralreadyliked,
				"likes" => $artworklikes,
				"critics" => $artworkcritics,
				"next" => $next,
				"prev" => $prev
			);

			echo json_encode($artwork, JSON_FORCE_OBJECT);

		} else {

			$artwork = $exVar_artwork;



			$createdtime = strtotime($artwork->created);

			$created = ex_getTimeAgo($createdtime);



			$artworkmedia = ex_findone("ex_media", "salt", $artwork->ID, "AND fileusability='1'");

			if(!$artworkmedia) { $fileroad = ""; } else { $fileroad = $artworkmedia->fileroad_sm; }

			

			$artworkowner = ex_findone("ex_users", "ID", $artwork->uID);

			if(!$artworkowner) { $exUsername = "Expozart"; } else { $exUsername = $artworkowner->username; }

			$in =  explode(" ", $exUsername);

			

			$artworkownerAvatar = ex_findone("ex_media", "uID", $artwork->uID, "AND salt='$artwork->uID' AND fileusability='0'");

			if(!$artworkownerAvatar) { $avatar = false; $useravatar = $avatarname = $in[0][0]; }

			else { $avatar = true; $useravatar = $artworkownerAvatar->fileroad_sm; }

			
			$artworklikes = ex_cellcount("ex_likes", "aID", $artwork->ID, "AND lTYPE='1'");

			$artworkcritics = ex_cellcount("ex_comments", "aID", $artwork->ID, "AND cTYPE='1'");



			$logeduseralreadyliked = ex_cellcount("ex_likes", "aID", $exVar_artwork->ID, "AND uID=" . exAuth_getsession("userid") . " AND lTYPE='1'");


			$userAvatar = ex_findone("ex_media", "uID", exAuth_getsession("username"), "AND salt='" . exAuth_getsession("username") . "' AND fileusability='0'");

			

			ob_start();

			require $SUBPAGE . '/artwork.main.php';

			$__artwork = ob_get_clean();


			#   Template
			require VIEWS . '/' . ucfirst($MOD) . '/' . $MOD . '.php';


		}

	} else {

		redirect(WURI . '/404');

	}

} else {

	echo "Ce travail a été déplacer ou n'existe plus sur " . WEBSITE_NAME;

}

?>