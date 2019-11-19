<?php
/**
 *	Expozart
 *	login app:	gére la connexion des utilisateurs
 *	Code:	yitzakD
 */



if(exAuth_islogged()) { ex_redirect(WURI); }

global $router;

global $db;

global $MOD;

$SUBPAGE = VIEWS . '/Auth/' . $MOD . '/parts/';

ob_start();

if(isset($_POST["loginsubmit"])) {

	$error = [];

	if(ex_notempty(['identifiantentry', 'passwordentry'])) {

		extract($_POST);

		if(!filter_var($identifiantentry, FILTER_VALIDATE_EMAIL)) {

            $error[1] = "L'adresse e-mail saisie n'est pas valide.";

        }

        if(mb_strlen($passwordentry) < 6) {

            $error[1] = "Le mot de passe saisi est incomplet. Six (6) caractères min.";

        }



        if(count($error) == 0) {

        	$q = $db->prepare("SELECT ex_users.ID, ex_users.username, ex_users.usermail, ex_users.uTYPE, ex_users.hashedID, ex_users.userpass AS hashed_password, ex_useragregation.agregation FROM ex_users INNER JOIN ex_useragregation ON ex_users.ID = ex_useragregation.uID WHERE (ex_users.usermail = :identifiant) AND ex_useragregation.agregation = '1'");
            
            $q->execute(['identifiant' => $identifiantentry]);

            $user = $q->fetch(PDO::FETCH_OBJ);

            if($user && exAuth_paswordverifying($passwordentry, $user->hashed_password)) {

                $_SESSION['userid'] = $user->ID;
                
                $_SESSION['username'] = $user->username;
                
                $_SESSION['usertype'] = $user->uTYPE;

                $_SESSION['usermail'] = $user->usermail;

                $_SESSION['userhash'] = $user->hashedID;

                ex_updateall("ex_users", "uSTATE", "1", "WHERE ID='$user->ID'");

                ex_updateall("ex_userlastactivity", "lastactivity", date('Y-m-d'), "WHERE uID='$user->ID'");
                

                if(ex_cellcount("ex_userprefs", "uID", $user->ID) < 1) {

                    $r = $db->prepare("INSERT INTO ex_userprefs(uID) VALUES(:uID)");

                    $r->execute(['uID' => $user->ID]);

                	ex_setflashnotification("Vous êtes bien connecté(e) sur" . '&nbsp;' . ucfirst(WEBSITE_NAME), "success");

                }

                if(ex_cellcount("ex_usercategories", "uID", $user->ID) < 1) {

                	ex_redirect(WURI . '/categories');

	            } else {

	                if(isset($_SESSION["forwardingURI"])) { ex_redirect(WURI . $_SESSION["forwardingURI"]); }

	                else { ex_redirect(WURI); }

	            }

            } else {

                ex_setflashnotification("La combinaison Identifiant / Mot de passe est incorrecte.", "danger");

                ex_saveinputs();

            }

        } else {

            ex_setflashnotification("Assurez-vous d'avoir bien rempli tous les champs.", "danger");

            ex_saveinputs();

        }

	} else {

        ex_setflashnotification("Assurez-vous d'avoir bien rempli tous les champs.", "danger");

        ex_saveinputs();

    }


} else { ex_clearinputs(); }

require $SUBPAGE . $MOD . '.form.php';

$__login = ob_get_clean();

#   Template
require VIEWS . '/Auth/' . $MOD . '/' . $MOD . '.php';


?>