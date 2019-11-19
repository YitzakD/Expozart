<?php
/**
 *	Expozart
 *	register app:	gére les inscriptions des utilisateurs
 *	Code:	yitzakD
 */




if(exAuth_islogged()) { ex_redirect(WURI); }

global $router;

global $db;

global $MOD;

$SUBPAGE = VIEWS . '/Auth/' . $MOD . '/parts/';

ob_start();

if(isset($_POST["registersubmit"])) {

	$error = [];

	if(ex_notempty(['ex_username', 'ex_usermail', 'ex_userpass'])) {

		extract($_POST);

		$ex_username = trim($ex_username);

		if(mb_strlen($ex_username) < 3) {

            $error[1] = "Le nom d'utilisateur saisi est trop court. Trois (3) caractères min.";

        }

		if(ex_isalreadyuse("ex_users", "usermail", $ex_usermail) > 0) {

			set_flash("Votre adresse e-mail est déjà liée à un autre compte d'utilisateur. Assurez-vous que vous n'avez fait aucune erreurs lors de la saisie.", "info");

			$error[2] = "L'adresse e-mail saisie est déjà liée à un autre compte.";

		}

		if(!filter_var($ex_usermail, FILTER_VALIDATE_EMAIL)) {

            $error[2] = "L'adresse e-mail saisie n'est pas valide.";

        }

        if(mb_strlen($ex_userpass) < 6) {

            $error[3] = "Le mot de passe saisi est trop court. Six (6) caractères min.";

        }

        if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $ex_userpass)) {

            set_flash("Pour plus de sécurité, votre mot de passe doit :<ul class='m-0'><li>Contenir six (6) caractères minimum,</li><li>Contenir au moins une lettre MAJUSCULE,</li><li>Contenir un ou plusieurs chiffres.</li></ul>", "info");

            $error[3] = "Le mot de passe saisi est incomplet.";
        
        }



        if(count($error) == 0) {

        	$hashpassword = exAuth_paswordhashing($ex_userpass);

        	$hashedID = ex_hashgenerator(40, 'ANSC');


        	$q = $db->prepare("INSERT INTO ex_users(username, usermail, userpass, uTYPE, hashedID, updated, created) VALUES(:username, :usermail, :userpass, :uTYPE, :hashedID, :updated, :created)");
            
            $q->execute([
                'username' => $ex_username,
                'usermail' => $ex_usermail,
                'userpass' => $hashpassword,
                'uTYPE' => "2",
                'hashedID' => $hashedID,
                'updated' => date('Y-m-d H:i:s'),
                'created' => date('Y-m-d H:i:s')
            ]);

            $uid = $db->lastInsertId();

            if($uid) {

                $r = $db->prepare("INSERT INTO ex_userlastactivity(uID, lastactivity) VALUES(:uID, :lastactivity)");

                $s = $db->prepare("INSERT INTO ex_useragregation(uID, agregation) VALUES(:uID, :agregation)");

                $r->execute([
                    'uID' => $uid,
                    'lastactivity' => date('Y-m-d H:i:s')
                ]);

                $s->execute([
                    'uID' => $uid,
                    'agregation' => "0"
                ]);

            }

    		ex_redirect(WURI . '/confirm/user/' . $hashedID);

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

$__register = ob_get_clean();

#   Template
require VIEWS . '/Auth/' . $MOD . '/' . $MOD . '.php';


?>