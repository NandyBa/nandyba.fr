<?php
require('../vendor/autoload.php');

use App\Header\HeaderController;
use App\DataBase\ArticleController;
use App\Views\DefaultController;

session_start();

$Header = new HeaderController();
$Header->forceHTTPS();

if(!isset($_GET['article_id'])){
	?>
	<div>entrer l'article_id</div>
	<?php
	die();
}

$Article = new ArticleController();
$article = $Article->get($_GET['article_id']);


if ($article['publish'] == 'false') {
	ob_start();
	?>
	<article class="post">
		<p>Article en écriture, il devrait paraître dans moins d'une semaine désolé la gêne occassionée </p>
		<!-- <footer>
			<ul class="stats">
				<li><a title="" href="#">General</a></li>
				<li><a title="" href="#" class="icon fa-heart">28</a></li>
				<li><a title="" href="#" class="icon fa-comment">128</a></li>
			</ul>
		</footer> -->
	</article>
	<?php
	$content = ob_get_clean();
	$View = new DefaultController($article['metaTitle'], $article['metaDescription']);
	$View->render($content, 'article', false);
	exit();
}

ob_start();
?>


<!-- Post -->
	<article class="post">
		<header>
			<div class="title">
				<h1><?= $article['title'] ?></h1>
			</div>
			<div class="meta">
				<time class="published" datetime="<?= $article['date'] ?>"><?= strftime("%d %B %Y",strtotime($article['date'])); ?></time>
				<?php
				if($article['metaAuthor'] == 'Nandy Bâ' || $article['metaAuthor'] == 'Nandy'): ?>
				<a title="lien vers l'auteur de l'article" rel="nofollow" href="https://nandyba.fr" class="author"><span class="name">Nandy Bâ</span><img src="../css/images/tinny/nandy@50.jpg" alt="photo de Nandy Bâ" /></a>
				<?php else: ?>
				<a title="lien vers l'auteur de l'article" rel="nofollow" class="author"><span class="name"><?= $article['metaAuthor'] ?></span><img src="../css/images/avatar.jpg" alt="" /></a>	
				<?php endif; ?>
			</div>
		</header>
		<?= $article['description'] ?>
		<!-- <footer>
			<ul class="stats">
				<li><a title="" href="#">General</a></li>
				<li><a title="" href="#" class="icon fa-heart">28</a></li>
				<li><a title="" href="#" class="icon fa-comment">128</a></li>
			</ul>
		</footer> -->
	</article>

<?php
$content = ob_get_clean();
$View = new DefaultController($article['metaTitle'], $article['metaDescription']);
$View->render($content, 'article');
?>