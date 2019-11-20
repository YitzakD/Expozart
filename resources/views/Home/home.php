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
					
					<div class="col-sx-12 col-md-12 col-lg-8">

						<div class="d-block art-content p-3">
							
							<img src="" id="json-image" alt="" />

						</div>

					</div>

					<div class="col-sx-12 col-md-12 col-lg-4">

						<div class="d-block art-comment">
							
							<p class="p-2" id="json-post-content"></p>

							<div class="strong m-0 text-center">Commentaires</div>

						</div>

					</div>

				</div>

			</div>

			<a href="#" class="open-exart-ajax" id="prev"><i class="fas fa-2x fa-angle-left"></i></a>

			<a href="#" class="open-exart-ajax" id="next"><i class="fas fa-2x fa-angle-right"></i></a>

		</div>
	
	</div>

</div>	