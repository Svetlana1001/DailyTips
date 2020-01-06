<?php

namespace app\modules\admin\controllers;


use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use app\models\Category;
use app\models\Tag;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ImageUpload;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()//модель принимает все записи с формы и принимает сохранение
    {
        $model = new Article();
        //Yii::$app->request->post() возвращаем то, что ввели в форму при создании статьи
        //$model->load(Yii::$app->request->post() загрузка всех свойств таблицы аrticle  БД
        if ($model->load(Yii::$app->request->post()) && $model->saveArticle()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->saveArticle()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetImage($id)
    {
        $model = new ImageUpload; //создается экземпляр модели по загрузке картинок

    if (Yii::$app->request->isPost) //если в екшен поступил запрос пост (толькокогда нажата кнопка) тогда загружаем и сохраняем картинку
    {
        $article = $this->findModel($id);
        $file = UploadedFile::getInstance($model, 'image');

        if ($article->saveArticleImage($model->uploadFile($file, $article->image)))
        {
            return $this->redirect(['view', 'id'=>$article->id]);

        }
    }
        return $this->render('image',['model'=>$model]);//кнопка не нажата/ создается вид для форми
            }

    public function actionSetCategory($id)
    {
        $article = $this->findModel($id);//цепляем статью нужную
        //Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
       // return $article->category->title;
        
        $selectedCategory = $article->category->id;//готовиться значение для формы
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');//текущий id

        if(Yii::$app->request->isPost)
        {
            $category = Yii::$app->request->post('category');//ловим дропдаун по названию 'category'
            if ($article->saveArticleCategory($category))
            {
                return $this->redirect(['view', 'id'=>$article->id]);
            }
        }
        
        return $this->render('category', [
            'article'=>$article,
            'selectedCategory' => $selectedCategory,
            'categories' => $categories
        ]);
    }

    public function actionSetTags($id)
    {
        $article = $this->findModel($id);
        $selectedTags = $article->getSelectedTags();//бращение к статье получить метод (есть список всех тегов)
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');

//если в форму отправили то в переменную тегс кладем все значения из инпутатегс
        if (Yii::$app->request->isPost)
        {
            $tags = Yii::$app->request->post('tags');
            $article->saveArticleTags($tags);//сохраняем теги и 
            return $this->redirect(['view', 'id'=>$article->id]);//перенаправляем пользователя на станицу view
        }

        //возвращаем модель и придаем ей виду
        return $this->render('tags', [
           'selectedTags'=>$selectedTags,
           'tags' => $tags
        ]);
    }
}
                        