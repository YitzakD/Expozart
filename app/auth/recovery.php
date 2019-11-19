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

global $MOD;

$SUBPAGE = VIEWS . '/Auth/' . $MOD . '/parts/';

ob_start();

if(isset($_POST["recoverysubmit"])) {

	$error = [];

    if(ex_notempty(['ex_identifiant'])) {
	
    	extract($_POST);

		if(!filter_var($ex_identifiant, FILTER_VALIDATE_EMAIL)) {

            $error[1] = "L'adresse e-mail saisie n'est pas valide.";

        }

        if(ex_isalreadyuse("ex_users", "usermail", $ex_identifiant) < 1) {

        	$error[1] = "Ce compte est inexistant. Veuillez entrer une adresse e-mail valide.";

        }


        if(count($error) == 0) {

        	$q = $db->prepare("SELECT ex_users.ID, ex_users.hashedID, ex_users.username, ex_users.usermail FROM ex_users WHERE (ex_users.usermail = :identifiant)");
	        
	        $q->execute(['identifiant' => $ex_identifiant]);

	        if($q->rowcount() > 0) {

	        	$x = $q->fetch(PDO::FETCH_OBJ);

	        	$y = ex_findone("ex_useragregation", "uID", $x->ID);


	        	if($y->agregation === "1" && $y->sendstate === "1") {
				
					ex_setflashnotification("Nous avons trouvé votre identifiant.", "info");

					ex_redirect(WURI . '/reset/user/' . $x->hashedID);

	        	} else {

	        		ex_setflashnotification("Il semblerait que ce compte ne soit pas vérifier.", "info");

	        		ex_setflashnotification("Un mail de confirmation a été envoyé à l'adresse: <a href='#'>" . $x->usermail . "</a>.", "info");

    				ex_redirect(WURI . '/confirm/user/' . $x->hashedID);

	        	}

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

$__recovery = ob_get_clean();

#   Template
require VIEWS . '/Auth/' . $MOD . '/' . $MOD . '.php';


?>