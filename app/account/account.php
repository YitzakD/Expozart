<?php
/**
 *	Expozart
 *	profile app:	gére la page de proofile
 *	Code:	yitzakD
 */




if(!exAuth_islogged()) {

	$fwURI = $_SERVER['REQUEST_URI'];

	$_SESSION['forwardingURI'] = $fwURI;

	ex_redirect(WURI . '/login');

}




global $router;

global $db;

global $match;

global $MOD; global $CON; global $VUE; global $RVUE;

$SUBPAGE = VIEWS . '/' . ucfirst('account') . '/parts/';


$userInfos = ex_findone("ex_users", "username", exAuth_getsession("username"));

$userAvatar = ex_findone("ex_media", "uID", $userInfos->ID, "AND salt='$userInfos->ID' AND fileusability='0'");

if($userAvatar) {

	$avatar = true;
	$profileAvatar = $userAvatar->fileroad_sm;

} else {

	$avatar = false;
	$in =  explode(" ", $userInfos->username);
	if(isset($in[1][0])) { $profileAvatar = $in[0][0].$in[1][0]; } else { $profileAvatar = $in[0][0]; }

}


ob_start();

if((isset($CON) && $CON === "edit")) {

	if((isset($VUE) && $VUE === "avatar")) {

		require $SUBPAGE . "account.avatar.php";

	}

	elseif((isset($VUE) && $VUE === "password")) {

		if(isset($_POST["saveusernewpassubmit"])) {

			$error = [];

			if(ex_notempty(['ex_oldpass', 'ex_newpass', 'ex_confirm'])) {

				extract($_POST);

				if($userInfos && exAuth_paswordverifying($ex_oldpass, $userInfos->userpass)) {

					if(mb_strlen($ex_newpass) < 6) {

			            $error[] = "Le nouveau mot de passe saisi est trop court. Six (6) caractères min.";

			        }

			        if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $ex_newpass)) {

			            ex_setflashnotification("Pour plus de sécurité, votre mot de passe doit :<ul class='m-0'><li>Contenir six (6) caractères minimum,</li><li>Contenir au moins une lettre MAJUSCULE,</li><li>Contenir un ou plusieurs chiffres.</li></ul>", "info");

			            $error[] = "Le nouveau mot de passe saisi est incomplet ou pas trèss sûre.";
			        
			        }

			        if($ex_confirm !== $ex_newpass) {

			        	$error[] = "Les deux mots de passe doivent être identiques.";

			        }

			        if(count($error) == 0) {

			        	if(exAuth_paswordverifying($ex_newpass, $ex_oldpass)) {

			        		 ex_setflashnotification("Le nouveau mot de passe saisi ressemble étrangement à l'ancien.", "danger");
			        	
			        	} else {

				        	$hashpassword = exAuth_paswordhashing($ex_newpass);

				        	

				        	$x = $userInfos;

				        	$y = exApp_sendmail($x->username, $x->usermail, $hashpassword, 3);

							extract($y);

							ob_start();

							    require EX_EMAILS . '/password-exchange-mail.php';

							$content = ob_get_clean();

							mail($to, $subject, $content, $headers);



				        	$u = $db->prepare("UPDATE ex_users SET userpass=:userpass, updated=:updated WHERE ID=:ID");

							$w = $db->prepare("INSERT INTO ex_userlastactivity(uID,lastactivity) VALUES(:uID, :lastactivity)");

							$u->execute([
				                'userpass' => $hashpassword,
				                'updated' =>  date('Y-m-d H:i:s'),
				                'ID' => exAuth_getsession("userid")
				            ]);


							$w->execute([
				                'uID' => exAuth_getsession("userid"),
				                'lastactivity' => date('Y-m-d H:i:s')
				            ]);
				
							ex_setflashnotification("Votre mot de passe est à jour.", "success");

							ex_redirect(WURI . '/account/edit/password');

				        }    

			        } else {

    				    $errors[] = "Une ou plusieurs erreurs se sont glissée lors de l'envoi du formulaire.";

						ex_redirect(WURI . '/account/edit/password');

			        }


				} else {

					ex_setflashnotification("Impossible d'éffectuer les modifications car le mot passe est éronné.", "danger");

					ex_redirect(WURI . '/account/edit/password');

				}

			} else {

				ex_setflashnotification("Assurez-vous d'avoir bien rempli tous les champs obligatoires ou marqué d'un astérisque.", "danger");

				ex_redirect(WURI . '/account/edit/password');

			}

		} else { ex_clearinputs(); }

		require $SUBPAGE . "account.password.php";

	}

	elseif((isset($VUE) && $VUE === "activity")) {

		#

	}

	else {

		if(ex_isalreadyuse("ex_userinfos", "uID", exAuth_getsession("userid"))) {

			global $exVar_userInformation;

			$EXuserinfo = $exVar_userInformation;


			
			if(isset($_POST["saveuserinfosubmit"])) {

				$error = [];

				if(ex_notempty(['ex_username', 'ex_email'])) {

					extract($_POST);

					$ex_username = trim($ex_username);

					if(mb_strlen($ex_username) < 3) {

			            $error[1] = "Le nom d'utilisateur saisi est trop court. Trois (3) caractères min.";

			        }

			        if($ex_email !== exAuth_getsession("usermail") && ex_isalreadyuse("ex_users", "usermail", $ex_email) > 0) {

						ex_setflashnotification("Cette adresse e-mail est déjà liée à un autre compte d'utilisateur. Assurez-vous que vous n'avez fait aucune erreurs lors de la saisie.", "info");

						$error[2] = "L'adresse e-mail saisie est déjà liée à un autre compte.";

					}

					if(!filter_var($ex_email, FILTER_VALIDATE_EMAIL)) {

			            $error[2] = "L'adresse e-mail saisie n'est pas valide.";

			        }

			        /*if(ex_weblinkvalide($ex_website) == false) {

			        	$error[] = "Votre lien ne s'apparente pas à un lien web.";

			        }*/



			        if(count($error) == 0) {

						$u = $db->prepare("UPDATE ex_users SET username=:username, usermail=:usermail, updated=:updated WHERE ID=:ID");

						$v = $db->prepare("UPDATE ex_userinfos SET completename=:completename, gender=:gender, phone=:phone, about=:about, weblink=:weblink, localisation=:localisation, city=:city WHERE uID=:uID");

						$w = $db->prepare("INSERT INTO ex_userlastactivity(uID,lastactivity) VALUES(:uID, :lastactivity)");

						$u->execute([
			                'username' => $ex_username,
			                'usermail' => $ex_email,
			                'updated' =>  date('Y-m-d H:i:s'),
			                'ID' => exAuth_getsession("userid")
			            ]);

			            $v->execute([
			                'completename' => $ex_nomcomplet,
			                'gender' => $ex_gender,
			                'phone' => $ex_phone,
			                'about' => $ex_about,
			                'weblink' => $ex_website,
			                'localisation' => $ex_localisation,
			                'city' => $ex_city,
			                'uID' => exAuth_getsession("userid")
			            ]);

						$w->execute([
			                'uID' => exAuth_getsession("userid"),
			                'lastactivity' => date('Y-m-d H:i:s')
			            ]);

			            if($u) {

			            	if($ex_username !== exAuth_getsession("username")) { $_SESSION['username'] = $ex_username; }
			            	
			            	if($ex_email !== exAuth_getsession("usermail")) { 


			                	$y = exApp_sendmail($ex_username, $userInfos->usermail, $userInfos->userpass, 2);

								extract($y);

								ob_start();

								    require EX_EMAILS . '/email-exchange-mail.php';

								$content = ob_get_clean();

								mail($to, $subject, $content, $headers);

			            	}

			            }
				
						ex_setflashnotification("Votre profil est à jour.", "success");

						ex_redirect(WURI . '/account/edit');

					}

				} else {

			        ex_setflashnotification("Assurez-vous d'avoir bien rempli tous les champs obligatoires ou marqué d'un astérisque.", "danger");

			        ex_saveinputs();

			    }

			}

		}

		require $SUBPAGE . "account.main.php";

	}

}

$__account = ob_get_clean();

#   Template
require VIEWS . '/' . ucfirst('account') . '/account.php';

?>
