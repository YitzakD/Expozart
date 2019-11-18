<?php
/**
 *	Expozart
 *	Router config:	initialise les éléments de routing
 *	Code:	yitzakD
 */




require ROOT . DS . 'vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

$router = new AltoRouter();

$router->map('GET', '/', 'main/home', 'accueil');

/*$router->map('GET|POST', '/', function() {

	require AUTH . '/login.php';

}, 'login');*/

/*$router->map('GET|POST', '/login', 'auth/login', 'login');*/

$router->map('GET|POST', '/login/', function() {

	require AUTH . '/login.php';

}, 'login');