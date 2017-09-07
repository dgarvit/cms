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

    public function actionAdmin()
    {
    	$action = Yii::$app->request->get('action');

    	switch ($action) {
    		case 'logout':
    			return $this->actionLogout();
    			break;

    		case 'newArticle':
    			return $this->actionCreate();
    			break;

    		case 'editArticle':
    			return $this->actionEdit();
    			break;

    		case 'deleteArticle':
    			return $this->actionDelete();

    		default:
    			return $this->actionList();
    	}
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
        if($article->load(Yii::$app->request->post()) && $article->validate())
        	$article->update();

        return $this->actionList();
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