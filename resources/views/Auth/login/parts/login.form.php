<form action="" method="POST" class="ex-auth-form" autocomplete="off">

    <div class="form-group mb-2<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

        <label for="identifiant" class="small label-control mb-0">Adresse e-mail</label>

        <input type="email" name="identifiantentry" id="identifiant" class="form-control ex-form-control" value="<?= ex_getinput("identifiantentry"); ?>" placeholder="johndoe@mail.com" required autofocus />

    <?= !empty($error[1]) ? '<span class="small help-block mt-1">' . $error[1] . '</span>' : ''; ?>

    </div>

    <div class="form-group mb-2<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

        <label for="ex-pass" class="small label-control mb-0">Mot de passe</label>

        <input type="password" name="passwordentry" id="ex-pass" class="form-control ex-form-control" placeholder="Mot de passe" required />

        <span class="field-icon toggle-password"><i class="fas fa-eye ex-field-icon"></i></span>

    <?= !empty($error[2]) ? '<span class="small help-block mt-1">' . $error[2] . '</span>' :  ''; ?>

    </div>

    <div class="text-right small">
        
        <a href="<?= $router->generate('récupération de compte'); ?>">Mot de passe oublié?</a>

    </div>

    <div class="text-center mt-4">
        
        <button type="submit" name="loginsubmit" class="btn btn-md btn-primary ex-btn-primary">Se connecter</button>

    </div> 

</form>