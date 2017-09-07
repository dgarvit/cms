<?php

use yii\helpers\Html;

?>

<h1>All Articles</h1>

<table>
	<tr>
		<th>Publication Date</th>
		<th>Article</th>
	</tr>
	<?php foreach ($articles as $article) { ?>
		<tr onclick="location='/edit&amp;articleId=<?= $article->id ?>'">
			<td><?=date('d-m-Y', strtotime($article->publicationDate)); ?></td>
			<td><?= Html::encode($article->title) ?></td>
		</tr>
	<?php } ?>
</table>
<br>
<p>
	<?= $total ?> article<?php echo ($total!=1)?'s':''?> in total.
</p>