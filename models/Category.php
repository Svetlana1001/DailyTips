<?php

namespace app\models;

use Yii;
use app\models\Article;
use yii\data\Pagination;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $title
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    public function getArticlesCount()
    {
        return $this->getArticles()->count();
    }

    public static function getAll()
    {
        return Category::find()->all();
    }

    public static function getArticlesByCategory($id)
    {
        //создание запроса
        $query = Article::find()->where(['category_id'=>$id]);
        //берем общее количество статтей
    $count = $query->count();
    //количество передается в клас пагинации. Получаем обьект пагинации с общим количеством статтей
    $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 6]);
    //лимитируем запрос используя пагинацию и выводим все статьи
    $articles = $query->offset($pagination->offset)//отодвигает на какоето количество статтей назад и берет следующее количество статтей(которое необходимо)
        ->limit($pagination->limit)//выбрать определенное количество записей с базы
        ->all();
    $data['articles'] = $articles;
    $data['pagination'] = $pagination;
    return $data;
    }
}
