<div class="ex-body d-flex d-md-flex d-lg-flex flex-row justify-content-center align-items-stretch">

	<div class="ex-auth-form-box relative">

	    <h3 class="ex-auth-form-title-1 text-center">

	        <a href="">

	        	<img class="text-center mb-4 full-logo" src="<?= MEDIAS . '/uses/logo.png'; ?>" alt>

	        </a>
	        
	    </h3>

	    
	    <div class="ex-auth-form-title-2 h5 text-center text-expozart-violet">Félicitations votre compte a été créer.</div>

	    <?= $__confirmation  ?>
	    

	    <div class="ex-auth-box-or">

	        <div class="or-line"></div>

	        <div class="or">ou</div>

	    </div>


	    <div class="text-center mb-3">
	        
	        <a href="<?= $router->generate('connexion') ?>">Revenir à la page de connexion</a>

	    </div>

	</div>

</div>