<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Expozart, Technologie, Art">

    <meta name="author" content="CEO - Yitzak DEKPEMOU for Expozart">

    <style type="text/css">

    	.body {
    		width: 100%;
    		height: auto;
    		min-height: 500px;
    		display: block;
    		margin: 0 auto;
    		background-color: #F6F6F6;
    		padding-top: 12%
    	}
    	.div {
    		display: block;
    		margin: 0 auto;
    		width: 70%;
    		height: auto;
    		font-size: .95rem;
    	}
    	.logo { margin: 0 0 2rem 0; }
    	.div p { margin: 5px 0; }
		.div a {
		    color: rgba(108, 63, 152, 1);
		    font-weight: 600;
		}
		.div a:hover { color: rgba(108, 63, 152, .85); }
		.bg-white { background-color: white; }
    	.text-center { text-align: center; }
    	.text-grey { color: #666666; }
    	.ex-p-4 { padding: 1.5rem; }
		.ex-display-3 {
		    font-size: 2rem;
		    font-weight: 300;
		    line-height: 1.2;
		}
    	.ex-border { border: 1px solid #404041!important; }
    	.ex-rounded { border-radius: .3rem!important; }
    	.havebutton { padding: 3rem 0; }
		.ex-btn-primary {
			font-weight: 600;
			background-color: rgba(108, 63, 152, 1);
			border-style: solid;
			border-width: 1px;
		    border-color: rgba(108, 63, 152, 1);
		    padding: .5rem 2.5rem;
		    border-radius: 2rem;
		    color: white!important;
		    box-shadow: none;
		    cursor: pointer;
		    text-decoration: none;
		}
		.ex-btn-primary:hover,
		.ex-btn-primary:focus,
		.ex-btn-primary:active {
			background-color: rgba(108, 63, 152, .85);
		    border-color: rgba(108, 63, 152, .85);
		}

	</style>

</head>

<body>

<div class="body">	

	<div class="div ex-p-4 ex-rounded bg-white">

		<div class="text-center logo">

			<img src="<?= WURI . 'resources/public/media/uses/logo.png' ?>">

		</div>

		<h1 class="ex-display-3 text-center">Activation de votre compte!</h1>

		<p class="ex-p-4">Hey <a href><?= $username ?></a>,</p>

		<p class="">
			Merci de votre inscription sur <a href="<?= WURI ?>"><?= WEBSITE_NAME ?></a>!<br>
			Avant de continuer, nous devons juste confirmer que c'est bien vous.<br>
			Cliquez ci-dessous pour vérifier votre adresse e-mail:
		</p>

		<div class="text-center havebutton">
			
			<a href="<?= WURI . '/activate/' .  $userhashID . '/' . $token . '/'; ?>" class="btn btn-md btn-primary ex-btn-primary m-0">Activer mon compte</a>

		</div>
		
	</div>

	<div class="div ex-p-4 text-center text-grey"><?= WEBSITE_COPYRIGHT ?></div>

</div>

</body>

</html>