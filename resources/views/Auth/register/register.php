<div class="ex-body d-flex d-md-flex d-lg-flex flex-row-reverse justify-content-center align-items-stretch">

	<div class="ex-auth-slide-box ex-hidden">

	    <?php require PARTIALS . '/slide/_slide.php'; ?>

	</div>

	<div class="ex-auth-form-box relative">

	    <h3 class="ex-auth-form-title-1 text-center">

	        <a href="">

	            <img class="text-center mb-4 full-logo" src="<?= MEDIAS . '/uses/logo.png'; ?>" alt>

	        </a>
	        
	    </h3>

	    
	    <div class="h5 text-center text-expozart-grey">Créer votre compte dès maintenant!</div>


	    <div class="ex-auth-form-title-3 h6 small text-center text-expozart-brown">Découvrez gratuitement les oeuvres des artistes et des artisants près de chez vous</div>

	    <?= $__register ?>
	    

	    <div class="ex-auth-box-or">

	        <div class="or-line"></div>

	        <div class="or">ou</div>

	    </div>


	    <div class="text-center mb-3">
	        
	        <a href="<?= $router->generate('connexion') ?>">Vous avez déjà un compte?</a>

	    </div>

	</div>

</div>