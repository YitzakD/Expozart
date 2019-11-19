<?php
/**
 *	Expozart
 *	Auth functions:	les fonctions en rapports avec l'authentification 
 *	Code:	yitzakD
 */




/**
 * 	ex_dump
 *	permet de faire un var dump à l'intérieur d'une balise <PRE> pour mieux identifier le résultat
 */
if(!function_exists('ex_dump')) {

    function ex_dump($val)
    {

        echo "<pre>"; 

            var_dump($val);

        echo "</pre>";

    }
    
}




/**
 * 	ex_title($key)
 *	$key => url param
 *	permet d'assigner le titre de la page chargée automatiquement
 *	retourne $key (la première lettre en majuscule)
 */
if(!function_exists('ex_title')) {

    function ex_title($key)
    {
        
        return ucfirst($key);    

    }

}




/**
 * 	ex_randomcolor
 *	permet de créer une couleur aléatoire à la volée
 *	retourne une couleur en mode rgba() 
 */
if(!function_exists('ex_randomcolor')) {

    function ex_randomcolor()
    {
     
        return sprintf("%02X%02X%02X", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
     
    }

}




/**
 * 	ex_setflashnotification($message, $type)
 *	$message => string; $type[ifo, success, danger, warning, light, dark, priary, secondary]
 *	permet de créer et de gérer le système de notification flash
 */
if(!function_exists('ex_setflashnotification')) {

    function ex_setflashnotification($message, $type = 'info')
    {
     
        $_SESSION['ntf']['message'] = $message;

        $_SESSION['ntf']['type'] = $type;
     
    }

}




/**
 * 	ex_hashgenerator($qte, $type)
 *	$qte => int; $type [ANSC, AN-0, AN-1, A-0, A-1, A-2, N, NSC]
 *	permet de créer un hash former de x entité
 *	retourne $hash
 */
if(!function_exists('ex_hashgenerator')) {

    function ex_hashgenerator($qte, $type)
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
 * 	ex_redirect($page)
 *	$page => url
 *	permet de faire une redirection simple
 *	redirige vers $page
 */
if(!function_exists('ex_redirect')) {

    function ex_redirect($page)
    {

        header('Location: ' . $page);

        exit();

    }

}




/**
 *  ex_getinput($key)
 *  $key => string
 *  permet de retourner la valeur de la clé sauver dans en SESSION en cas d'erreurs
 *  retourne $key (sauvé e session), sinon retourne 'null'
 */
if(!function_exists('ex_getinput')) {

    function ex_getinput($key)
    {

        if(!empty($_SESSION['input'][$key])) {

            return e($_SESSION['input'][$key]);

        } else {

            return null;

        }

    }

}




/**
 *  ex_notempty($field)
 *  $fields => array
 *  permet de vérifier si un tableau de variable n'est pas vide
 *  retourne 'True' si le tableau de valeur n'est pas vide, et 'false' si ce le tableau de valeur  est vide
 */
if(!function_exists('ex_notempty')) {

    #   Version globale
    function ex_notempty($fields = [])
    {

        if(count($fields) != 0) {

            foreach($fields as $field) {

                if(empty($_POST[$field]) || trim($_POST[$field]) == "") {

                    return false;

                }

            }

            return true;

        }

    }

    #   Version adaptée aux checkbox   
    function ex_notempty__($fields = [])
    {

        if(count($fields) != 0) {

            foreach($fields as $field) {

                if(empty($_POST[$field])) {

                    return false;

                }

            }

            return true;

        }

    }

}




/**
 *  ex_isalreadyuse($table, $field, $key, $additional = "")
 *  $table => string (nom de la table); $field => string (la colone de rechercher); $key => string (la valeur à rechercher); $additional => string (Autre)
 *  permet de vérifier l'unicité | l'existence d'une variable dans la BDD
 *  retourne $count (Compte du nombre de fois que la fonction est vérifiée)
 */
if(!function_exists('ex_isalreadyuse')) {

    function ex_isalreadyuse($table, $field, $key, $additional = "")
    {

        global $db;

        $q = $db->prepare("SELECT id FROM $table WHERE $field = ? $additional");

        $q->execute([$key]);

        $count = $q->rowCount();

        $q->closeCursor();

        return $count;

    }

}




/**
 *  ex_saveinputs()
 *  permet de sauver en SESSION les varibles saisies par les utilisateurs en cas d'erreurs
 */
if(!function_exists('ex_saveinputs')) {

    function ex_saveinputs()
    {

        foreach($_POST as $key => $value) {

            if(strpos($key, 'password') === false) {

                $_SESSION['input'][$key] = $value;

            }

        }

    }

}




/**
 *  ex_clearinputs()
 *  permet d'éffacer les variables sauvées en SESSION par la fonction ex_saveinputs()
 */
if(!function_exists('ex_clearinputs')) {

    function ex_clearinputs()
    {

        if(isset($_SESSION['input'])) {

            $_SESSION['input'] = [];

        }

    }

}




/**
 *  ex_findall($table, $additional = "")
 *  $table => string (nom de la table); $additional => string (Autre)
 *  permet de recuperer toutes les lignes enregistrées en fonction d'un paramètre donné
 *  retourn $data (tableau associatif)
 */
if(!function_exists('ex_findall')) {
    
    function ex_findall($table, $additional = "")
    {

        global $db;

        $q = $db->prepare("SELECT * FROM $table $additional");

        $q->execute();

        $data = $q->fetchAll(PDO::FETCH_OBJ);

        $q->closeCursor();

        return $data;

    }

    #   Version adaptée à la selection distincte
    function ex_findallDistinct($table, $field, $additional = "")
    {

        global $db;

        $q = $db->prepare("SELECT DISTINCT $field FROM $table $additional");

        $q->execute();

        $data = $q->fetchAll(PDO::FETCH_OBJ);

        $q->closeCursor();

        return $data;

    }

}




/**
 *  ex_findone($table, $field, $key, $additional = "")
 *  $table => string (nom de la table); $field => string (la colone de rechercher); $key => string (la valeur à rechercher); $additional => string (Autre)
 *  permet de recuperer toutes les lignes enregistrées en fonction d'un paramètre donné
 *  retourn $data (tableau associatif)
 */
if(!function_exists('ex_findone')) {

    function ex_findone($table, $field, $key, $additional = "")
    {

        global $db;

        $q = $db->prepare("SELECT * FROM $table WHERE $field = ? $additional");

        $q->execute([$key]);

        $data = $q->fetch(PDO::FETCH_OBJ);

        $q->closeCursor();

        return $data;

    }

    #   récup-re le dernier enregistrement
    if(!function_exists('ex_findlast')) {

        function ex_findlast($table, $additional = "ORDER BY id DESC LIMIT 1")
        {

            global $db;

            $q = $db->prepare("SELECT * FROM $table $additional");

            $q->execute();

            $data = $q->fetch(PDO::FETCH_OBJ);

            $q->closeCursor();

            return $data;

        }

    }

}




/**
 *  ex_countall($table, $additional = "")
 *  $table => string (nom de la table); $additional => string (Autre)
 *  permet de recuperer le nombre d'enregistrements trouvés d'un paramètre donné
 */
if(!function_exists('ex_countall')) {

    function ex_countall($table, $additional = "")
    {

        global $db;

        $q = $db->prepare("SELECT * FROM $table $additional");

        $q->execute();

        return $q->rowCount();

    }
}




/**
 *  ex_cellcount($table, $field, $key, $additional = "")
 *  $table => string (nom de la table); $field => string (la colone de rechercher); $key => string (la valeur à rechercher); $additional => string (Autre)
 *  permet de recuperer le nombre d'enregistrements trouvés en fonction d'un paramètre donné
 *  retourn $data (tableau associatif)
 */
 if(!function_exists('ex_cellcount')) {

    function ex_cellcount($table, $field, $key, $additional = "")
    {

        global $db;

        $q = $db->prepare("SELECT * FROM $table WHERE $field = ? $additional");

        $q->execute([$key]);

        return $q->rowCount();

    }

}




/**
 *  ex_updateone($table, $field, $value, $key)
 *  $table => string (nom de la table); $field => string (la colone de rechercher); $value => string (la valeur à rechercher); $key => int
 *  permet de mettre à jour une ligne
 */
if(!function_exists('ex_updateone')) {

    #   Version relatif à l'ID
    function ex_updateone($table, $field, $value, $key)
    {

        global $db;

        $q = $db->prepare("UPDATE $table SET $field=? WHERE ID = ? ");

        $q->execute([$value, $key]);

        $q->closeCursor();

    }

    #   Version globale et evasif
    function ex_updateall($table, $field, $value, $additional = "")
    {

        global $db;

        $q = $db->prepare("UPDATE $table SET $field = ? $additional");

        $q->execute([$value]);

        $q->closeCursor();

    }

}




/**
 *  ex_deleteone($table, $field, $key)
 *  $table => string (nom de la table); $field => string (la colone de rechercher); $key => int
 *  permet d'effacer un enregistrement donné
 */
if(!function_exists('ex_deleteone')) {

    #   Version relatif à l'ID
    function ex_deleteone($table, $field, $key)
    {

        global $db;

        $q = $db->prepare("DELETE FROM $table WHERE $field = ? ");

        $q->execute([$key]);

        $q->closeCursor();

    }

    #   Version globale et evasif
    function ex_deleteall($table, $field, $key)
    {

        global $db;

        $q = $db->prepare("DELETE FROM $table WHERE $field = ? ");

        $q->execute([$key]);

        $q->closeCursor();

    }

}




/**
 *  ex_inarray($needle, $needle_field, $haystack, $strict = false)
 *  $needle => string (valeur à comparer); $needle_field => string (nom de la valeur); $haystack => var
 *  Recherche l'existence dans un tableaux pluridimensionnel
 */
if(!function_exists('ex_inarray')) {

    function ex_inarray($needle, $needle_field, $haystack, $strict = false) {

        if($strict) {
            
            foreach($haystack as $item) {

                if(isset($item->$needle_field) && $item->$needle_field === $needle) {

                    return true;

                }

            }

        } else {

            foreach($haystack as $item) {

                if(isset($item->$needle_field) && $item->$needle_field == $needle) {

                    return true;

                }

            }

        }

        return false;

    }

}