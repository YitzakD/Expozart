<div class="ex-profile-page">
	
	<div class="row no-gutters">
		
		<div class="col-xs-12 col-md-12 col-lg-4 col-xl-3"><?php require $SUBPAGE . "profile.infos.php"; ?></div>

		<div class="col-xs-12 col-md-12 col-lg-8 col-xl-9">

			<ul class="nav ex-profile-nav-pills mb-3" accesskey="<?= $MOD ?>">

				<li class="nav-item">

					<a class="nav-link <?= !isset($CON) || $CON === 'posts'  ? 'active' : ''  ?>" id="open-profile-artworks-link" href="<?= WURI . '/' . $MOD ?>">

						Artworks

					</a>

				</li>

				<li class="nav-item">

					<a class="nav-link <?= isset($CON) && $CON === 'likes'  ? 'active' : ''  ?>" id="open-profile-likes-link" href="<?= WURI . '/' . $MOD . '/likes' ?>">
						<?php if($MOD !== exAuth_getsession("username")): ?>
						
						Aimé

						<?php else: ?>

						J'aime
						
						<?php endif; ?>	

					</a>

				</li>

				<li class="nav-item">

					<a class="nav-link <?= isset($CON) && $CON === 'topics'  ? 'active' : ''  ?>" id="open-profile-topics-link" href="<?= WURI . '/' . $MOD . '/topics' ?>">

						Thèmes

					</a>

				</li>

			</ul>


			<div class="ex-profile-tab-content" id="ex-profile-tab-content" accesskey="<?= $userInfos->ID ?>">
			
				<?= $__profile ?>
			
			</div>


		</div>	

	</div>

</div>