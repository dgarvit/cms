<?php
namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Articles;
use Yii;

class ArticleController extends Controller
{
	public function actionIndex()
	{
		$articles = Articles::find()->all();
		return $this->render('index', [
				'articles' => $articles,
			]);
	}

	public function actionCreate()
	{
		$model = new Articles();
		if($model->load(Yii::$app->request->post()) && $model->validate())
		{
			$model->save();
			return $this->actionIndex();
		}

		return $this->render('create', [
				'model' => $model,
			]);
	}
}