<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

$form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'title'); ?>
	<?= $form->field($model, 'summary'); ?>
	<?= $form->field($model, 'content')->textarea()->widget(CKEDITOR::className(), ['preset' => 'full']) ?>

	<?= Html::submitButton('Submit', [
			'class' => 'btn btn-success',
		]); ?>

<?php ActiveForm::end(); ?>