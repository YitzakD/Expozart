<div class="self-artwork" accesskey="<?= $ID ?>">

	<div class="row no-gutters exrow">
		
		<div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">

			<div class="d-block art-comment">

				<div class="artwork-info">

					<span class="avatar rounded-circle">
						
						<a href="<?= ex_gotoprofile($exUsername) ?>"  id="json-avatar-link">

							<?php if($avatar == true): ?>

							<img src="<?= $useravatar ?>" id="json-avatar" class="rounded-circle">

							<?php else: ?>

							<span class="ex-avatarname bg-expozart-violet" title="<?= ucfirst($exUsername) ?>" id="json-avatar-name"><?= $useravatar ?></span>

							<?php endif; ?>

						</a>

					</span>

					<span class="info">
						
						<div class="info-name">
							
							<a href="<?= ex_gotoprofile($exUsername) ?>" id="json-username" title="<?= ucfirst($exUsername) ?>"><?= ucfirst($exUsername) ?></a>

						</div>

						<div class="info-place">
							
							<span class="small mr-3" id="json-post-ago">Nouveau artwork</span>

						</div>

					</span>

				</div>

			</div>

		</div>
		
		<div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">

			<div class="d-flex art-content">

				<?php $hash = ex_hashgenerator(16, 'N') ?>

				<form action="<?= WURI . '/post/edit/' . $hash ?>" method="post" id="dropFileForm">

					<input type="file" name="files[]" id="artworkFile" multiple>

					<label for="artworkFile" id="artworkLabel">
						
						<i class="fas fa-download up-ico"></i>
						
						<span class="d-block mt-2" id="showtext">Choisissez une image ou glisser là ici</span>

						<span class="d-block mt-2" id="upstatus"></span>

					</label>

					<div class="d-block text-right">
	
						<input type="hidden" id="hashparam" value="<?= $hash ?>">

						<button id="uploadArtwork" type="submit" class="btn btn-primary ex-btn-primary">Suivant</button>

					</div>

				</form>

			</div>

		</div>

		<div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">

			<div class="d-block mt-2 text-center">
							
			
			</div>

		</div>


	</div>

</div>