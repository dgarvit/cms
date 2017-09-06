<?php

use yii\helpers\Html;

?>
<?php foreach ($articles as $article): ?>
	<li>
		<?= Html::encode($article->content) ?>
	</li>
<?php endforeach ?>