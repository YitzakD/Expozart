<div class="row no-gutters">
	
	<div class="col-4 col-sx-5 col-md-4 col-lg-12 col-xl-12">

		<div class="exprofile-info-header">

			<?php if($userInfos->username === exAuth_getsession("username")): ?>
			
			<a href="<?= $router->generate('modifier le profil', ['type' => 'edit']); ?>/avatar" title="Modifier la photo de profil" id="json-update-avatar-link">
				
				<div class="avatar rounded-circle">
				
				<?php if($avatar == true): ?>

					<img src="<?= $profileAvatar ?>" class="rounded-circle">

				<?php else: ?>

					<span class="ex-avatarname bg-expozart-violet"><?= ucfirst($profileAvatar) ?></span>

				<?php endif; ?>

				</div>

			</a>
				
			<?php else: ?>

			<div class="avatar rounded-circle">
			
			<?php if($avatar == true): ?>

				<img src="<?= $profileAvatar ?>" class="rounded-circle">

			<?php else: ?>

				<span class="ex-avatarname bg-expozart-violet" title="<?= $userInfos->username ?>">

					<?= ucfirst($profileAvatar) ?>
						
				</span>

			<?php endif; ?>

			</div>

			<?php endif; ?>
			
			<div class="exprofile-info-header-counter d-block p-4 mt-2">
				
				<div class="row no-gutters">
					
					<div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
						<h4 class="p-0 m-0"><?= ex_getRealnumber($userArtworkposts) ?></h4>
						<span class="d-block small text-muted">artworks</span>
					</div>

					<div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
						<h4 class="p-0 m-0"><?= ex_getRealnumber($userTopics) ?></h4>
						<span class="d-block small text-muted">thèmes</span>
					</div>

					<div class="col-12 col-xs-12 col-md-4 col-lg-4 col-xl-4">
						<h4 class="p-0 m-0"><?= ex_getRealnumber($userTopicsregistration) ?></h4>
						<span class="d-block small text-muted">abonnements</span>
					</div>

				</div>

				<div class="d-block pt-4">

				<?php if($userInfos->username === exAuth_getsession("username")): ?>

					<a class="btn btn-sm ex-btn-primary" href="<?= $router->generate('modifier le profil', ['type' => 'edit']); ?>" title="Modifier mon profil">Modifier mon profil</a>		

				<?php else: ?>

					<?php if(ex_isalreadyuse("ex_userfollowing", "uID", exAuth_getsession("userid"), "AND rID=$userInfos->ID")): ?>

						<a class="btn btn-sm ex-btn-primary ex-btn-primary-outline" href="#" title="S'abonner à <?= $userInfos->username ?>">
							Se désabonner
						</a>

					<?php else: ?>

						<a class="btn btn-sm ex-btn-primary" href="#" title="S'abonner à <?= $userInfos->username ?>">
							S'abonner
						</a>

					<?php endif; ?>

				<?php endif; ?>

				</div>

			</div>

		</div>

	</div>

	<div class="col-8 col-sx-7 col-md-8 col-lg-12 col-xl-12">

		<div class="exprofile-info-footer p-4">
		
			<div class="row no-gutters">
				
				<div class="col-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">

					<a href="<?= ex_gotoprofile($userInfos->username) ?>" class="exp-info-user" title="<?= $userInfos->username ?>">
						<?= $userInfos->username ?>
					</a>

				</div>

				<div class="col-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 exprofile-info-footer-btns mt-2">

					<div class="row no-gutters">
					
						<div class="col-4 col-xs-4 col-md-4 col-lg-4 col-xl-4">
							<h4 class="p-0 m-0"><?= ex_getRealnumber($userArtworkposts) ?></h4>
							<span class="d-block small text-muted">artworks</span>
						</div>

						<div class="col-4 col-xs-4 col-md-4 col-lg-4 col-xl-4">
							<h4 class="p-0 m-0"><?= ex_getRealnumber($userTopics) ?></h4>
							<span class="d-block small text-muted">thèmes</span>
						</div>

						<div class="col-4 col-xs-4 col-md-4 col-lg-4 col-xl-4">
							<h4 class="p-0 m-0"><?= ex_getRealnumber($userTopicsregistration) ?></h4>
							<span class="d-block small text-muted">abonnements</span>
						</div>

					</div>

					<div class="d-block pt-4">

					<?php if($userInfos->username === exAuth_getsession("username")): ?>

						<a class="btn btn-sm ex-btn-primary" href="#" title="Modifier mon profil">Modifier mon profil</a>		

					<?php else: ?>

						<?php if(ex_isalreadyuse("ex_userfollowing", "uID", exAuth_getsession("userid"), "AND rID=$userInfos->ID")): ?>

							<a class="btn btn-sm ex-btn-primary ex-btn-primary-outline" href="#" title="S'abonner à <?= $userInfos->username ?>">
								Se désabonner
							</a>

						<?php else: ?>

							<a class="btn btn-sm ex-btn-primary" href="#" title="S'abonner à <?= $userInfos->username ?>">
								S'abonner
							</a>

						<?php endif; ?>

					<?php endif; ?>	

					</div>

				</div>

			</div>


		
			<div class="row no-gutters mb-4">

				<div class="col-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
					
				<?php if(ex_isalreadyuse("ex_userinfos", "uID", $userInfos->ID)): ?>

					<div class="small text-muted exprofile-info-footer-city">

					<?php if(!empty($userMoreInfos->city) || !empty($userMoreInfos->localisation)): ?>

					<?= $userMoreInfos->city ?> (<?= $userMoreInfos->localisation ?>)

					<?php endif; ?>

					</div>

					<div class="small exprofile-info-footer-bio mt-3">
					
					<?php if(!empty($userMoreInfos->about)): ?>
					
						<?= $userMoreInfos->about ?>

					<?php else: ?>

						Et si vous nous parliez de vous? <a href="<?= $router->generate('profil', ['type' => 'edit']); ?>">Completez vos informations</a>
					
					<?php endif; ?>				
					
					</div>

					<div class="small exprofile-info-footer-weblink mt-3">

						<a href="<?= $userMoreInfos->weblink ?>"><?= $userMoreInfos->weblink ?></a>

					</div>

				<?php else: ?>

					<div class="small text-muted mt-4">Aucune informations disponibles pour le moment</div>

					<?php if($userInfos->ID === exAuth_getsession("userid")): ?>

					<div class="small">
						
						<a href="<?= $router->generate('profil', ['type' => 'edit']); ?>">Completez mes informations</a>
						
					</div>
					
					<?php endif; ?>

				<?php endif; ?>

				</div>
		
			</div>

		</div>	

	</div>

</div>