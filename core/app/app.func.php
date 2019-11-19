<?php
/**
 *	Expozart
 *	Auth functions:	les fonctions en rapports avec l'authentification 
 *	Code:	yitzakD
 */





/**
 * 	exApp_getparm($key)
 *	$key => obj
 *	permet de rcuperer à la volée les paramêtres de l'url
 * 	retourne $parm
 */
function exApp_getparm($key)
{
	
	$parm = explode('/', $key);

	return $parm;

}

$m = exApp_getparm($_SERVER['REQUEST_URI']);

$MOD = $m[1];

if(count($m) > 2) {

	$CON = $m[2];

	if(isset($m[3])) { $VUE = $m[3]; }

	if(isset($m[4])) { $RVUE = $m[4]; }

	$ID = end($m);

}





/**
 * 	exApp_sendmail($key)
 *	$key => obj
 *	permet de rcuperer à la volée les paramêtres de l'url
 * 	retourne $parm
 */
if(!function_exists('exApp_sendmail')) {

    function exApp_sendmail($name, $to, $pass, $type)
    {

        /**
         *  1   =>  Confirmation de mail
         *  2   =>  Modification du mail
         *  3   =>  Modification de mot de passe
         */

        if($type === 1) {

            $subject = "Activation de votre compte " . ucfirst(WEBSITE_NAME);

            $token = sha1($name.$to.$pass);

        } elseif($type === 2) {

            $subject = "Modification de votre adresse e-mail principale";

        } elseif($type === 3) {

            $subject = "Modification de votre mot de passe";
            
        }

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ' . WEBSITE_NAME . ' <' . NOREPLY_MAIL . '>' . "\r\n" .
            'Reply-To: ' . '<' . NOREPLY_MAIL . '>' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            

        $array = compact("to", "subject", "headers", "token");

        return $array;

    }

}