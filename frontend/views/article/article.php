<?php

use yii\helpers\Html;
$this->title = $article->title;

?>

<h1 style="width: 75%;"><?= Html::encode($article->title) ?></h1>
<div style="width: 75%; font-style: italic;"><?= Html::encode($article->summary) ?></div>
<div style="width: 75%;"><?= $article->content ?></div>
<p>Published on <?= $date ?></p>

<p><a href="./">Return to Homepage</a></p>