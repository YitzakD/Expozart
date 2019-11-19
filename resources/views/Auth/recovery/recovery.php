<div class="ex-body d-flex d-md-flex d-lg-flex flex-row-reverse justify-content-center align-items-stretch">

    <div class="ex-auth-slide-box ex-hidden">

        <?php require PARTIALS . '/slide/_slide.php'; ?>

    </div>

    <div class="ex-auth-form-box relative">

        <h3 class="ex-auth-form-title-1 text-center">

            <a href="">

            	<img class="text-center mb-4" src="<?= MEDIAS . '/uses/ico.png'; ?>" alt>

            </a>	
            
        </h3>

        
        <div class="ex-auth-form-title-2 h5 text-center text-expozart-grey">Récupérer votre compte</div>

        <?= $__recovery; ?>
        
        <div class="ex-auth-box-or">

            <div class="or-line"></div>

            <div class="or">ou</div>

        </div>


        <div class="text-center mb-3">
            
            Nouveau sur <?= strtolower(WEBSITE_NAME); ?>? <a href="<?= $router->generate('inscription') ?>">Créer un compte</a>

        </div>

    </div>

</div>