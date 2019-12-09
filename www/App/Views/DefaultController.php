<?php
namespace App\Views;

class DefaultController{
	protected $backoffice;
	protected $canonical;
	protected $title;
	protected $metaDescription;
	protected $metaAuthor;
	protected $scripts;
	protected $css;
	protected $imgUrl;

	function __construct($title, $description, $backoffice = false)
	{
		$this->backoffice = $backoffice;
		$this->title = $title;
		$this->metaDescription = $description;
		$this->metaAuthor = 'Nandy Bâ';
		$this->scripts = array('serviceWorker.js','public/js/jquery.min.js', 'public/js/skel.min.js', 'public/js/util.js', 'public/js/main.js', 'public/js/jquery-cookie.min.js', 'public/js/jquery-tracker.js');
		// all.css include main.css font-awesone.css and add.css
		$this->css = array('main.css', 'add.css','cookie.css');
	}

	public function SendCanonical($canonical)
	{
		$this->canonical = $canonical;
	}

	public function addcss($css){
		$this->css = array_merge($this->css, $css);
	}

	public function addjs($js){
		$this->scripts = array_merge($this->scripts, $js);
	}

	public function addHeaderImg($imgUrl){
		$this->imgUrl = $imgUrl;
	}

	function render($content = '', $type = '', $indexing = true){ ?>
		<!DOCTYPE html>
		<html lang="fr">
			<head>
				<?php
			    if($this->backoffice != true): ?>
				    <!-- Google Analytics -->
					<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119917047-1"></script>
					<script>
					  window.dataLayer = window.dataLayer || [];
					  function gtag(){dataLayer.push(arguments);}
					  gtag('js', new Date());

					  gtag('config', 'UA-119917047-1');
					</script>

			    <?php endif;?>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<meta name="viewport" content="initial-scale=1.0, width=device-width">
				<title><?= $this->title; ?></title>
				<?php if($this->canonical != null): ?>
					<link rel="canonical" href="<?= $this->canonical; ?>" />
				<?php endif; ?>
				<?php if($indexing == false): ?>
					<meta name="robots" content="none,noindex,nofollow">
				<?php endif; ?>
				<meta name="description" content="<?= $this->metaDescription; ?>">
				<meta name="Author" content="<?= $this->metaAuthor; ?>">
				<link rel="icon" type="image/png" sizes="512x512" href="https://nandyba.fr/public/images/icon512.png">
				<link rel="manifest" href="https://nandyba.fr/manifest.json">
				<meta name="theme-color" content="#009688"/>

				<!-- Facebook Meta -->
				<meta property="og:url" content="<?= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />
				<meta property="og:type" content="article" />
				<meta property="og:title" content="<?= $this->title; ?> | Nandyba.fr" />
				<meta property="og:description" content="<?= $this->metaDescription; ?>" />
				<?php if($this->imgUrl != null): ?>
					<meta property="og:image" content="<?= '.../css/images/'.$this->imgUrl; ?>"/>
				<?php endif; ?>

				<!-- Pinterest -->
				<meta name="p:domain_verify" content="759b169783bc9d1fa64a0ef464664b5c"/>
				
			</head>
			<body>
				<!-- header -->
				<?php
				if($type == 'index'){
					require 'View/header.php';
				}else{
					require '../View/header.php';
				}
				?>
				<!-- Warpper -->
				<?php
				if($type == 'article'): ?>
					<div id="wrapper-article">
						<!-- Main -->
						<div id="main">
				<?php elseif($type == 'article-edition'): ?>
					<div id="wrapper-article-edition">
						<!-- Main -->
						<div id="main">
				<?php else: ?>
					<div id="wrapper">
						<!-- Main -->
						<div id="main">
				<?php endif; ?>
							<!-- Content -->
							<?= $content; ?>
						<!-- </div> -->
								<!-- footer -->
							<?php
							if($type == 'index'){
								require 'View/footer.php';
							}else{
								require '../View/footer.php';
							}
									?>
						</div>
					</div>
				<script>
					<?php foreach ($this->scripts as $jsfile):
						if($type == 'index'){
							include($jsfile);
						}else{
							include('../'.$jsfile);
						}
					endforeach; ?>
				</script>
			    <!-- Import add.css, font-awesome.css and main.css -->
				<style>
					<?php foreach ($this->css as $cssfile):
						if($type == 'index'){
							include('public/css/'.$cssfile);
						}else{
							include('../public/css/'.$cssfile);
						}
						
					endforeach; ?>
				</style>

			</body>
		</html>
			<?php
	}
}



?>