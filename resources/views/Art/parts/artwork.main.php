<div class="self-artwork" accesskey="<?= $ID ?>">

	<div class="row no-gutters exrow">
		
		<div class="col-sx-12 col-md-12 col-lg-12 col-xl-12">

			<div class="d-block art-comment">

				<div class="artwork-info">

					<div class="btn-group artwork-menu">
	
						<button class="btn btn-sm ex-artwork-menu" title="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-lg fa-ellipsis-h"></i></button>

						<div class="dropdown-menu dropdown-menu-right">

							<form method="POST" action="<?= $router->generate('artwork', ['arthash' => $artwork->arthash]) ?>" class="m-0 p-0 dropdown-item" id="json-menu-artwork-access"><input type="submit" value="Acceder à l'artwork" ></form>
							
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
						
						<a href="<?= $router->generate('profil', ['username' => strtolower($exUsername)]) ?>"  id="json-avatar-link">

							<?php if($avatar == true): ?>

							<img src="<?= $useravatar ?>" id="json-avatar">

							<?php else: ?>

							<span class="ex-avatarname bg-expozart-violet" title="<?= ucfirst($exUsername) ?>" id="json-avatar-name"><?= $useravatar ?></span>

							<?php endif; ?>

						</a>

					</span>

					<span class="info">
						
						<div class="info-name">
							
							<a href="<?= $router->generate('profil', ['username' => strtolower($exUsername)]) ?>" id="json-username" title="<?= ucfirst($exUsername) ?>"><?= ucfirst($exUsername) ?></a>

						</div>

						<div class="info-place">
							
							<span class="small mr-3" id="json-post-ago"><?= $created ?></span>

							<?php if($artworklikes > 0): ?>

							<span class="small" id="json-post-likes"><i class="far fa-sm fa-heart"></i> <?= $artworklikes ?></span>
							
							<?php endif; ?>

						</div>

					</span>

				</div>

			</div>

		</div>
		
		<div class="col-sx-12 col-md-12 col-lg-12 col-xl-12">

			<div class="d-flex art-content">

				<img src="<?= $fileroad ?>" alt="" />

			</div>

		</div>

		<div class="col-sx-12 col-md-12 col-lg-12 col-xl-12">

			<div class="d-block art-comment mt-2">
							
				<div class="artwork-content">

					<div>

						<span class="<?= $artwork->ID ?>" id="json-liker-box" accesskey="<?= $logeduseralreadyliked ?>"></span>

						<span class="btn btn-sm exart-like-btn" id="ajax-set-on-comment-box" title="critiquer"><i class="far fa-lg fa-comment-alt"></i></span>

					</div>

					<div class="mt-4">

						<a href="<?= $router->generate('profil', ['username' => strtolower($exUsername)]) ?>" class="content-link" id="json-post-username" title="<?= ucfirst($exUsername) ?>"><?= ucfirst($exUsername) ?></a>

						<span class="content-self" id="json-post-content"><?= $artwork->artcontent ?></span>

					</div>

					<div class="d-block text-center"><div class="content-critics-counter mt-4" id="json-post-critics-counter">

						<?php if($artworkcritics > 1): ?>

							<?= $artworkcritics ?> critiques

						<?php else: ?>

							<?= $artworkcritics ?> critique

						<?php endif; ?>

					</div></div>
					
					<span class="content-last-critics" id="ajax-post-critics"></span>

				</div>
			
			</div>

			<div class="artwork-form">
							
				<div class="critic-info border-top">

					<span class="avatar rounded-circle">
						
						<a href="<?= $router->generate('profil', ['username' => strtolower(exAuth_getsession("username"))]) ?>" title="<?= exAuth_getsession("username") ?>"  id="json-critic-avatar-link">

							<?php if($userAvatar): ?>
						
								<img src="<?= $userAvatar->fileroad_sm ?>">

							<?php else: ?>

								<?php $_in = explode(" ", exAuth_getsession("username")) ?>

								<span class="ex-avatarname bg-expozart-violet" title="<?= exAuth_getsession("username") ?>" title="<?= exAuth_getsession("username") ?>" id="json-critic-avatar-name" accesskey="<?= exAuth_getsession("userhash") ?>">
									<?= isset($_in[1][0]) ? ucfirst($userAvatarName = $_in[0][0].$_in[1][0]) : ucfirst($userAvatarName = $_in[0][0]); ?>
								</span>

							<?php endif; ?>

						</a>

					</span>
					
					<span class="critics-form">
						
						<div class="input-group">
							
							<input type="text" class="form-control critics-form-control" id="ajax-comment-box" placeholder="ajouter un commentaire">
	
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