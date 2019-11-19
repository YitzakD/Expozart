<?php
/**
 *	Expozart
 *	confirm app:	confirmation de l'utilisateur en lui envoyant un mail de confirmation
 *	Code:	yitzakD
 */




global $router;

global $db;

global $match;

global $MOD; global $CON; global $VUE; global $RVUE;

$SUBPAGE = VIEWS . '/Auth/' . $MOD . '/parts/';

ob_start();

if(isset($VUE) && ex_isalreadyuse("ex_users", "hashedID", $VUE)) {

	$data = ex_findone("ex_users","hashedID", $VUE);

	$userID = $data->ID;

	$username = $data->username;

	$usermail = $data->usermail;

	$userpass = $data->userpass;

	$userhashID = $data->hashedID;

	$userdata = ex_findone("ex_useragregation", "uID", $userID);



	if(isset($RVUE) && $RVUE == 'resent') {

		if(isset($_POST["resentsubmit"])) {
	
			ex_updateall("ex_useragregation", "sendstate", "2", "WHERE uID='$userID'");

			ex_setflashnotification("Un autre mail de confirmation a été envoyé à l'adresse: <a href='#'>" . $usermail . "</a>.", "info");

    		ex_redirect(WURI . '/confirm/user/' . $VUE);

		}

	}



	if($userdata->sendstate === "0" || $userdata->sendstate === "2") {

		$x = exApp_sendmail($username, $usermail, $userpass, 1);

		extract($x);

		ob_start();

		    require EX_EMAILS . '/confirmation-mail.php';

		$content = ob_get_clean();

		mail($to, $subject, $content, $headers);

		$q = $db->prepare("UPDATE ex_useragregation SET token = :token, sendstate = :sendstate WHERE uID = :uID");


	    $q->execute([
	        'token' => $token,
	        'sendstate' => "1",
	        'uID' => $userID
	    ]);

	}

}

require $SUBPAGE . 'informations.php';

$__confirmation = ob_get_clean();

#   Template
require VIEWS . '/Auth/' . $MOD . '/' . $MOD . '.php';

?>