<ul class="ex-account-nav-pills mr-3" accesskey="<?= $MOD ?>">
	
	<li>

		<a href="<?= $router->generate('account', ['type' => 'edit']); ?>" class="nav-link <?= !isset($VUE) ? 'active' : ''  ?>">Modifier le profil</a>

	</li>

	<li>

		<a href="<?= $router->generate('account', ['type' => 'edit']); ?>/avatar" class="nav-link <?= isset($VUE) && $VUE === 'avatar'  ? 'active' : ''  ?>">Image de profill</a>

	</li>

	<li>

		<a href="<?= $router->generate('account', ['type' => 'edit']); ?>/password" class="nav-link <?= isset($VUE) && $VUE === 'password'  ? 'active' : ''  ?>">Changer de mot de passe</a>

	</li>

	<!-- <li>

		<a href="#" class="nav-link <?= isset($VUE) && $VUE === 'security'  ? 'active' : ''  ?>">Sécurité et confidentialité</a>

	</li> -->

	<li>

		<a href="<?= $router->generate('account', ['type' => 'edit']); ?>/activity" class="nav-link <?= isset($VUE) && $VUE === 'activity'  ? 'active' : ''  ?>">Activité de connexion</a>

	</li>

</ul>