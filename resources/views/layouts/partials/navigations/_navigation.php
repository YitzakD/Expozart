<div class="ex-inner-header">
	
	<div class="ex-inner-header-left relative float-left">

		<div class="logo d-inline-block mr-3">

			<a href="<?= $router->generate('accueil'); ?>">

				<img src="<?= $MEDIAS . '/uses/ico.png'; ?>" alt>

			</a>

		</div>

		<div class="search-box-contenor d-inline-block">

			<a href="#" id="show-search-box"><span><i class="fas fa-sm fa-search"></i></span></a>

			<div class="input-group">
				
				<div class="input-group-prepend">

					<div class="input-group-text" id="search-box"><i class="fas fa-sm fa-search"></i></div>

				</div>
				
				<input type="text" class="form-control ex-search-box-form-control" placeholder="Rechercher" aria-label="search" aria-describedby="search-box">

			</div>

		</div>

	</div>

	<div class="ex-inner-header-right relative float-right">

		<ul class="nav justify-content-end">

			<li class="nav-item">

				<a class="nav-link ex-nav-link <?= isset($match['name']) && $match['name'] === 'accueil'  ? 'active' : ''  ?>" href="<?= $router->generate('accueil'); ?>">

					<span>Accueil</span>

				</a>

			</li>

			<li class="nav-item">

				<a class="nav-link ex-nav-link <?= isset($match['name']) && $match['name'] === 'explorer'  ? 'active' : ''  ?>" href="#">

					<span>Expos</span><i class="far fa-sm fa-compass nav-h-ico"></i>

				</a>

			</li>

			<li class="nav-item">

				<a class="nav-link ex-nav-link <?= isset($match['name']) && ($match['name'] === 'profile') && ($MOD === exAuth_getsession("username"))  ? 'active' : ''  ?>" href="<?= ex_gotoprofile(exAuth_getsession('username')) ?>">

					<span><?= exAuth_getsession("username") ?></span><i class="far fa-sm fa-user-circle nav-h-ico"></i>

				</a>

			</li>

			<li class="nav-item">

				<a class="nav-link ex-nav-link <?= isset($match['name']) && $match['name'] === 'messenger'  ? 'active' : ''  ?>" href="#"><i class="far fa-sm fa-comment-alt"></i></a>

			</li>

			<li class="nav-item">

				<a class="nav-link ex-nav-link <?= isset($match['name']) && $match['name'] === 'notificator'  ? 'active' : ''  ?>" href="#"><i class="far fa-sm fa-bell"></i></a>

			</li>

			<li class="nav-item">

				<a class="nav-link ex-nav-link" id="ex-nav-content-dropdown" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">

					<i class="fas fa-sm fa-bars"></i>

				</a>

				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="ex-nav-content-dropdown">

					<a class="dropdown-item" href="#">Modifier les  paramètres</a>

					<a class="dropdown-item" href="#">Obtenir de l'aide</a>

					<a class="dropdown-item" href="#">Règles de confidentialités</a>

					<a class="dropdown-item" href="#">Conditions d'utilisations</a>

					<div class="dropdown-divider"></div>

					<form action="<?= $router->generate('deconnexion', ['hashedid' => exAuth_getsession("userhash")]) ?>" method="POST" class="p-0 m-0">
						
						<button type="submit" class="btn dropdown-item text-danger">Se déconecter</button>

					</form>

				</div>

			</li>

		</ul>

	</div>

</div>