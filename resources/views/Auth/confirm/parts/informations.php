<div class="d-block pt-4 pl-4 pr-4 text-center">
	
	<p>

		Un mail de confirmation a été envoyé à l'adresse suivante <a href='mailto:<?= $usermail ?>'><?= $usermail ?></a>. Nous vous invitons à vérifier votre boite de réception.

	</p>

	<p>
		Vous n'avez pas reçu de mail? 

		<form method="POST" action="<?= WURI . '/confirm/user/' . $VUE . '/resent' ?>" class="d-inline-block p-0 m-0">

			<button type="submit" class="btn btn-md btn-primary ex-btn-primary m-0" name="resentsubmit" id="ex-subbmit-btn">Renvoyer le mail</button>

		</form>

	</p>

</div>