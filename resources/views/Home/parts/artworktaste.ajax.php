<?php
/**
 *	Expozart
 *	artworktaste ajax app:	recupère les artwork en fonction des préférences prédéfinies par l'utilisateur
 *	Code:	yitzakD
 */




/** Constantes d'environnement	*/
$WEBROOT = dirname(dirname(dirname(__FILE__)));

$ROOT = dirname(dirname($WEBROOT));

$DS = DIRECTORY_SEPARATOR;

$CORE = $ROOT.$DS.'core';


$URI = $_SERVER["HTTP_REFERER"];

$URL = array_filter(explode('http://', $URI));

$URL = explode('/', $URI, -1);

$WURI = $URL[0] . '//' . $URL[2];


session_start();

include_once $CORE.$DS.'database/db-config.php';

include_once $CORE.$DS.'app/global.func.php';

include_once $CORE.$DS.'app/auth.func.php';

include_once $CORE.$DS.'includes/account.var.php';

if(isset($_POST['getUserArtworksTastes'])) {

	extract($_POST);

	$ex_userTastes = ex_findall("ex_arts", "WHERE cID IN(SELECT cID FROM ex_usertopics WHERE uID=" . exAuth_getsession("userid") . ") ORDER BY ex_arts.ID DESC LIMIT $artworkStart, $artworkLimit");

	if(count($ex_userTastes) > 0) {

		foreach ($ex_userTastes as $item) {

		$tasteMedia = ex_findone("ex_media", "salt", $item->ID, "AND fileusability='1'");

		$tasteowner = ex_findone("ex_users", "ID", $item->uID);

		if(!$tasteowner) { $exUsername = "Expozart"; } else { $exUsername = $tasteowner->username; }

		$in =  explode(" ", $exUsername);

		$tasteownerAvatar = ex_findone("ex_media", "uID", $item->uID, "AND salt='$item->uID' AND fileusability='0'");

		$tastelikes = ex_cellcount("ex_likes", "aID", $item->ID, "AND lTYPE='1'");

		$logeduseralreadyliked = ex_cellcount("ex_likes", "aID", $item->ID, "AND uID=" . exAuth_getsession("userid") . " AND lTYPE='1'");

		?>

		<div class="exart">

			<div class="exart-inner">					

				<div class="exart-content">

					<div class="exart-art" style="/*background-color: #<?= ex_randomcolor() ?>*/">

						<!-- Like -->
						<span class="<?= $item->ID ?>" id="ajax-liker-box" accesskey="<?= $logeduseralreadyliked ?>">

							<button class="btn btn-sm exart-like" title="liker" id="ajax-like-btn"><i class="far fa-lg fa-heart"></i></button>

						</span>

						<!-- Comment -->
						<a href="<?= $WURI . '/art/' . $item->arthash; ?>" role="boutton" class="btn btn-sm exart-comment open-artwork-ajax" title="commenter"><i class="far fa-lg fa-paper-plane"></i></a>

						<!-- Menu -->
						<div class="btn-group exart-artwork-menu">
		
							<button class="btn btn-sm exart-menu" title="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-lg fa-ellipsis-h"></i></button>

							<div class="dropdown-menu dropdown-menu-right">

								<form method="POSt" action="<?= $WURI . '/art/' . $item->arthash; ?>" class="m-0 p-0 dropdown-item"><input type="submit" value="Acceder à l'artwork" ></form>

								<button class="dropdown-item text-danger" type="button">Signaler l'artwork</button>

								<button class="dropdown-item text-danger" type="button">Se désabonner de ce thême</button>

								<div class="dropdown-divider"></div>

								<button class="dropdown-item" type="button">Annuler</button>

							</div>

						</div>	
						
						<!-- Content -->
						<a href="<?= $WURI . '/art/' . $item->arthash; ?>" class="exart-art-item relative open-artwork-ajax" accesskey="<?= $item->arthash  ?>">

							<div class="exart-hover" accesskey="<?= $item->ID . '-' . $item->uID . '-' . $item->cID . '-' . $item->tID  ?>"></div>

							<?php if($tasteMedia): ?>

							<img src="<?= $tasteMedia->fileroad_sm ?>" alt="" />

							<?php else: ?>

							<p class="p-2 m-0"><?= $item->artcontent ?></p>

							<?php endif; ?>

						</a>

						<!-- Footer -->
						<div class="exart-info">
							
							<span class="avatar rounded-circle">

								<a href="<?= $WURI . '/' . strtolower($exUsername) ?>" title="<?= $exUsername  ?>">

									<?php if($tasteownerAvatar): ?>

										<img src="<?= $tasteownerAvatar->fileroad_sm ?>">

									<?php else: ?>

										<span class="ex-avatarname bg-expozart-violet" title="<?= $exUsername  ?>">
											<?= isset($in[1][0]) ? $avatarname = $in[0][0].$in[1][0] : $avatarname = $in[0][0]; ?>
										</span>

									<?php endif; ?>	

								</a>	

							</span>

							<span class="info">
								
								<div class="info-name" title="<?= $exUsername  ?>">
									<a href="<?= $WURI . '/' . strtolower($exUsername) ?>" title="<?= $exUsername  ?>"><?= $exUsername; ?></a>
								</div>

								<div class="info-place">
									
									<span class="small mr-1"><?= ex_getTimeAgo(strtotime($item->created)) ?></span>

									<span class="small" id="ajax-likes-counter" accesskey="<?= $item->ID ?>"><?= $tastelikes ?> <i class="fas fa-sm fa-heart"></i></span>

								</div>

							</span>

						</div>

					</div>

				</div>

			</div>

		</div>	

		<?php

		}

	} else { exit('artworksReachedMax'); }

}

?>