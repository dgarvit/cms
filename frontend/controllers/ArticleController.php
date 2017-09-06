<?php
namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Articles;
use Yii;

class ArticleController extends Controller
{
	public function actionIndex()
	{
		$action = Yii::$app->request->get('action');

		switch ($action)
		{
			case 'archive':
				return $this->actionArchive();
				break;

			case 'viewArticle':
				return $this->actionArticle();
				break;

			default:
				return $this->actionHomepage();
		}
	}

	public function actionHomepage()
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