<?php
/**
 *	Expozart
 *	Router config:	initialise les éléments de routing
 *	Code:	yitzakD
 */




require ROOT . DS . 'vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

$router = new AltoRouter();

$router->map('GET|POST', '/', function() {

	require EXPOZART . '/home.php';

});




/*$router->map('GET|POST', '/home', function() {

	require EXPOZART . '/home.php';

}, 'accueil');*/




$router->map('GET|POST', '/login', function() {

	require AUTH . '/login.php';

}, 'connexion');




$router->map('GET|POST', '/recovery', function() {

	require AUTH . '/recovery.php';

}, 'récuperation de compte');




$router->map('GET|POST', '/reset/user/[*:hashedid]', function() {

	require AUTH . '/reset.php';

}, 'réinitialisation de compte');




$router->map('GET|POST', '/register', function() {

	require AUTH . '/register.php';

}, 'inscription');




$router->map('GET|POST', '/confirm/user/[*:hashedid]', function() {

	require AUTH . '/confirm.php';

}, 'confirmation');




$router->map('GET|POST', '/activate/[*:userhash]/[*:token]', function() {

	require AUTH . '/activate.php';

}, 'activation');




$router->map('GET|POST', '/categories', function() {

	require EXPOZART . '/categories.php';

}, 'catégories');