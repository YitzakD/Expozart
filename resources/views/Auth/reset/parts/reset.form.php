<form action="" method="POST" class="ex-auth-form" autocomplete="off">

    <div class="form-group mb-2<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

        <label for="ex-pass" class="small label-control mb-0">Nouveau mot de passe</label>

        <input type="password" name="newuserpass" id="ex-pass" class="form-control ex-form-control" value="" placeholder="Nouveau mot de passe" required autofocus />

        <span class="field-icon toggle-password"><i class="fas fa-eye ex-field-icon"></i></span>

        <div class="progress ex-progress" style="display: none;">
            <div class="progress-bar" id="ex-pass-strenght" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

    <?= !empty($error[1]) ? '<span class="small help-block mt-1">' . $error[1] . '</span>' : ''; ?>

    </div>

    <div class="form-group mb-2<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

        <label for="ex-pass--" class="small label-control mb-0">Confirmez le nouveau mot de passe</label>

        <input type="password" name="newuserpass_confirm" id="ex-pass--" class="form-control ex-form-control" value="" placeholder="Confirmez le nouveau mot de passe" required />

    <?= !empty($error[2]) ? '<span class="small help-block mt-1">' . $error[2] . '</span>' : ''; ?>

    </div>
    
    <div class="text-center mt-4">
        
        <button type="submit" name="resetsubmit" class="btn btn-md btn-primary ex-btn-primary" id="ex-subbmit-btn">Réinitialiser</button>

    </div>

</form>