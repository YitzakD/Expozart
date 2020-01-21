<ul class="ex-account-nav-pills" accesskey="<?= $MOD ?>">
	
	<li>

		<a href="<?= $router->generate('modifier le profil', ['type' => 'edit']); ?>" class="nav-link <?= !isset($VUE) ? 'active' : ''  ?>">Modifier le profil</a>

	</li>

	<li>

		<a href="<?= $router->generate('modifier le profil', ['type' => 'edit']); ?>/avatar" class="nav-link <?= isset($VUE) && $VUE === 'avatar'  ? 'active' : ''  ?>">Photo de profil</a>

	</li>

	<li>

		<a href="<?= $router->generate('modifier le profil', ['type' => 'edit']); ?>/password" class="nav-link <?= isset($VUE) && $VUE === 'password'  ? 'active' : ''  ?>">Changer de mot de passe</a>

	</li>

	<!-- <li>

		<a href="#" class="nav-link <?= isset($VUE) && $VUE === 'security'  ? 'active' : ''  ?>">Sécurité et confidentialité</a>

	</li> -->

	<li>

		<a href="<?= $router->generate('modifier le profil', ['type' => 'edit']); ?>/activity" class="nav-link <?= isset($VUE) && $VUE === 'activity'  ? 'active' : ''  ?>">Activité de connexion</a>

	</li>

</ul>