<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'title'); ?>
	<?= $form->field($model, 'summary'); ?>
	<?= $form->field($model, 'content'); ?>

	<?= Html::submitButton('Submit', [
			'class' => 'btn btn-success',
		]); ?>

<?php ActiveForm::end(); ?>