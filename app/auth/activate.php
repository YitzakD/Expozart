<?php
/**
 *	Expozart
 *	activate app:	active le compte de l'utilisateur qui a reçu un mail de confirmation
 *	Code:	yitzakD
 */




global $router;

global $db;

global $match;

global $MOD; global $CON; global $VUE; global $RVUE;

if(isset($CON) && ex_isalreadyuse("ex_users", "hashedID", $CON) && isset($VUE)) {

	$token = $VUE;

    $hashedID = $CON;

	$data = ex_findone("ex_users", "hashedID", $hashedID);

    $userdata = ex_findone("ex_useragregation", "uID", $data->ID);

    $userID = $data->ID;

    $token_verif = $userdata->token;


    if($token == $token_verif) {
    
        ex_updateall("ex_useragregation", "agregation", "1", "WHERE uID='$userID'");
        
        ex_updateall("ex_userlastactivity", "lastactivity", date('Y-m-d'), "WHERE uID='$userID'");

        ex_setflashnotification('Votre compte à été activé avec succès. Vous pouvez à présent vous connecter.', 'success');

        ex_redirect(WURI . '/login');

    } else {

        ex_setflashnotification('Impossible de faire correspondre les paramètres reçus aux paramètres enregistrés.', 'danger');

        ex_redirect(WURI . '/login');

    }

} else { ex_redirect(WURI . '/login'); }