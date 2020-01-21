	
	<script src="<?= CDN . 'jquery/jquery.min.js'; ?>" type="text/javascript"></script>

	<script src="<?= CDN . 'bootstrap/js/popper.min.js'; ?>" type="text/javascript"></script>

	<script src="<?= CDN . 'bootstrap/js/bootstrap.min.js'; ?>" type="text/javascript"></script>

	<script src="<?= CDN . 'fontawesome/js/all.min.js'; ?>" type="text/javascript"></script>

	<script src="<?= CDN . 'imagesloaded/imagesloaded.pkgd.min.js'; ?>" type="text/javascript"></script>

	<script src="<?= CDN . 'masonry/masonry.pkgd.min.js'; ?>" type="text/javascript"></script>

	<script src="<?= CDN . 'elastic/jquery.elastic.source.js'; ?>" type="text/javascript"></script>

	<script src="<?= $JS . '/app-form.script.js'; ?>" type="text/javascript"></script>

	<?php if(!in_array($match['name'], $exVar_authappentriesname)): ?>

		<?php if($match['name'] === "artwork"): ?>

		<script src="<?= $JS . '/app-self-artwork.script.js'; ?>" type="text/javascript"></script>
		
		<?php elseif($match['name'] === "catégories"): ?>

		<script src="<?= $JS . '/app-category.script.js'; ?>" type="text/javascript"></script>

		<?php elseif($match['name'] === "profil"): ?>

		<script src="<?= $JS . '/app-profile.script.js'; ?>" type="text/javascript"></script>

		<?php else: ?>

		<script src="<?= $JS . '/app-artwork.script.js'; ?>" type="text/javascript"></script>

		<?php endif; ?>
		
	<?php endif; ?>

</body>

</html>