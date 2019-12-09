<?php
namespace App\Views;

class DefaultControllerNew{
	protected $backoffice;
	protected $canonical;
	protected $title;
	protected $metaDescription;
	protected $metaAuthor;
	protected $scripts;
	protected $css;
	protected $imgUrl;
	protected $richSnippet;

	function __construct($title, $description, $backoffice = false)
	{
		$this->backoffice = $backoffice;
		$this->title = $title;
		$this->metaDescription = $description;
		$this->metaAuthor = 'Nandy Bâ';
		$this->scripts = array('serviceWorker.js', 'public/js/jquery.min.js', 'public/js/lazyload.min.js', 'public/js/skel.min.js', 'public/js/util.js', 'public/js/main.js', 'public/js/jquery-cookie.min.js', 'public/js/jquery-tracker.js');
		// all.css include main.css font-awesone.css and add.css
		$this->css = array('app3.css','cookie.css');
	}

	public function SendCanonical($canonical)
	{
		$this->canonical = $canonical;
	}


	public function removeCss()
	{
		$this->css = array('');
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

	public function addRichSnippet($img_url, $content_url, $content_headline, $content_text, $content_date, $content_author, $content_rating = null)
	{
		ob_start();
		?><script type='application/ld+json'>
			{
				"@context": "https://schema.org/",
				"@type": "Article",
				"mainEntityOfPage": {
		         	"@type": "WebPage",
		         	"@id": "<?= $content_url ?>"
		      	},
				"articleSection": "Finance",
				"author": "<?= $content_author; ?>",
				<?php if($content_rating != null): ?>
					"contentRating": "<?= $content_rating; ?>",
				<?php endif;?>
				"copyrightYear": "2018",
				"image": {
					"@type": "ImageObject",
					"url": "https://nandyba.fr/public/images/<?= $img_url; ?>"
				},
			    "headline": "<?= $content_headline; ?>",
			    "url": "<?= $content_url; ?>",
			    "datePublished":"<?= $content_date; ?>",
			    "dateModified": "<?= $content_date; ?>",
			    "publisher": {
				    "@type": "Organization",
				    "name": "<?= $content_author; ?>",
				    "logo": {
				    	"@type": "ImageObject",
				    	"url": "https://nandyba.fr/public/images/blanc.jpg"
					}

				},
				"encoding": "utf-8"
			}
		</script><?php
		$this->richSnippet = ob_get_clean();
	}

	public function render($content = '', $type = '', $indexing = true){ ?>
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
				<?php if($this->richSnippet != null):
					echo $this->richSnippet;
				endif; ?>
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
					<meta property="og:image" content="<?= 'https://nandyba.fr/public/images/'.$this->imgUrl; ?>"/>
				<?php endif; ?>

				<!-- Twitter Card -->
				<meta name="twitter:card" content="summary" />
				<meta property="twitter:title" content="<?= $this->title; ?> | Nandyba.fr" />
				<meta name="twitter:site" content="nandyba.fr" />
				<meta name="twitter:creator" content="@NandyBa" />
				<meta property="twitter:description" content="<?= $this->metaDescription; ?>" />
				<?php if($this->imgUrl != null): ?>
					<meta property="twitter:image" content="<?= 'https://nandyba.fr/public/images/'.$this->imgUrl; ?>"/>
				<?php endif; ?>
				
				<!-- Pinterest -->
				<meta name="p:domain_verify" content="759b169783bc9d1fa64a0ef464664b5c"/>

				<style>
					<?php foreach ($this->css as $cssfile):
						if($type == 'index'){
							include('public/css/'.$cssfile);
						}else{
							include('../public/css/'.$cssfile);
						}
						
					endforeach; ?>
				</style>
				
			</head>
			<body>
				<!-- header -->
				<?php
				if($type == 'index'){
					require 'View/headerNew.php';
				}else{
					require '../View/headerNew.php';
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
								require 'View/footerNew.php';
							}else{
								require '../View/footerNew.php';
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

			</body>
		</html>
			<?php
	}
}
?>