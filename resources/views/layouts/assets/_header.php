<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Expozart, Technologie, Art">

    <meta name="author" content="CEO - Yitzak DEKPEMOU for Expozart">

    <link rel="icon" href="<?= $MEDIAS . '/uses/ico.png'; ?>">

    <title><?= ex_title($match['name']) . ' | ' . WEBSITE_NAME; ?></title>

    <link rel="stylesheet" type="text/css" href="<?= CDN . 'bootstrap/css/bootstrap.min.css'; ?>">

    <link rel="stylesheet" type="text/css" href="<?= $CSS . '/app-style.css'; ?>">

</head>

<body>

	<div class="ex-block-alert exheight position-absolute d-flex flex-column p-4">
	
		<?php include_once PARTIALS . '/notifications/_flash.php'; ?>

		<?php include_once PARTIALS . '/notifications/_error.php'; ?>

	</div>