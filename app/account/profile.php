<?php
/**
 *	Expozart
 *	profile app:	gére la page de proofile
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

global $MOD; global $CON; global $VUE; global $RVUE;

$SUBPAGE = VIEWS . '/' . ucfirst('account') . '/parts/';


if(ex_isalreadyuse("ex_users", "username", $MOD)) {

	$userInfos = ex_findone("ex_users", "username", $MOD);

	$userAvatar = ex_findone("ex_media", "uID", $userInfos->ID, "AND salt='$userInfos->ID' AND fileusability='0'");

	if($userAvatar) {

		$avatar = true;
		$profileAvatar = $userAvatar->fileroad_sm;

	} else {

		$avatar = false;
		$in =  explode(" ", $userInfos->username);
		if(isset($in[1][0])) { $profileAvatar = $in[0][0].$in[1][0]; } else { $profileAvatar = $in[0][0]; }

	}


	$userArtworkposts = ex_cellcount("ex_arts", "uID", $userInfos->ID);

	$userTopics = ex_cellcount("ex_topics", "uID", $userInfos->ID);

	$userTopicsregistration = ex_cellcount("ex_usertopics", "uID", $userInfos->ID);

	


} else {

	ex_setflashnotification("Nous n'arrivons à trouver cet utilisateur, peut-être se cache t-il?" . "&nnbsp;<i class='far fa-lg fa-laugh-beam'></i>", "info");

	ex_redirect(WURI . '/unfound/user/' . $MOD);

}


ob_start();

if ((isset($CON) && $CON === "topics")) {

	#

	require $SUBPAGE . "topics.php";

}

elseif((isset($CON) && $CON === "likes")) {

	#

	require $SUBPAGE . "liked-posts.php";

}

elseif((isset($CON) && $CON === "posts")) {

	#

	require $SUBPAGE . "posts.php";

}

else {

	#

	require $SUBPAGE . "posts.php";

}

$__profile = ob_get_clean();

#   Template
require VIEWS . '/' . ucfirst('account') . '/profile.php';

?>
