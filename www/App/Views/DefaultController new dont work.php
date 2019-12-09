<?php
namespace App\Views;

class DefaultController{
	protected $backoffice;
	protected $title;
	protected $metaDescription;
	protected $metaAuthor;
	protected $scripts;
	protected $css;

	function __construct($title, $description, $backoffice = false)
	{
		$this->backoffice = $backoffice;
		$this->title = $title;
		$this->metaDescription = $description;
		$this->metaAuthor = 'Nandy Bâ';
		$this->scripts = array('dist/bundle.js');
		// all.css include main.css font-awesone.css and add.css
		$this->css = array('main.css', 'add.css');
	}

	public function addcss($css){
		$this->css = array_merge($this->css, $css);
	}

	public function addjs($js){
		$this->scripts = array_merge($this->scripts, $js);
	}

	function render($content = '', $type = '', $index = true){ ?>
		<!DOCTYPE html>
		<html lang="fr">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<meta name="viewport" content="initial-scale=1.0, width=device-width">
				<title><?= $this->title; ?> | Nandyba.fr</title>
				<!-- Import add.css, font-awesome.css and main.css -->
				<style>
					<?php foreach ($this->css as $cssfile):
						if($type == 'index'){
							include('css/'.$cssfile);
						}else{
							include('../css/'.$cssfile);
						}
						
					endforeach; ?>
				</style>
				<?php if($index == false): ?>
					<meta name="robots" content="none,noindex,nofollow">
				<?php else: ?>
					<!-- A supprimer à la mise en ligne du site -->
					<meta name="robots" content="none,noindex,nofollow">
				<?php endif; ?>
				<meta name="description" content="<?= $this->metaDescription; ?>">
				<meta name="Author" content="<?= $this->metaAuthor; ?>">
				<link rel="icon" type="image/png" sizes="512x512" href="https://nandyba.fr/css/images/icon512.png">
				<link rel="manifest" href="https://nandyba.fr/manifest.json">
				 <meta name="theme-color" content="#009688"/>
			</head>
			<body>
				<!-- header -->
				<?php
				if($type == 'index'){
					require 'header.php';
				}else{
					require '../header.php';
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
								require 'footer.php';
							}else{
								require '../footer.php';
							}
									?>
						</div>
					</div>
				<!-- Use Webpack -->
				
					<?php foreach ($this->scripts as $jsfile):
						if($type == 'index'){
							?><script src="<?= $jsfile ?>"></script><?php
						}else{
							?><script src="<?= '../'.$jsfile ?>"></script><?php
						}
					endforeach; ?>
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

			</body>
		</html>
			<?php
	}
}



?>