<?php
namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Articles;
use common\models\LoginForm;
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
		if (Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }

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

	public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->actionList();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->actionList();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->actionIndex();
    }

    public function actionList()
    {
    	if (Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }

        $articles = Articles::find()->all();
        return $this->render('list',[
        		'articles' => $articles,
        		'total' => count($articles),
        	]);
    }

    public function actionEdit()
    {
    	if (Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }

        $model = new Articles();
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
     		//$model does not have id
        	$model->update();
        	return $this->actionList();
    	}

    	else {
    		$articleId = Yii::$app->request->get('articleId');
    		$model = Articles::find()->where(['id' => $articleId])->one();
    		if (!$model)
    			Yii::$app->session->setFlash('error', "Article ID does not exist.");
    		return $this->render('edit', [
    			'model' => $model,
    		]);
    	}
    }

    public function actionDelete()
    {
    	if (Yii::$app->user->isGuest) {
    		return $this->actionLogin();
    	}

    	$articleId = Yii::$app->request->get('articleId');
    	$article = Articles::find()->where(['id' => $articleId])->one();
    	if ($article)
    		$article->delete();

    	return $this->actionList();

    }
}