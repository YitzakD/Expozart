<?php
/**
 *	Expozart
 *	Auth functions:	les fonctions en rapports avec l'authentification 
 *	Code:	yitzakD
 */



/**
 * 	exdump
 *	permet de faire un var dump à l'intérieur d'une balise <PRE> pour mieux identifier le résultat
 */
if(!function_exists('exdump')) {

    function exdump($val)
    {

        echo "<pre>"; 

            var_dump($val);

        echo "</pre>";

    }
    
}




/**
 * 	extitle($key)
 *	$key => url param
 *	permet d'assigner le titre de la page chargée automatiquement
 *	retourne $key (la première lettre en majuscule)
 */
if(!function_exists('extitle')) {

    function extitle($key)
    {
        
        return ucfirst($key);    

    }

}




/**
 * 	exrandomcolor
 *	permet de créer une couleur aléatoire à la volée
 *	retourne une couleur en mode rgba() 
 */
if(!function_exists('exrandomcolor')) {

    function exrandomcolor()
    {
     
        return sprintf("%02X%02X%02X", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
     
    }

}




/**
 * 	setflashnotification($message, $type)
 *	$message => string; $type[ifo, success, danger, warning, light, dark, priary, secondary]
 *	permet de créer et de gérer le système de notification flash
 */
if(!function_exists('setflashnotification')) {

    function setflashnotification($message, $type = 'info')
    {
     
        $_SESSION['ntf']['message'] = $message;

        $_SESSION['ntf']['type'] = $type;
     
    }

}




/**
 * 	exhashgenerator($qte, $type)
 *	$qte => int; $type [ANSC, AN-0, AN-1, A-0, A-1, A-2, N, NSC]
 *	permet de créer un hash former de x entité
 *	retourne $hash
 */
if(!function_exists('exhashgenerator')) {

    function exhashgenerator($qte, $type)
    {

        if($type = "ANSC") {

        	$caracteres = "ABCDEFGHIJKLMOPQRSTUVXWYZabcdefghijklmnopqrstuvwxyz0123456789!&~-_%";
        
        } elseif($type = "AN-0") {

        	$caracteres = "ABCDEFGHIJKLMOPQRSTUVXWYZabcdefghijklmnopqrstuvwxyz0123456789";

        } elseif($type = "AN-1") {

        	$caracteres = "abcdefghijklmnopqrstuvwxyz0123456789";

        } elseif($type = "A-0") {

        	$caracteres = "ABCDEFGHIJKLMOPQRSTUVXWYZabcdefghijklmnopqrstuvwxyz";

        } elseif($type = "A-1") {

        	$caracteres = "ABCDEFGHIJKLMOPQRSTUVXWYZ";

        } elseif($type = "A-2") {

        	$caracteres = "abcdefghijklmnopqrstuvwxyz";

        } elseif($type = "N") {

        	$caracteres = "0123456789";

        } elseif($type = "NSC") {

        	$caracteres = "0123456789!&~-_%";

        }

        $quantidadeCaracteres = strlen($caracteres);

        $quantidadeCaracteres--;


        $hash = NULL;

        for ($x = 1; $x <= $qte; $x++) {

            $posicao = rand(0, $quantidadeCaracteres);

            $hash .= substr($caracteres, $posicao, 1);

        }

        return $hash;

    }

}




/**
 * 	e($string)
 *	$string => string
 *	échape les valeurs entrées par les utilisateurs afin d'eviter certaines attaques basiques
 *	retourne $string
 */
if(!function_exists('e')) {

    function e($string)
    {

        if($string) { return htmlspecialchars(strip_tags($string)); }

    }

}




/**
 * 	redirect($page)
 *	$page => url
 *	permet de faire une redirection simple
 *	redirige vers $page
 */
if(!function_exists('redirect')) {

    function redirect($page)
    {

        header('Location: ' . $page);

        exit();

    }

}