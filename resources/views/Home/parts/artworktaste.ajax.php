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

/**
 *	$URI = $_SERVER["HTTP_REFERER"];
 *	
 *	$URL = array_filter(explode('/categories', $URI));
 */

$WURI = 'http://' . $_SERVER['HTTP_HOST'];

session_start();

include_once $CORE.$DS.'database/db-config.php';

include_once $CORE.$DS.'app/global.func.php';

include_once $CORE.$DS.'app/auth.func.php';

include_once $CORE.$DS.'includes/account.var.php';

if(isset($_POST['getUserArtworksTastes'])) {

	extract($_POST);

	$ex_userTastes = ex_findall("ex_arts", "WHERE cID IN(SELECT cID FROM ex_usercategories WHERE uID=" . exAuth_getsession("userid") . ") ORDER BY ex_arts.ID DESC LIMIT $artworkStart, $artworkLimit");

	if(count($ex_userTastes) > 0) {

		foreach ($ex_userTastes as $item) {

		$tasteMedia = ex_findone("ex_media", "salt", $item->ID, "AND fileusability='1'");

		?>

		<div class="exart">

			<div class="exart-inner">					

				<div class="exart-content">

					<div class="exart-art">
						
						<a href="<?= $WURI . '/art/' . $item->arthash . '/'; ?>" class="exart-art-item relative open-exart-ajax" style="background-color: #<?= ex_randomcolor() ?>" accesskey="<?= $item->arthash  ?>">

							<div class="exart-hover" accesskey="<?= $item->ID . '-' . $item->uID . '-' . $item->cID . '-' . $item->tID  ?>"></div>

							<?php if($tasteMedia): ?>

							<img src="<?= $tasteMedia->fileroad_sm ?>" alt="" />

							<?php else: ?>

							<p class="p-2 m-0"><?= $item->artcontent ?></p>

							<?php endif; ?>

							<div class="exart-info"></div>

						</a>

					</div>

				</div>

			</div>

		</div>	

		<?php

		}

	} else { exit('artworksReachedMax'); }

}

?>