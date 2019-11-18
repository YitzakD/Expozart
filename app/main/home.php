<?php

if(!is_logged()) {

	$fwURI = $_SERVER['REQUEST_URI'];

	$_SESSION['forwardingURI'] = $fwURI.'/';

	header('Location:' . WURI . '/login/');	
		
	exit();

}

?>

<h1>Home</h1>