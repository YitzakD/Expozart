<div class="exaccount-avatar">

	<div class="avatar rounded-circle">

	<?php if($avatar == true): ?>

		<img src="<?= $profileAvatar ?>" class="rounded-circle">

	<?php else: ?>

		<span class="ex-avatarname bg-expozart-violet"><?= ucfirst($profileAvatar) ?></span>

	<?php endif; ?>

	</div>
	
</div>

<div class="exaccount-avatar-form">
	
	<form action="<?= WURI . '/account/edit/avatar' ?>" method="post" id="upAvatarFileForm">
		
		<input type="file" name="avatar[]" id="avatarFile">

		<span class="d-block mt-2 avatar-status" id="upstatus"></span>

		<div class="mt-3">
			
			<button id="uploadAvatar" type="submit" class="btn btn-primary ex-btn-primary">Modifier</button>
			
		</div>

	</form>

</div>