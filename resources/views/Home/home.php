<div class="d-block w-100">

	<div class="ex-home-placeholder">

		<?php include_once PARTIALS . '/placeholder/home.placeholder.php'; ?>

	</div>

	<div class="ex-home-page" id="home-content"></div>

	<div class="ex-display-container ex-dp-none">
		
		<div class="exart-display-overlay"></div>

		<div class="exart-placeholder-display"><?php include_once PARTIALS . '/placeholder/artwork.placeholder.php'; ?></div>

		<div class="artwork-display" id="artwork-content">

			<a href="#" class="exart-closer" id="close"><i class="fas fa-lg fa-times"></i></a>
			
			<div class="self-artwork">

				<div class="row no-gutters exrow">
					
					<div class="col-sx-12 col-md-12 col-lg-12 col-xl-8">

						<div class="d-flex art-content">
							
							<img src="" id="json-image" alt="" />

						</div>

					</div>

					<div class="col-sx-12 col-md-12 col-lg-12 col-xl-4">

						<div class="d-block art-comment">
						
							<div class="artwork-info border-bottom">

								<div class="btn-group artwork-menu">
				
									<button class="btn btn-sm ex-artwork-menu" title="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-lg fa-ellipsis-h"></i></button>

									<div class="dropdown-menu dropdown-menu-right">

										<form method="POSt" action="" class="m-0 p-0 dropdown-item" id="json-menu-artwork-access"><input type="submit" value="Acceder à l'artwork" ></form>

										<button class="dropdown-item text-danger" type="button">Signaler l'artwork</button>

										<button class="dropdown-item text-danger" type="button">Se désabonner de ce thême</button>

										<div class="dropdown-divider"></div>

										<button class="dropdown-item" type="button">Annuler</button>

									</div>

								</div>
			
								<span class="avatar rounded-circle">
									
									<a href="" title=""  id="json-avatar-link">

										<img src="" id="json-avatar">

										<span class="ex-avatarname bg-expozart-violet" title="" id="json-avatar-name"></span>

									</a>

								</span>

								<span class="info">
									
									<div class="info-name">
										
										<a href="" title="" id="json-username"></a>

									</div>

									<div class="info-place">
										
										<span class="small mr-3" id="json-post-ago"></span>

										<span class="small" id="json-post-likes"></span>

									</div>

								</span>

							</div>
							
							<div class="artwork-content">

								<div class="d-block" id="json-liker-box"></div>

								<div>

									<a href="" class="content-link" id="json-post-username" title=""></a>

									<span class="content-self" id="json-post-content"></span>

								</div>

								<div class="d-block text-center"><div class="content-critics-counter mt-4" id="json-post-critics-counter"></div></div>
								
								<span class="content-last-critics" id="ajax-post-critics"></span>
	
							</div>

						</div>

						<div class="artwork-form">
							
							<div class="critic-info border-top">
			
								<span class="avatar rounded-circle">
									
									<a href="<?= WURI . '/' . strtolower(exAuth_getsession("username")) ?>" title="<?= exAuth_getsession("username") ?>"  id="json-critic-avatar-link">

										<?php if($userAvatar): ?>
									
											<img src="<?= $tasteownerAvatar->fileroad_sm ?>">

										<?php else: ?>

											<span class="ex-avatarname bg-expozart-violet" title="<?= exAuth_getsession("username") ?>" title="<?= exAuth_getsession("username") ?>" id="json-critic-avatar-name" accesskey="<?= exAuth_getsession("userhash") ?>">
												<?= isset($in[1][0]) ? $avatarname = $in[0][0].$in[1][0] : $avatarname = $in[0][0]; ?>
											</span>

										<?php endif; ?>

									</a>

								</span>
								
								<span class="critics-form">
									
									<div class="input-group">
										
										<input type="text" class="form-control critics-form-control" id="ajax-comment-box" placeholder="ajouter un commentaire">
				
										<div class="input-group-append">

											<div class="input-group-text"><i class="far fa-sm fa-paper-plane"></i></div>

										</div>

									</div>

								</span>

							</div>

						</div>

					</div>

				</div>

			</div>

			<a href="#" class="open-artwork-ajax" id="prev"><i class="fas fa-2x fa-angle-left"></i></a>

			<a href="#" class="open-artwork-ajax" id="next"><i class="fas fa-2x fa-angle-right"></i></a>

		</div>
	
	</div>

</div>	