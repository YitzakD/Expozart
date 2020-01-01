<div class="d-block w-100">

	<div class="ex-home-placeholder">

		<?php include_once PARTIALS . '/placeholder/home.placeholder.php'; ?>

	</div>

	<div class="ex-home-page" id="home-content"></div>

	<div class="ex-display-container ex-dp-none">
		
		<div class="exart-display-overlay"></div>

		<div class="exart-placeholder-display"><?php include_once PARTIALS . '/placeholder/artwork.placeholder.php'; ?></div>

		<div class="artwork-display" id="artwork-content"></div>
	
	</div>

	<div class="d-block fixed-bottom p-4 ex-artwork-adder">
		
		<a href="<?= $router->generate('artwort-post', ['type' => 'new']); ?>" class="btn btn-primary btn-adder rounded-circle">
			
			<i class="fas fa-lg fa-plus"></i>

		</a>

	</div>

</div>	