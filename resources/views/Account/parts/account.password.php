<div class="exaccount-main">

	<form action="" method="POST">

		<div class="row no-gutters mb-2">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left">

				<label for="ex-oldpass">Mot de passe <sup class="text-danger">*</sup></label>

			</div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<input type="password" name="ex_oldpass" id="ex-oldpass" class="form-control form-control-sm" placeholder="Mot de passe" required>
			
			</div>

		</div>

		<div class="row no-gutters mb-4">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left"></div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<strong class="text-muted">Nouvelle sécurisation</strong>
			
			</div>

		</div>

		<div class="row no-gutters mb-3">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left">
				
				<label for="ex-pass">Nouveau mot de passe <sup class="text-danger">*</sup></label>
				
			</div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<input type="password" name="ex_newpass" id="ex-pass" class="form-control form-control-sm" placeholder="nouveau mot de passe" required>

		        <span class="field-icon small toggle-password"><i class="fas fa-eye ex-field-icon"></i></span>

		        <div class="progress ex-progress" style="display: none;">
		            <div class="progress-bar" id="ex-pass-strenght" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
		        </div>
			
			</div>

		</div>

		<div class="row no-gutters mb-2">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left">
				
				<label for="ex-confirm">Confirmer le mot de passe <sup class="text-danger">*</sup></label>
				
			</div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<input type="password" name="ex_confirm" id="ex-confirm" class="form-control form-control-sm" placeholder="Confirmer le mot de passe">
			
			</div>

		</div>

		<div class="row no-gutters mt-4">
			
			<div class="col col-12 col-xs-12 col-md-6 col-lg-4 col-xl-3 ex-col-left"></div>
			<div class="col col-12 col-xs-12 col-md-6 col-lg-8 col-xl-9 ex-col-right">

				<input type="submit" name="saveusernewpassubmit" id="ex-subbmit-btn" class="btn btn-primary btn-sm ex-btn-primary" value="Valider">
			
			</div>

		</div>

	</form>
	
</div>