<div class="ex-account-page">
	
	<div class="row no-gutters">
		
		<div class="col-xs-12 col-md-12 col-lg-4 col-xl-3"><?php require $SUBPAGE . "account.menu.php"; ?></div>

		<div class="col-xs-12 col-md-12 col-lg-8 col-xl-9">


			<div class="ex-account-tab-content" id="ex-account-tab-content" accesskey="<?= exAuth_getsession('userid') ?>">
			
				<?= $__account ?>
			
			</div>


		</div>	

	</div>

</div>