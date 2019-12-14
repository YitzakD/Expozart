<?php
/**
 *	Expozart
 *	userLike ajax app:	recupère les artworks aimés par l'utilisateur
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

if(isset($_POST['getUtopics']) && isset($_POST['userid']) && is_numeric($_POST['userid'])) {

	extract($_POST);

	

	$ex_userTopicsTaste = ex_findall("ex_usertopics", "WHERE uID='$userid'");


	$q = $db->prepare("SELECT tID FROM ex_usertopics WHERE uID='" . exAuth_getsession("userid") . "'");

		$q->execute();

	 	$data = $q->fetchAll(PDO::FETCH_OBJ);

	 	$exVar_notAtTaste = array();

	 	foreach ($data as $value) {

	 		$exVar_notAtTaste[] .= $value->tID;

	 	}



	if(count($ex_userTopicsTaste) > 0) {

	?>

	<div class="exprofile-categories-cards">

	<?php

		foreach($ex_userTopicsTaste as $topicItem) {

			$item = ex_findone("ex_topics", "ID", $topicItem->tID);

			$tasteMedia = ex_findone("ex_media", "salt", $item->ID, "AND fileusability='2'");

		?>

			<?php if($topicItem->uID === exAuth_getsession("userid")): ?>
			
			<a hre="#" class="ex-card js-card js-card-checked" data-effect="color" accesskey="<?= $item->ID; ?>">

				<span class="card-checked"><i class="fas fa-check-circle fa-lg"></i></span>

			<?php else: ?>
			
			<a hre="#" class="ex-card" data-effect="color" accesskey="<?= $item->ID; ?>">

			<?php endif; ?>

				<figure  class="card-image">

					<img src="<?= $tasteMedia->fileroad_sm; ?>">
				
				</figure>

				<div class="card-footer">

					<div class="h5 text-family-title"><?= $item->topicname; ?></div>

				</div>

				<?php if($topicItem->uID !== exAuth_getsession("userid")): ?>

				<?php if(!in_array($item->ID, $exVar_notAtTaste)): ?>

				<div class="card-footer-plus">

					<div class="js-card-plus rounded-circle" accesskey="<?= $item->ID; ?>" title="S'abonner au thème <?= $item->topicname ?>">
						<i class="fas fa-sm fa-plus"></i>
					</div>

				</div>

				<?php else: ?>

				<div class="card-footer-plus">

					<div class="js-card-plus rounded-circle js-card-checked" accesskey="<?= $item->ID; ?>" title="Se désabonner au thème <?= $item->topicname ?>">
						<i class="fas fa-sm fa-minus"></i>
					</div>

				</div>

  			 	<?php endif; ?>
  			 	
  			 	<?php endif; ?>

			</a>

		<?php

		}

	?>

	</div>
		
	<?php

	}

}

?>