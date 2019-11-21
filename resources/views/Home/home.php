<div class="d-block w-100">

	<div class="ex-home-placeholder">

		<?php include_once PARTIALS . '/placeholder/home.placeholder.php'; ?>

	</div>

	<div class="ex-home-page" id="home-content"></div>

	<div class="ex-display-container ex-dp-none">
		
		<div class="exart-display-overlay"></div>

		<div class="exart-display-placeholder"><?php include_once PARTIALS . '/placeholder/artwork.placeholder.php'; ?></div>

		<div class="exart-display" id="artwork-content">

			<a href="#" class="exart-closer" id="close"><i class="fas fa-lg fa-times"></i></a>
			
			<div class="exart-self">

				<div class="row no-gutters exrow">
					
					<div class="col-sx-12 col-md-12 col-lg-12 col-xl-8">

						<div class="d-block art-content">
							
							<img src="" id="json-image" alt="" />

						</div>

					</div>

					<div class="col-sx-12 col-md-12 col-lg-12 col-xl-4">

						<div class="d-block art-comment">
						
							<div class="info-simulate border-bottom">

								<div class="btn-group artwork-menu">
				
									<button class="btn btn-sm exart-menu" title="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-lg fa-ellipsis-h"></i></button>

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
							
							<div class="art-work-content">

								<div class="d-block" id="json-liker-box"></div>

								<div>

									<a href="" class="content-link" id="json-post-username" title=""></a>

									<span class="content-self" id="json-post-content"></span>

								</div>

							</div>	

							<div class="mb-1">Afficher un compteur de commetaires</div>
							<div class="">Afficher les 2 derniers commetaires</div>

						</div>

					</div>

				</div>

			</div>

			<a href="#" class="open-artwork-ajax" id="prev"><i class="fas fa-2x fa-angle-left"></i></a>

			<a href="#" class="open-artwork-ajax" id="next"><i class="fas fa-2x fa-angle-right"></i></a>

		</div>
	
	</div>

</div>	