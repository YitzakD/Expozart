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
		
		#	$exVar_artwork = ex_findone("ex_arts", "arthash", $ID);
		
		$q = $db->prepare("SELECT ex_arts.ID, ex_arts.uID, ex_arts.cID, ex_arts.tID, ex_arts.artcontent, ex_arts.arthash, ex_arts.created, ex_media.fileroad_sm FROM ex_arts INNER JOIN ex_media ON ex_arts.ID = ex_media.salt WHERE (ex_arts.arthash=?) AND ex_media.fileusability='1'");
	    	
		$q->execute([$ID]);
		
		$data = $q->fetch(PDO::FETCH_OBJ);
		
		$q->closeCursor();

		$exVar_artwork = $data;

		$counter = ex_findall("ex_arts", "WHERE cID IN(SELECT cID FROM ex_usercategories WHERE uID=" . exAuth_getsession("userid") . ") ORDER BY ex_arts.ID DESC");

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
				"fileroad_sm" => $exVar_artwork->fileroad_sm,
				"created" => $exVar_artwork->created,
				"next" => $next,
				"prev" => $prev
			);

			echo json_encode($artwork, JSON_FORCE_OBJECT);

		} else {

			$artwork = $exVar_artwork;

			ob_start();

			#	$artworkmedia = ex_findone("ex_media", "salt", $artwork->ID, "AND fileusability='1'");

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