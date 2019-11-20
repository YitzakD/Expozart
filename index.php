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

	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

		header('Content-Type: application/json');

		call_user_func_array($match['target'], $match['params']);

	} else {

		include_once ASSETS . '/_header.php';

		if(is_callable($match['target'])) {

			if(!in_array($match['name'], $exVar_authappentriesname)) { include_once PARTIALS . '/main.header.php'; }
			
			call_user_func_array($match['target'], $match['params']);

			if(!in_array($match['name'], $exVar_authappentriesname)) { include_once PARTIALS . '/main.footer.php'; }

		} else {

			header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');

		}

		include_once ASSETS . '/_footer.php';
	}

}