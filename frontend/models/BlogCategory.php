<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "blog_category".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $description
 */
class BlogCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'image', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'description' => 'Description',
        ];
    }

    public function getPosts()
    {
        return $this->hasMany(BlogPost::className(), ['id' => 'blog_id'])
                    ->viaTable('blog_category_links', ['category_id' => 'id']);
    }

    public function getCountPosts()
    {
        return count($this->posts);
    }

    public function getPaginationPostsForCategory($offset, $limit)
    {
        return $this->hasMany(BlogPost::className(), ['id' => 'blog_id'])
                ->viaTable('blog_category_links', ['category_id' => 'id'])
                ->limit($limit)
                ->offset($offset)
                ->all();
    }
}
