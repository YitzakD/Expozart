
	<script src="<?= CDN . 'jquery/jquery.min.js'; ?>" type="text/javascript"></script>

	<script src="<?= CDN . 'bootstrap/js/popper.min.js'; ?>" type="text/javascript"></script>

	<script src="<?= CDN . 'bootstrap/js/bootstrap.min.js'; ?>" type="text/javascript"></script>

	<script src="<?= CDN . 'fontawesome/js/all.min.js'; ?>" type="text/javascript"></script>

	<script src="<?= CDN . 'imagesloaded/imagesloaded.pkgd.min.js'; ?>" type="text/javascript"></script>

	<script src="<?= CDN . 'masonry/masonry.pkgd.min.js'; ?>" type="text/javascript"></script>

	<script src="<?= CDN . 'elastic/jquery.elastic.source.js'; ?>" type="text/javascript"></script>

	<script src="<?= $JS . '/app-form.script.js'; ?>" type="text/javascript"></script>

	<?php if(($match['name'] !== "connexion") && ($match['name'] !== "inscription") && ($match['name'] !== "réinitialisation de compte") && ($match['name'] !== "récuperation de compte") && ($match['name'] !== "confirmation") && ($match['name'] !== "activation")): ?>

	<script src="<?= $JS . '/app-artwork.script.js'; ?>" type="text/javascript"></script>

	<?php endif; ?>

</body>

</html>