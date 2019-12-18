<?php
/**
 *	Expozart
 *	artwork-main ajax app:	recupère un artwork en fonction des paramètres dans l'URL
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

if(isset($_GET['uri'])) {

	extract($_GET);

	$lurl = explode("/", $uri);

	$arthash = $lurl[4];

	if(ex_isalreadyuse("ex_arts", "arthash", $arthash) > 0) {

		$artwork =  ex_findone("ex_arts", "arthash", $arthash);

		$createdtime = strtotime($artwork->created);

		$created = ex_getTimeAgo($createdtime);


		$tastMediacount = ex_cellcount("ex_media", "salt", $artwork->ID, "AND fileusability='1'");

		if($tastMediacount > 1) {

			$artworkmedia = ex_findall("ex_media", "WHERE salt='$artwork->ID' AND fileusability='1'");

		} else {

			$artworkmedia = ex_findone("ex_media", "salt", $artwork->ID, "AND fileusability='1'");

			if(!$artworkmedia) { $fileroad = ""; } else { $fileroad = $artworkmedia->fileroad_sm; }

		}
		/*$artworkmedia = ex_findone("ex_media", "salt", $artwork->ID, "AND fileusability='1'");

		if(!$artworkmedia) { $fileroad = ""; } else { $fileroad = $artworkmedia->fileroad_sm; }*/

		

		$artworkowner = ex_findone("ex_users", "ID", $artwork->uID);

		if(!$artworkowner) { $exUsername = "Expozart"; } else { $exUsername = $artworkowner->username; }

		$in =  explode(" ", $exUsername);

		

		$artworkownerAvatar = ex_findone("ex_media", "uID", $artwork->uID, "AND salt='$artwork->uID' AND fileusability='0'");

		if(!$artworkownerAvatar) { $avatar = false; $useravatar = $avatarname = $in[0][0]; }

		else { $avatar = true; $useravatar = $artworkownerAvatar->fileroad_sm; }

		
		$artworklikes = ex_cellcount("ex_likes", "aID", $artwork->ID, "AND lTYPE='1'");

		$artworkcritics = ex_cellcount("ex_comments", "aID", $artwork->ID, "AND cTYPE='1'");



		$logeduseralreadyliked = ex_cellcount("ex_likes", "aID", $artwork->ID, "AND uID=" . exAuth_getsession("userid") . " AND lTYPE='1'");


		$userAvatar = ex_findone("ex_media", "uID", exAuth_getsession("username"), "AND salt='" . exAuth_getsession("username") . "' AND fileusability='0'");

		/*$q = $db->prepare("
			SELECT 
			ex_arts.*, 
			ex_media.fileroad_sm AS newfileroad
			FROM ex_arts 
			INNER JOIN ex_media 
			ON ex_arts.ID = ex_media.salt 
			WHERE cID IN(SELECT cID FROM ex_usertopics WHERE uID=:userid) 
			AND ex_media.fileusability='1' ORDER BY ex_arts.ID DESC
		");*/
		$q = $db->prepare("
			SELECT ex_arts.*
			FROM ex_arts 
			WHERE cID IN(SELECT cID FROM ex_usertopics WHERE uID=:userid) ORDER BY ex_arts.ID DESC
		");

        $q->execute(['userid' => exAuth_getsession("userid")]);

        $data = $q->fetchAll(PDO::FETCH_OBJ);

       	$counter = $data;

		$currentKey = array_search($artwork->ID, array_column($counter, 'ID'));

		$next = ex_nextElement($counter, $currentKey);

		$prev = ex_prevElement($counter, $currentKey);

?>

<a href="#" class="exart-closer" id="close"><i class="fas fa-lg fa-times"></i></a>

<div class="self-artwork">

	<div class="row no-gutters exrow">
					
		<div class="col-xs-12 col-md-12 col-lg-12 col-xl-8">

			<div class="d-flex art-content">
				
				<?php if($tastMediacount > 1): ?>

				<div id="multiArtworkInimg" class="carousel slide" data-ride="carousel">

					<ol class="carousel-indicators">

					<?php foreach ($artworkmedia as $key => $value): ?>

						<li data-target="#multiArtworkInimg" data-slide-to="<?= $key ?>" class="rounded-circle <?= $key === 0 ? 'active' : '' ?>"></li>

					<?php endforeach; ?>

					</ol>

					<div class="carousel-inner">

						<?php foreach ($artworkmedia as $key => $value): ?>

						<div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">

							<img class="d-inline w-100" src="<?= $value->fileroad_sm ?>" alt="" width="100%" height="auto">

						</div>

						<?php endforeach; ?>

					</div>

					<?php if(count($artworkmedia) > 1): ?>

					<a class="carousel-control-prev" href="#multiArtworkInimg" role="button" data-slide="prev">

						<span class="carousel-control-prev-icon" aria-hidden="true"></span>

						<span class="sr-only">Previous</span>

					</a>

					<a class="carousel-control-next" href="#multiArtworkInimg" role="button" data-slide="next">

						<span class="carousel-control-next-icon" aria-hidden="true"></span>

						<span class="sr-only">Next</span>

					</a>

					<?php endif; ?>

				</div>

				<?php else: ?>
						
				<img src="<?= $fileroad ?>" id="json-image" alt="" />

				<?php endif; ?>

			</div>

		</div>

		<div class="col-xs-12 col-md-12 col-lg-12 col-xl-4">

			<div class="d-block art-comment">
						
				<div class="artwork-info border-bottom">

					<div class="btn-group artwork-menu">
	
						<button class="btn btn-sm ex-artwork-menu" title="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-lg fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right">

							<form method="POST" action="<?= $WURI . '/a/' . $arthash ?>" class="m-0 p-0 dropdown-item" id="json-menu-artwork-access"><input type="submit" value="Acceder à l'artwork" ></form>

							<?php if($artwork->uID !== exAuth_getsession("userid")): ?>

							<button class="dropdown-item text-danger" type="button">Signaler l'artwork</button>

							<button class="dropdown-item text-danger" type="button">Se désabonner de ce thême</button>
							
							<?php else: ?>

							<button class="dropdown-item text-danger" type="button">Supprimer cet artwork</button>

							<?php endif; ?>

							<div class="dropdown-divider"></div>

							<button class="dropdown-item" type="button">Annuler</button>

						</div>

					</div>

					<span class="avatar rounded-circle">
						
						<a href="<?= $WURI . '/' . $exUsername ?>" title="<?= $exUsername ?>"  id="json-avatar-link">

							<?php if($avatar ==  true): ?>

							<img src="<?= $useravatar ?>" id="json-avatar">

							<?php else: ?>

							<span class="ex-avatarname bg-expozart-violet" title="<?= $exUsername ?>" id="json-avatar-name"><?= $useravatar ?></span>

							<?php endif; ?>

						</a>

					</span>

					<span class="info">
						
						<div class="info-name">
							
							<a href="<?= $WURI . '/' . $exUsername ?>" title="<?= $exUsername ?>" id="json-username"><?= $exUsername ?></a>

						</div>

						<div class="info-place">
							
							<span class="small mr-3" id="json-post-ago"><?= $created ?></span>

							<?php if($artworklikes > 0): ?>

							<span class="small" id="json-post-likes"><i class="far fa-sm fa-heart"></i> <?= ex_getRealnumber($artworklikes) ?></span>

							<?php endif; ?>

						</div>

					</span>

				</div>
							
				<div class="artwork-content">

					<!-- <div class="d-block" id="json-liker-box"></div> -->

					<span class="<?= $artwork->ID ?>" id="json-liker-box" accesskey="<?= $logeduseralreadyliked ?>"></span>

					<span class="btn btn-sm exart-like-btn" id="json-set-on-comment-box" title="critiquer"><i class="far fa-lg fa-comment-alt"></i></span>

					<div>

						<a href="<?= $WURI . '/' . $exUsername ?>" class="content-link" id="json-post-username" title="<?= $exUsername ?>"><?= $exUsername ?></a>

						<span class="content-self" id="json-post-content"><?= $artwork->artcontent ?></span>

					</div>

					<div class="d-block text-center"><div class="content-critics-counter mt-4" id="json-post-critics-counter">
						
						<?php if($artworkcritics > 1): ?>

							<?= ex_getRealnumber($artworkcritics) ?> critiques

						<?php else: ?>

							<?= $artworkcritics ?> critique

						<?php endif; ?>

					</div></div>
					
					<span class="content-last-critics" id="json-ajax-post-critics"></span>

				</div>

			</div>


			<div class="artwork-form">
							
				<div class="critic-info border-top">

					<span class="avatar rounded-circle">
						
						<a href="<?= $WURI . '/' . exAuth_getsession("username") ?>" title="<?= exAuth_getsession("username") ?>"  id="json-critic-avatar-link">

							<?php if($userAvatar): ?>
						
								<img src="<?= $userAvatar->fileroad_sm ?>">

							<?php else: ?>

								<?php $uIN = explode(" ", exAuth_getsession("username")) ?>

								<span class="ex-avatarname bg-expozart-violet" title="<?= exAuth_getsession("username") ?>" title="<?= exAuth_getsession("username") ?>" id="json-critic-avatar-name" accesskey="<?= exAuth_getsession("userhash") ?>">
									<?= isset($uIN[1][0]) ? ucfirst($sessionAvatarname = $uIN[0][0].$in[1][0]) : ucfirst($sessionAvatarname = $uIN[0][0]); ?>
								</span>

							<?php endif; ?>

						</a>

					</span>
					
					<span class="critics-form">
						
						<div class="input-group">
							
							<input type="text" class="form-control critics-form-control" id="json-comment-box" placeholder="Ajouter un commentaire..." accesskey="">
	
							<div class="input-group-append">

								<div class="input-group-text" title="Appuyez Entrer pour valider votre critique"><i class="far fa-sm fa-paper-plane"></i></div>

							</div>

						</div>

					</span>

				</div>

			</div>

		</div>

	</div>		

</div>

<?php if($prev): ?>

	<a href="<?= $WURI . '/a/' . $prev->arthash ?>" class="open-artwork-ajax" id="prev" accesskey="<?= $prev->ID ?>">

		<i class="fas fa-2x fa-angle-left"></i>

	</a>

<?php endif; ?>


<?php if($next): ?>

	<a href="<?= $WURI . '/a/' . $next->arthash ?>" class="open-artwork-ajax" id="next" accesskey="<?= $next->ID ?>">

		<i class="fas fa-2x fa-angle-right"></i>

	</a>

<?php endif; ?>

<?php

?>

	<div class="ex-home-page-plus mt-4" accesskey="<?= $artwork->ID ?>"></div>
<?php

	} else {

		exit("not-founded");

	}

}

?>