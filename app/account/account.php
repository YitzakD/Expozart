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


/*if(ex_isalreadyuse("ex_users", "username", $MOD)) {

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


	if(ex_isalreadyuse("ex_userinfos", "uID", $userInfos->ID)) {

		$userMoreInfos = ex_findone("ex_userinfos", "uID", $userInfos->ID);

	}

	


} else {

	ex_setflashnotification("Nous n'arrivons à trouver cet utilisateur, peut-être se cache t-il?" . "&nbsp;<i class='far fa-lg fa-laugh-beam'></i>", "info");

	ex_redirect(WURI . '/unfound/user/' . $MOD);

}*/


ob_start();

if((isset($CON) && $CON === "edit")) {

	if((isset($VUE) && $VUE === "avatar")) {

		$userInfos = ex_findone("ex_users", "username", exAuth_getsession("username"));

		$userAvatar = ex_findone("ex_media", "uID", $userInfos->ID, "AND salt='$userInfos->ID' AND fileusability='0'");

		if($userAvatar) {

			$avatar = true;
			$profileAvatar = $userAvatar->fileroad_sm;

		} else {

			$avatar = false;
			$in =  explode(" ", $userInfos->username);
			if(isset($in[1][0])) { $profileAvatar = $in[0][0].$in[1][0]; } else { $profileAvatar = $in[0][0]; }

		}

		require $SUBPAGE . "account.avatar.php";

	}

	elseif((isset($VUE) && $VUE === "password")) {

		#

	}

	elseif((isset($VUE) && $VUE === "activity")) {

		#

	}

	else {

		#require $SUBPAGE . "topics.php";

	}

}

$__account = ob_get_clean();

#   Template
require VIEWS . '/' . ucfirst('account') . '/account.php';

?>
