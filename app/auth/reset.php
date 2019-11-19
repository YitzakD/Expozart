<?php
/**
 *	Expozart
 *	recovery app:	retrouve les aggrégations de l'utilisateur en fonction  des paramêtres
 *	Code:	yitzakD
 */




if(exAuth_islogged()) { ex_redirect(WURI); }

global $router;

global $db;

global $match;

global $MOD; global $CON; global $VUE;

$SUBPAGE = VIEWS . '/Auth/' . $MOD . '/parts/';

ob_start();

if ((isset($CON) && $CON === "user") && isset($VUE) && ex_isalreadyuse("ex_users", "hashedID", $VUE)) {
	
	$x = ex_findone("ex_users", "hashedID", $VUE);

	if(isset($_POST["resetsubmit"])) {

		$error = [];

		if(ex_notempty(['newuserpass', 'newuserpass_confirm'])) {

			extract($_POST);

        	if(mb_strlen($newuserpass) < 6) {

	            $error[1] = "Le mot de passe saisi est trop court. Six (6) caractères min.";

	        }

	        if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $newuserpass)) {

	            ex_setflashnotification("Pour plus de sécurité, votre mot de passe doit :<ul class='m-0'><li>Contenir six (6) caractères minimum,</li><li>Contenir au moins une lettre MAJUSCULE,</li><li>Contenir un ou plusieurs chiffres.</li></ul>", "info");

	            $error[1] = "Le mot de passe saisi est incomplet.";
	        
	        }

	        if($newuserpass_confirm !== $newuserpass) {

	        	$error[2] = "Les deux mots de passe doivent être identiques.";

	        }



        	if(count($error) == 0) {

	        	if(exAuth_paswordverifying($newuserpass, $x->userpass)) {

	        		 ex_setflashnotification("Le nouveau mot de passe saisi ressemble étrangement à l'ancien.", "danger");
	        	
	        	} else {

	        		$hashpassword = exAuth_paswordhashing($newuserpass);

					$y = exApp_sendmail($x->username, $x->usermail, $hashpassword, 3);

					extract($y);

					ob_start();

					    require EX_EMAILS . '/password-exchange-mail.php';

					$content = ob_get_clean();

					mail($to, $subject, $content, $headers);

	        		$q = $db->prepare("UPDATE ex_users SET userpass=:userpass, updated=:updated WHERE ID=:ID AND hashedID=:hashedID");
	            
		            $q->execute([
		                'userpass' => $hashpassword,
		                'updated' => date('Y-m-d H:i:s'),
		                'ID' => $x->ID,
		                'hashedID' => $x->hashedID
		            ]);

		            ex_setflashnotification("Votre mot de passe a été réinitialiser avec succès.", "success");

					ex_redirect(WURI . '/login');

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
	
}

$__reset = ob_get_clean();

#   Template
require VIEWS . '/Auth/' . $MOD . '/' . $MOD . '.php';

?>