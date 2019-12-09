<?php
// require('security.php');
require('../vendor/autoload.php');

use App\Header\HeaderController;
use App\DataBase\ArticleController;
use App\Views\DefaultControllerNew;

session_start();

$Header = new HeaderController();
$Header->forceHTTPS();

if(!isset($_GET['article_id'])){
	$Header->Send404();
	?>
	<div>entrer l'article_id</div>
	<?php
	die();
}

$Article = new ArticleController();
$article = $Article->get($_GET['article_id']);
date_default_timezone_set('Europe/Paris');
// --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK
ob_start();
?>
<!-- Post -->
	<article class="post">
		<?php if(!empty($article['sortUrl'])): ?>
			<a href="https://nandyba.fr/backoffice/edit/<?= $article['sortUrl']; ?>">Consulter cet article</a>
		<?php else: ?>
			<a href="https://nandyba.fr/backoffice/edit/article/<?= $article['id']; ?>">Consulter cet article</a>
		<?php endif; ?>
		<header>
			<div class="title">
				<h1><?= $article['title'] ?></h1>
			</div>
			<div class="meta">
				<time class="published" datetime="<?= $article['date'] ?>"><?= strftime("%d %B %Y",strtotime($article['date'])); ?></time>,
				<?php
				if($article['metaAuthor'] == 'Nandy Bâ' || $article['metaAuthor'] == 'Nandy'): ?>
				<a title="lien vers l'auteur de l'article" rel="nofollow" href="https://nandyba.fr/cv.php" class="author"><span class="name">Nandy Bâ</span><img src="https://nandyba.fr/public/images/tinny/nandy@50.jpg" alt="photo de Nandy Bâ" /></a>
				<?php else: ?>
				<a title="lien vers l'auteur de l'article" rel="nofollow" class="author"><span class="name"><?= $article['metaAuthor'] ?></span><img src="https://nandyba.fr/public/images/avatar.jpg" alt="" /></a>	
				<?php endif; ?>
			</div>
		</header>
		<?= str_replace('<img src', '<img src="" data-src', $article['description'])  ?>
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
$View = new DefaultControllerNew($article['metaTitle'], $article['metaDescription']);
if(!empty($article['sortUrl'])){
	$url = 'https://nandyba.fr/blog/'.$article['sortUrl'];
	$View->SendCanonical($url);
	$View->addRichSnippet($article['imageUrl'], $url, $article['title'], $article['metaDescription'], $article['date'], $article['metaAuthor']);
}

$View->render($content, 'article');


