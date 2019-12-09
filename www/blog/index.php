<?php
require('../vendor/autoload.php');

use App\Header\HeaderController;
use App\DataBase\ArticleController;
use App\Views\DefaultController;

session_start();

$Header = new HeaderController();
$Header->forceHTTPS();


$Article = new ArticleController();
$articles = $Article->gets();
ob_start();
?>
<h1>Liste des articles</h1>
<?php


	date_default_timezone_set('Europe/Paris');
	// --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
	setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK
	$articlesCopy = $articles;
	foreach ($articlesCopy as $article) :
		if($article['publish'] == 'true'):
			if(!empty($article['sortUrl'])):
				$lienArticle = 'https://nandyba.fr/blog/'.$article['sortUrl'];
			?>
			<!-- Post -->
				<article class="post">
					<header>
						<div class="title">
							<h2><a title="consulter l'article" href="<?= $lienArticle ?>"><?= $article['title'] ?></a></h2>
						</div>
						<div class="meta">
							<time class="published" datetime="<?= $article['date'] ?>"><?= strftime("%d %B %Y",strtotime($article['date'])); ?></time>
							<?php
							if($article['metaAuthor'] == 'Nandy Bâ' || $article['metaAuthor'] == 'Nandy'): ?>
							<a title="lien vers l'auteur de l'article" rel="nofollow" href="https://nandyba.fr/cv.php" class="author"><span class="name">Nandy Bâ</span><img title="Nandy Bâ" src="../public/images/tinny/nandy@50.jpg" alt="photo de Nandy Bâ" /></a>
							<?php else: ?>
							<a title="lien vers l'auteur de l'article" rel="nofollow" class="author"><span class="name"><?= $article['metaAuthor'] ?></span><img src="../blog/loadimage.php?file=avatar&format=jpg" alt="" /></a>	
							<?php endif; ?>
						</div>
					</header>
					<a title="consulter l'article" href="<?= $lienArticle ?>" class="image featured"><img src="../public/images/<?= $article['imageUrl']; ?>" title="<?= $article['title'] ?>" alt="<?= $article['title'] ?>" /></a>
					<?= $article['metaDescription'] ?>
					<footer>
						<ul class="actions">
							<li><a title="" href="<?= $lienArticle ?>" class="button big">Lire la suite</a></li>
						</ul>
						<!-- <ul class="stats">
							<li><a title="" href="#">General</a></li>
							<li><a title="" href="#" class="icon fa-heart">28</a></li>
							<li><a title="" href="#" class="icon fa-comment">128</a></li>
						</ul> -->
					</footer>
				</article>
			<?php
			endif;
		endif;

	endforeach;

$content = ob_get_clean();
$View = new DefaultController('Optimiser votre épargne toutes les astuces', "Vous trouvez ici l'ensemble des articles de mon blog sur l'optimisation de son épargne");
$View->SendCanonical('https://nandyba.fr');
$View->render($content, 'index');
?>