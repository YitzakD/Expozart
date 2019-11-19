<?php if(isset($_SESSION['ntf']['message'])) : ?>
    
    <div class="ex-alert <?= $_SESSION['ntf']['type']; ?> ml-auto exfade exshow ex-content-alert" id="js-ex-alert">

        <div class="alert-body" >

            <strong>

            	<?php if($_SESSION['ntf']['type'] === "info"): ?>Information!

            	<?php elseif($_SESSION['ntf']['type'] === "success"): ?>Félicitation!

            	<?php elseif($_SESSION['ntf']['type'] === "warning"): ?>Attention!

            	<?php elseif($_SESSION['ntf']['type'] === "danger"): ?>Erreur!

            	<?php else: ?>Conseil!

            	<?php endif; ?>

            </strong>

    	   <?= $_SESSION['ntf']['message']; ?>

        </div>

		<button type="button" class="ex-alert-close" data-dismiss="alert" title="Fermer"><span aria-hidden="true">&times;</span></button>

    </div>

    <?php $_SESSION['ntf'] = []; ?>

<?php endif; ?>