<?php
/**
 *	Expozart
 *	counter ajax app:	compte le nombre de choix et affiche un boutton si e compte y est
 *	Code:	yitzakD
 */




/** Constantes d'environnement	*/
$WEBROOT = dirname(dirname(dirname(__FILE__)));

$ROOT = dirname(dirname($WEBROOT));

$DS = DIRECTORY_SEPARATOR;

$CORE = $ROOT.$DS.'core';

/**
 *	$URI = $_SERVER["HTTP_REFERER"];
 *	
 *	$URL = array_filter(explode('/categories', $URI));
 */

$WURI = 'http://' . $_SERVER['HTTP_HOST'];

session_start();

include_once $CORE.$DS.'database/db-config.php';

include_once $CORE.$DS.'app/global.func.php';

include_once $CORE.$DS.'app/auth.func.php';

include_once $CORE.$DS.'includes/account.var.php';

?>

<?php if(exAuth_getsession("userid") && exAuth_getsession("userhash")): ?>

	<?php if(count($exVar_usercategoriesAffiliation) > 4): ?>

		<a href="<?= $WURI ?>" role="button" class="btn btn-md btn-primary ex-btn-primary ex-btn-primary-sm" id="ex-subbmit-btn">Construire ma page</a>
	
	<?php endif; ?>	

<?php endif; ?>

