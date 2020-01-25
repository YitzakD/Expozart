<div class="exaccount-main">

	<form action="" method="POST">

		<div class="row no-gutters mb-4">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left">

				<div class="avatar rounded-circle">

				<?php if($avatar == true): ?>

					<img src="<?= $profileAvatar ?>" class="rounded-circle">

				<?php else: ?>

					<span class="ex-avatarname bg-expozart-violet"><?= ucfirst($profileAvatar) ?></span>

				<?php endif; ?>

				</div>

			</div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">
				<strong class="h5"><?= exAuth_getsession("username") ?></strong>
				<br>
				<a href="<?= $router->generate('modifier le profil', ['type' => 'edit']); ?>/avatar" class="small">Modifier la photo de profil</a>
			</div>

		</div>

		<div class="row no-gutters mb-2">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left">

				<label for="ex-nomcomplet">Nom & Prénoms</label>

			</div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<input type="text" name="ex_nomcomplet" id="ex-nomcomplet" class="form-control form-control-sm" value="<?= $EXuserinfo->completename ?>" placeholder="Nom & Prénoms">
			
			</div>

		</div>

		<div class="row no-gutters mb-2">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left">
				
				<label for="ex-username">Nom d'utilisateur</label>
				
			</div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<input type="text" name="ex_username" id="ex-username" class="form-control form-control-sm" value="<?= exAuth_getsession("username") ?>" placeholder="Nom d'utilisateur">
			
			</div>

		</div>

		<div class="row no-gutters mb-2">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left">
				
				<label for="ex-about">A propos</label>
				
			</div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<textarea name="ex_about" id="ex-about"  class="form-control form-control-sm" placeholder="A propos de vous"><?= nl2br($EXuserinfo->about) ?></textarea>
			
			</div>

		</div>

		<div class="row no-gutters mb-4">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left">
				
				<label for="ex-website">Site web</label>
				
			</div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<input type="text" name="ex_website" id="ex-website" class="form-control form-control-sm" value="<?php ?>" placeholder="Site web">
			
			</div>

		</div>

		<div class="row no-gutters mb-4">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left"></div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<strong class="text-muted">Informations privées</strong>
			
			</div>

		</div>

		<div class="row no-gutters mb-2">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left">
				
				<label for="ex-email">Adresse e-mail</label>
				
			</div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<input type="email" name="ex_email" id="ex-email" class="form-control form-control-sm" value="<?= exAuth_getsession("usermail") ?>" placeholder="Adresse e-mail">
			
			</div>

		</div>

		<div class="row no-gutters mb-2">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left">
				
				<label for="ex-phone">Téléphone</label>
				
			</div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<input type="text" name="ex_phone" id="ex-phone" class="form-control form-control-sm" value="<?php ?>" placeholder="Numéro de téléphone">
			
			</div>

		</div>

		<div class="row no-gutters mb-2">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left">
				
				<label for="ex-gender">Genre</label>
				
			</div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<select class="form-control form-control-sm" id="ex-gender" name="ex_gender">
					<option value="0">Femme</option>
					<option value="1">Homme</option>
					<option value="6">Autre</option>
				</select>
			
			</div>

		</div>

		<div class="row no-gutters mb-4">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left">
				
				<label for="ex-city">Ville</label>
				
			</div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<input type="text" name="ex_city" id="ex-city" class="form-control form-control-sm" value="<?php ?>" placeholder="Ville d'habitation">
			
			</div>

		</div>

		<div class="row no-gutters mt-4">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left"></div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<button type="submit" name="saveuserinfosBtn" class="btn btn-primary btn-sm ex-btn-primary">Valider</button>
			
			</div>

		</div>

	</form>
	
</div>