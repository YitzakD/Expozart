<div class="d-block">

	<h5 class="text-expozart-grey">Aidez-nous à construire votre page d'exposition. Pour cela, vous devez choisir au moins 5 des catégories parmi celles qui vous sont proposées.</h5>
	
	<div class="choices-indicators" id="uc-tooltip"></div>

	<div class="ex-categories-cards">

		<?php foreach($exVar_allcategories as $item): ?>

			<?php if(ex_isalreadyuse("ex_usercategories", "cID", $item->ID, "AND uID=" . exAuth_getsession("userid"))): ?>
			
			<a hre="#" class="ex-card js-card js-card-checked" data-effect="color" accesskey="<?= $item->ID; ?>">

				<span class="card-checked"><i class="fas fa-check-circle fa-lg"></i></span>

			<?php else: ?>

			<a hre="#" class="ex-card js-card" data-effect="color" accesskey="<?= $item->ID; ?>">

			<?php endif; ?>	

				<figure  class="card-image">

					<img src="<?= $item->fileroad_sm; ?>">
				
				</figure>

				<div class="card-footer">

					<div class="h5 text-family-title"><?= $item->topicname; ?></div>

				</div>

			</a>

		<?php endforeach; ?>

	</div>

	<div class="choice-finished d-block text-center" id="count-uc-tooltip"></div>


</div>