<?php
/**
 *	Expozart
 *	Auth functions:	les fonctions en rapports avec l'authentification 
 *	Code:	yitzakD
 */



/**
 * 	exAuth_islogged
 *	verifie si un utilisateur est connecté et que sa session est bien créer
 *	retourne $_SESSION['userid'] ou $_SESSION['username']
 */
if(!function_exists('exAuth_islogged')) {

	function exAuth_islogged()
	{

		return isset($_SESSION['userid']) || isset($_SESSION['username']);

	}

}




/**
 * 	exAuth_autologin
 *	verifie les coockies afin de permettre une connexion automatique de l'utilisateur
 *	retourne 'true' si le coockie existe, et 'false' si celui-ci n'existe pas
 */
if(!function_exists('exAuth_autologin')) {
    
    function exAuth_autologin()
    {

        global $db;

        if(!empty($_COOKIE['auth'])) {

            $split = explode(':', $_COOKIE['auth']);

            if(count($split) !==  2) { return false; }

            $selector = $split[0];
            
            $token = $split[1];

            $q = $db->prepare("SELECT ex_authtokens.token, ex_authtokens.uID, ex_users.username, ex_users.usermail, ex_users.uTYPE, ex_users.hashedID, ex_users.ID FROM ex_authtokens LEFT JOIN ex_users ON ex_authtokens.uID = ex_users.ID WHERE ex_authtokens.selector = ? AND ex_authtokens.expires >= CURDATE()");

            $q->execute([$selector]);

            $data = $q->fetch(PDO::FETCH_OBJ);

            if($data) {

                if($data->token === $token) {

                    session_regenerate_id(true);

                    $_SESSION['userid'] = $data->ID;

                    $_SESSION['username'] = $data->username;

                    $_SESSION['usertype'] = $data->uTYPE;

                    $_SESSION['usermail'] = $data->usermail;

                    $_SESSION['userhash'] = $data->hashedID;

                    return true;
                    
                }

            }

        }

        return false;

    }

}




/**
 * 	exAuth_getsession($key)
 *	$key => int | string
 *	permet de recuperer les clés sauvegarder dans la session
 *	retourne $_SESSION[$key] (echappe celui-ci)
 */
if(!function_exists('exAuth_getsession')) {

    function exAuth_getsession($key)
    {

        if($key) { return !empty($_SESSION[$key]) ? e($_SESSION[$key]) : null; }

    }

}




/**
 * 	exAuth_getsession($key)
 *	$key => int | string
 *	permet de recuperer les clés sauvegarder dans la session
 *	retourne $_SESSION[$key] (echappe celui-ci)
 */
if(!function_exists('remember_me')) {
    
    function remember_me($user_id) {

        global $db;

        $token = openssl_random_pseudo_bytes(24);

        do {
            
            $selector = openssl_random_pseudo_bytes(9);

        } while(cell_count('ex_authtokens', 'selector', $selector) > 0);

        
        $q = $db->prepare("INSERT INTO ex_authtokens(uID, expires, selector, token) VALUES(:uID, DATE_ADD(NOW(), INTERVAL 365 DAY), :selector, :token)");

        $q->execute([
            'uID' => $user_id,
            'selector' => $selector,
            'token' => $token
        ]);

        #   Contenu => base64_encode(selector).':'.base64_encode(token)
        setcookie(
            'auth',
            base64_encode($selector).':'.base64_encode($token),
            time()+31536000,
            null,
            null,
            false,
            true
        );

    }

}