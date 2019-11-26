<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "blog_category_links".
 *
 * @property int $id
 * @property int $blog_id
 * @property int $category_id
 */
class BlogCategoryLinks extends \yii\db\ActiveRecord
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
}
