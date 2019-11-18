<?php
/**
 *	Expozart
 *	Constant part:	initiatlise les variables constantes nécéssaire pour le site
 *	Code:	yitzakD
 */




#	Normal constants
define('WEBSITE_NAME', 'Expozart');

define('NOREPLY_MAIL', 'noreply@expozart.com');

define('WURI', 'http://localhost:8000');

define('CDN', 'http://localhost/localcdn/');


define('ROOT', dirname(dirname(dirname(__FILE__))));

define('DS', DIRECTORY_SEPARATOR);


define('EXCORE', ROOT . DS . 'core');


define('APP', ROOT . DS . 'app');
	
	define('AUTH', APP . DS . 'auth');
	
	define('ACCOUNT', APP . DS . 'account');

	define('ERR', APP . DS . 'errors');

	define('EXPOZART', APP . DS . 'main');


define('RESOURCES', ROOT . DS . 'resources');

	define('VIEWS', RESOURCES . DS . 'views');

	define('LAYOUTS', VIEWS . DS . 'layouts');

		define('PARTIALS', LAYOUTS . DS . 'partials');
		
		define('ASSETS', LAYOUTS . DS . 'assets');

	define('PAGES', VIEWS . DS . 'pages');

	define('TEMPLATES', RESOURCES . DS . 'templates');

		define('EX_EMAILS', TEMPLATES . DS . 'emails');




#	HARD constants
$RESOURCES = WURI . 'resources';

$NEEDLES = $RESOURCES . '/public';

	$CSS 	= $NEEDLES . '/css';

	$JS		= $NEEDLES .  '/js';

	$MEDIAS	= $NEEDLES . '/media';

		$UPLOAD = $MEDIAS . '/uploads';		

?>