<?php

use yii\helpers\Html;

?>

<ul>
<?php foreach ($articles as $article): ?>
	<h4>
		<li>
			<?= $article->publicationDate; ?>
			<a href='.?action=viewArticle&amp;articleId=<?= $article->id; ?>'><?= Html::encode($article->title) ?></a>
		</li>
	</h4>
	<p>
		<?= Html::encode($article->summary); ?>
	</p>
<?php endforeach ?>
</ul>