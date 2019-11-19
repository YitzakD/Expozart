<div class="ex-body d-flex d-md-flex d-lg-flex flex-row-reverse justify-content-center align-items-stretch">

    <div class="ex-auth-slide-box ex-hidden">

        <?php require PARTIALS . '/slide/_slide.php'; ?>

    </div>

    <div class="ex-auth-form-box relative">

	    <h6 class="ex-auth-form-title-1 text-center">

	    	<?php $in = explode(" ", $x->username); ?>
	 									
			<div class="mb-3"><span class="ex-avatarname bg-expozart-violet" title="<?= $x->username ?>"><?= isset($in[1][0]) ? $avatarname = $in[0][0].$in[1][0] : $avatarname = $in[0][0]; ?></span></div>

	    	<span class="text-family-title text-expozart-violet"><?= $x->usermail ?></span>
	        
	    </h6>

	    
	    <div class="h5 text-center text-expozart-grey">Réinitialiser votre compte</div>


	    <div class="ex-auth-form-title-3 h6 small text-center text-expozart-brown">Si vous voyer ce formulaire, alors vous êtes sur le point de réinitialiser votre <strong>mot de passe</strong>. <a href="<?= $router->generate('connexion') ?>">Cliquez ici</a> si ce n'est pas votre souhait</div>

	    <?= $__reset; ?>

	</div>

</div>