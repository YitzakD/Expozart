<?php
/**
 *	Expozart
 *	chosen ajax app:	indique explicitement le nombre de choix fait
 *	Code:	yitzakD
 */




/** Constantes d'environnement	*/
$WEBROOT = dirname(dirname(dirname(__FILE__)));

$ROOT = dirname(dirname($WEBROOT));

$DS = DIRECTORY_SEPARATOR;

$CORE = $ROOT.$DS.'core';

session_start();

include_once $CORE.$DS.'database/db-config.php';

include_once $CORE.$DS.'app/global.func.php';

include_once $CORE.$DS.'app/auth.func.php';

include_once $CORE.$DS.'includes/account.var.php';

?>

<?php if(exAuth_getsession("userid") && exAuth_getsession("userhash")): ?>

	<?php $rest = 5 - count($exVar_usercategoriesAffiliation); ?>

	<?php if($rest > 0): ?>

	<p class="h5 strong text-expozart-pink">Plus que <?= $rest > 1 ? $rest . " catégories" : $rest . " catégorie" ?></p>

	<?php else: ?>

	<p class="h5 strong text-expozart-pink">Le compte y est</p>
	
	<?php endif; ?>	

<?php endif; ?>