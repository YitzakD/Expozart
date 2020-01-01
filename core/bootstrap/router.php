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

}, 'accueil');




/*$router->map('GET|POST', '/home', function() {

	require EXPOZART . '/home.php';

}, 'accueil');*/




$router->map('GET|POST', '/login', function() {

	require AUTH . '/login.php';

}, 'connexion');




$router->map('GET|POST', '/recovery', function() {

	require AUTH . '/recovery.php';

}, 'récupération de compte');




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




$router->map('GET|POST', '/logout/[*:hashedid]', function() {

	require AUTH . '/logout.php';

}, 'deconnexion');




$router->map('GET|POST', '/categories', function() {

	require CATEGORY . '/categories.php';

}, 'catégories');




$router->map('GET|POST', '/post/[*:type]', function() {

	require ARTWORK . '/post.php';

}, 'artwort-post');




$router->map('GET|POST', '/a/[i:arthash]', function() {

	require ARTWORK . '/artwork.php';

}, 'artwork');




$router->map('GET|POST', '/unfound/[*:type]/[*:value]', function() {

	require ERR . '/unfound.php';

}, 'unfound');




$router->map('GET|POST', '/account/[*:type]', function() {

	require ACCOUNT . '/account.php';

}, 'account');




$router->map('GET|POST', '/[*:username]', function() {

	require ACCOUNT . '/profile.php';

}, 'profile');




/**
 * 	exVar_authappentriesname
 *	tableau contenant les nom des pages sans menu
 */
$exVar_authappentriesname = array(
	'connexion', 
	'inscription', 
	'réinitialisation de compte', 
	'récupération de compte', 
	'confirmation', 
	'activation'
);