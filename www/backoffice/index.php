<?php
require('security.php');
session_start();
require_once('../vendor/autoload.php');

use App\DataBase\ArticleController;
use App\Views\DefaultController;







$Article = new ArticleController();
$articles = $Article->gets();

ob_start();



	date_default_timezone_set('Europe/Paris');
	// --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
	setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK
	$articlesCopy = $articles;
	foreach ($articlesCopy as $article) :
		if(!empty($article['sortUrl'])):
			$lienArticle = 'https://nandyba.fr/backoffice/'.$article['sortUrl'];
		else:	
			$lienArticle = 'https://nandyba.fr/backoffice/getArticle.php?article_id='.$article['id'];
		endif;
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
					<a title="lien vers l'auteur de l'article" rel="nofollow" href="https://nandyba.fr" class="author"><span class="name">Nandy Bâ</span><img src="../public/images/tinny/nandy.jpg" alt="photo de Nandy Bâ" /></a>
					<?php else: ?>
					<a title="lien vers l'auteur de l'article" rel="nofollow" class="author"><span class="name"><?= $article['metaAuthor'] ?></span><img src="../blog/loadimage.php?file=avatar&format=jpg" alt="" /></a>	
					<?php endif; ?>
				</div>
			</header>
			<a title="consulter l'article" href="<?= $lienArticle ?>" class="image featured"><img src="../public/images/<?= $article['imageUrl']; ?>" alt="" /></a>
			<?= $article['metaDescription'] ?>
			<footer>
				<ul class="actions">
					<li><a title="" href="<?= $lienArticle ?>" class="button big" rel="nofollow">Lire la suite</a></li>
				</ul>
				<!-- <ul class="stats">
					<li><a title="" href="#">General</a></li>
					<li><a title="" href="#" class="icon fa-heart">28</a></li>
					<li><a title="" href="#" class="icon fa-comment">128</a></li>
				</ul> -->
			</footer>
		</article>
		<?php

	endforeach;

$content = ob_get_clean();
$View = new DefaultController('Liste des articles du blog', 'Meta description en cour de réalisation', true);
$View->render($content);
?>