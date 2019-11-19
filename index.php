<?php
/**
 *	Expozart
 *	Index page
 *	Code:	yitzakD
 */




session_start();

require 'core/core.php';

$match = $router->match();

if($match !== null) {

	include_once ASSETS . '/_header.php';

	if(is_callable($match['target'])) {

		call_user_func_array($match['target'], $match['params']);

	} else {

		$params = $match['params'];

		require APP . "/{$match['target']}.php";

	}

	include_once ASSETS . '/_footer.php';

} else {

	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}