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


ob_start();

if((isset($CON) && $CON === "edit")) {

	if((isset($VUE) && $VUE === "avatar")) {

		require $SUBPAGE . "account.avatar.php";

	}

	elseif((isset($VUE) && $VUE === "password")) {

		#

	}

	elseif((isset($VUE) && $VUE === "activity")) {

		#

	}

	else {

		if(ex_isalreadyuse("ex_userinfos", "uID", exAuth_getsession("userid"))) {

			global $exVar_userInformation;

			#	ex_dump($exVar_userInformation);

			$EXuserinfo = $exVar_userInformation;

		} else {




		}

		require $SUBPAGE . "account.main.php";

	}

}

$__account = ob_get_clean();

#   Template
require VIEWS . '/' . ucfirst('account') . '/account.php';

?>
