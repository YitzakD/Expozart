<form action="" method="POST" class="ex-auth-form">

    <div class="form-group mb-2<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

        <label for="ex_username" class="small label-control mb-0">Nom d'utilisateur</label>

        <input type="text" name="ex_username" id="ex_username" class="form-control ex-form-control ex-form-control-sm" value="<?= ex_getinput("ex_username"); ?>" placeholder="JohnDoe" required autofocus />

    <?= !empty($error[1]) ? '<span class="small help-block mt-1">' . $error[1] . '</span>' : ''; ?>

    </div>

    <div class="form-group mb-2<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

        <label for="ex_usermail" class="small label-control mb-0">Adresse e-mail</label>

        <input type="email" name="ex_usermail" id="ex_usermail" class="form-control ex-form-control ex-form-control-sm" value="<?= ex_getinput("ex_usermail"); ?>" placeholder="JohnDoe" required />

    <?= !empty($error[2]) ? '<span class="small help-block mt-1">' . $error[2] . '</span>' : ''; ?>

    </div>

    <div class="form-group mb-2<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

        <label for="ex-pass" class="small label-control mb-0">Mot de passe</label>

        <input type="password" name="ex_userpass" id="ex-pass" class="form-control ex-form-control ex-form-control-sm" value="" placeholder="Mot de passe"  />

        <span class="field-icon small toggle-password"><i class="fas fa-eye ex-field-icon"></i></span>

        <div class="progress ex-progress" style="display: none;">
            <div class="progress-bar" id="ex-pass-strenght" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

    <?= !empty($error[3]) ? '<span class="small help-block mt-1">' . $error[3] . '</span>' : ''; ?>

    </div>

    <div class="text-center mt-4">
        
        <button type="submit" name="registersubmit" class="btn btn-md btn-primary ex-btn-primary" id="ex-subbmit-btn">S'inscrire</button>

    </div>

</form>