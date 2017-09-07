<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

if (Yii::$app->session->hasFlash('error')) { ?>
	<div class="alert">
		<?= Yii::$app->session->getFlash('error') ?>
  	</div>
<?php }else {
	$form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
		<?= $form->field($model, 'title'); ?>
		<?= $form->field($model, 'summary'); ?>
		<?= $form->field($model, 'content')->textarea()->widget(CKEDITOR::className(), ['preset' => 'full']) ?>

		<?= Html::submitButton('Save', ['class' => 'btn btn-success']); ?>
	<?php ActiveForm::end(); }?>