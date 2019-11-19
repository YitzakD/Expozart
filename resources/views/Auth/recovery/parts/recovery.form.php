<form action="" method="POST" class="ex-auth-form" autocomplete="off">

    <div class="form-group mb-2<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

        <label for="ex_identifiant" class="small label-control mb-0">Adresse e-mail</label>

        <input type="email" name="ex_identifiant" id="ex_identifiant" class="form-control ex-form-control" value="<?= ex_getinput("ex_identifiant"); ?>" placeholder="Johndoe@mail.com" required autofocus />

    <?= !empty($error[1]) ? '<span class="small help-block mt-1">' . $error[1] . '</span>' : ''; ?>

    </div>

    <div class="text-right small">
        
        <a href="<?= $router->generate('connexion') ?>">Je m'en souviens</a>

    </div>

    <div class="text-center mt-4">
        
        <button type="submit" name="recoverysubmit" class="btn btn-md btn-primary ex-btn-primary">Récupérer mon compte</button>

    </div>    

</form>