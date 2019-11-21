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
						
							<div class="info-simulate">
			
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
							
							<div class="d-block">

								<p class="p-2" id="json-post-content"></p>

							</div>	

							<div class="strong m-0 text-center">Commentaires</div>

						</div>

					</div>

				</div>

			</div>

			<a href="#" class="open-artwork-ajax" id="prev"><i class="fas fa-2x fa-angle-left"></i></a>

			<a href="#" class="open-artwork-ajax" id="next"><i class="fas fa-2x fa-angle-right"></i></a>

		</div>
	
	</div>

</div>	