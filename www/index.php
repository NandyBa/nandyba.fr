<?php
require('vendor/autoload.php');

use App\Header\HeaderController;

session_start();

$Header = new HeaderController();
$Header->forceHTTPS();

?>
<html lang="fr">
	<head>
		<style>
			<?php
				include('public/css/accueil.css');
			?>
		</style>
		<meta name="viewport" content="initial-scale=1.0, width=device-width">
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119917047-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-119917047-1');
		</script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="canonical" href="https://nandyba.fr" />
		<title>Des astuces inovantes sur l'épargne | Nandyba.fr</title>
		<meta name="description" content="Sur ce site vous trouverez des astuces pour gérer au mieux votre épargne">
		<meta name="Author" content="Nandy Bâ">
		<link rel="icon" type="image/png" sizes="512x512" href="https://nandyba.fr/public/images/icon512.png">
		<link rel="manifest" href="https://nandyba.fr/manifest.json">
		<meta name="theme-color" content="#009688"/>

		<!-- Pinterest -->
		<meta name="p:domain_verify" content="759b169783bc9d1fa64a0ef464664b5c"/>
		<script>
			<?php
				include('serviceWorker.js');
			?>
		</script>
	</head>
	<body>
		<header>Nandy Bâ</header>
		<main>
			<h1>Trouver la route de l'épargne</h1>
			<a href="https://nandyba.fr/blog/epargne-dynamique" class="btn btn-primary">Alternative au livret A à 4% par an</a>
			<a href="https://nandyba.fr/blog/epargner-a-30ans" class="btn">Les meilleurs livrets d'épargne</a>
		</main>
		<footer>
			<img src="https://nandyba.fr/public/images/tinny/nandy@50.jpg" alt="Nandy Bâ photo de profil">
			<div>
				<h3>Qui suis-je ?</h3>
				<p>Je suis un étudiant en ingérieurie passioné par la Finance. Je dégote les meilleures opportutinés bancaires et les mets à votre disposition sur ce blog
				</p>
			</div>
		</footer>
	</body>
</html>