<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\User;
use backend\models\BlogCategory;
/**
 * This is the model class for table "blog_post".
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property string $created_at
 * @property string $image
 * @property string $light_descr
 * @property string $content
 * @property int $viewed
 */
class BlogPost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['created_at', 'viewed'], 'safe'],
            [['content'], 'string'],
            [['name', 'image', 'light_descr'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'name' => 'Название',
            'user_id' => 'Автор',
            'created_at' => 'Созданно',
            'image' => 'Изображение',
            'light_descr' => 'Краткое описание',
            'content' => 'Cодержимое',
            'viewed' => 'Просмотры',
        ];
    }

    public function getCategoryListForForm()
    {   
        $categories = BlogCategory::find()->all();
        $listOfCategories = [];
        foreach ($categories as $category)
        {
            $listOfCategories[$category->id] = $category->name;
        }

        return $listOfCategories;
    }   

    public function getSelectedCategory()
    {
        $selectedCategory = [];
        foreach($this->categories as $category)
        {
            $selectedCategory[$category->id] = ['Selected' => true];
        }
        
        return $selectedCategory;
    }


    // ======================= LINKS ================================
    public function getCategories()
    {
        return $this->hasMany(BlogCategory::className(), ['id' => 'category_id'])
                    ->viaTable('blog_category_links', ['blog_id' => 'id']);
    }

    public function getAuthor() 
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
