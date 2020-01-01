<div class="self-artwork" accesskey="<?= $ID ?>">

	<div class="row no-gutters exrow">
		
		<div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">

			<div class="d-block art-comment">

				<div class="artwork-info">

					<span class="avatar rounded-circle">
						
						<a href="<?= ex_gotoprofile($exUsername) ?>"  id="json-avatar-link">

							<?php if($avatar == true): ?>

							<img src="<?= $useravatar ?>" id="json-avatar">

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
							
							<span class="small mr-3" id="json-post-ago">A propos de cet Artwork</span>

						</div>

					</span>

				</div>

			</div>

		</div>
		
		<div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">

		<div class="d-flex art-content">

			<select class="form-control mb-3 text-family-title" id="json-post-topic">

				<?php foreach($usertopics as $item): ?>
				
				<?php $topic = ex_findone("ex_topics", "ID", $item->tID); ?>

				<option value="<?= $item->ID ?>"><?= $topic->topicname ?></option>

				<?php endforeach; ?>

			</select>

			<textarea id="json-post-content" class="form-control" placeholder="De quoi s'agit-il?" ondrop="return false;"></textarea>

			<div class="row no-gutters mt-3">
				
				<div class="col-12 col-xs-12 col-sm-12 col-md-7 col-lg-8 col-xl-9">

					<span class="small">
						
						<span class="text-muted">Nombre de caractères restant : </span>

						<strong class="text-expozart-violet-hover"><span class="json-remaining"></span></strong>

					</span>

				</div>

				<div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-4 col-xl-3 text-right">

					<input type="hidden" id="json-arthash-param" value="<?= $ID ?>">
					
					<button id="json-artwork-publisher" class="btn btn-primary ex-btn-primary">Publier</button>

				</div>

			</div>

		</div>

		</div>

		<div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">

			<div class="d-block mt-2">
				
				<span class="text-muted small m-2">

					<?= count($artworkmedias)  > 1 ? count($artworkmedias) . " Medias associés" : count($artworkmedias) . " Media associé"; ?>
						
				</span>

				<div class="row no-gutters">
					
					<?php if(count($artworkmedias) > 0): ?>

						<?php foreach ($artworkmedias as $item):?>
		
						<div class="col-6 col-xs-6 col-sm-6 col-md-3 col-lg-2 col-xl-2">
						
							<div class="post-artwork-item">
								
								<img src="<?= $item->fileroad_sm; ?>">
								
							</div>	

						</div>

						<?php endforeach; ?>

					<?php endif; ?>
				</div>				
			
			</div>

		</div>


	</div>

</div>