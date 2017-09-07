<?php
namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Articles;
use yii\db\Query;
use Yii;

class ArticleController extends Controller
{
	public function actionIndex()
	{
		$action = Yii::$app->request->get('action');

		switch ($action)
		{
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

	public function actionArticle()
	{
		$articleId = Yii::$app->request->get('articleId');
		$article = Articles::find()->where(['id' => $articleId])->one();
		$timestamp = strtotime($article->publicationDate);
		$date = date('d-m-Y', $timestamp);
		return $this->render('article', [
				'article' => $article,
				'date' => $date,
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