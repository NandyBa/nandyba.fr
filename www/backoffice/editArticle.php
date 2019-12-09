<?php
require('security.php');

use App\Header\HeaderController;
use App\DataBase\ArticleController;
use App\Views\DefaultControllerNew;


if(!isset($_GET['article_id'])){
	?>
	<div>entrer l'article_id</div>
	<?php
	die();
}




if(isset($_POST['id']) and isset($_POST['publish']) and isset($_POST['markdown-data']) and isset($_POST['title']) and isset($_POST['meta-title']) and isset($_POST['meta-description']) and isset($_POST['meta-author']) and isset($_POST['markdown'])){

	$description = str_replace('<a ', "<a target=\"_blank\" rel=\"noopener\" ", $_POST['markdown-data']);
	$Article = new ArticleController();
	$Article->update($_POST['id'], $_POST['publish'], $_POST['title'], $_POST['meta-title'], $_POST['meta-description'], $_POST['meta-author'], $description, $_POST['markdown'], $_POST['words'] );
}
$Article = new ArticleController();
$article = $Article->get($_GET['article_id']);

ob_start();
?>
	<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
	<?php if(!empty($article['sortUrl'])): ?>
		<a href="https://nandyba.fr/backoffice/<?= $article['sortUrl']; ?>">Consulter cet article</a>
	<?php else: ?>
		<a href="https://nandyba.fr/backoffice/get/article/<?= $article['id']; ?>">Consulter cet article</a>
	<?php endif; ?>
	
	<div class="modal" id="mymodal">
		<div class="modal-content">
			<p>Ajouter des mots clés:</p>
			<input type="text" placeholder="word">
			<buton class="add">Ajouter</buton>
	    	<span class="close">&times;</span>
	    	
	  	</div>
	</div>
	<form method="post">
		<div>
			<label for="title">H1 : </label>
			<input type="text" name="title" id="title" value="<?= $article['title']?>">
			<div id="compteur-h1"></div><br>

			<label for="meta-title">Meta title : </label>
			<input type="text" name="meta-title" id="meta-title" value="<?= $article['metaTitle'] ?>">
			<div id="compteur-title"></div><br>

			<label for="meta-description">Meta description : </label><br>
			<textarea id="meta-description" name="meta-description"><?= $article['metaDescription'] ?></textarea><span id="counter"></span><br>

			<label for="meta-author">Meta author : </label>
			<input type="text" name="meta-author" id="meta-author" value="<?= $article['metaAuthor'] ?>">

			<label for="publish">Publier : </label>
			<select name="publish">
				<?php
				if($article['publish'] == 'true'): ?>
					<option value="true" selected>Oui</option>
					<option value="false">Non</option>
				<?php
				else: ?>
					<option value="true">Oui</option>
					<option value="false" selected>Non</option>
				<?php
				endif;
				?>
			</select><br>
		</div>
		<div id="markdown-article">
			<label for="result">Occurence des mots clés :</label><br>
			<div id="result"></div><br>
			<input name="words" id="words" type="text" value="<?= $article['words'] ?>" style="display: none;">
			<label for="markdown"> Article :</label><br>
			<textarea name="markdown" id="markdown"><?= $article['markdown'] ?></textarea>
			<div id="compteur-textarea"></div>
		</div>
		<div id="content"></div>
		<input type="text" name="id" value="<?= $article['id'] ?>">
		<textarea name="markdown-data" id="markdown-data"></textarea>
		<div>
			<input type="submit" value="Publier l'article">
		</div>
		
	</form>
<?php
$content = ob_get_clean();
$View = new DefaultControllerNew('Création d\' article', 'Backoffice | Créeation d\' article', true);
$View->removeCss();
$View->addcss(array('admininterface.css'));
$View->addjs(array('public/js/post-article.jquery.js','public/js/jquery.occurence.js'));
$View->render($content, 'article-edition');
?>