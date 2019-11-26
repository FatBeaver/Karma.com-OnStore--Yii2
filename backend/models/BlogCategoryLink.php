<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "blog_category_links".
 *
 * @property int $id
 * @property int $blog_id
 * @property int $category_id
 */
class BlogCategoryLink extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_category_links';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blog_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blog_id' => 'Blog ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return void
     * 
     * Метод сохранения связей Многие ко Многим для Постов блога и Категорий блога;
     */
    public function saveManyToManyLinks($blogID = null)
    {   
        if ($blogID == null) {
            $blogID = Yii::$app->db->getLastInsertID();
        }
        
        $categories = Yii::$app->request->post('BlogCategoryLink');

        $linkData = [];
        foreach ($categories['category_id'] as $key => $category) 
        {
            $linkData[$key][] = $blogID;
            $linkData[$key][] = $category; 
        }
        Yii::$app->db->createCommand()->batchInsert(
            BlogCategoryLink::tableName(), 
            ['blog_id', 'category_id'], 
            $linkData
        )->execute();
    }

    public function deleteLinksBy($blogID)
    {
        $links = BlogCategoryLink::find()->where(['blog_id' => $blogID])->all();
        foreach($links as $link)
        {
            $link->delete();
        }
    }
}
