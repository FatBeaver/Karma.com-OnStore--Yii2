<?php

namespace frontend\models;

use Yii;
use frontend\models\BlogCategory;
use common\models\User;

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
            [['user_id', 'viewed'], 'integer'],
            [['created_at'], 'safe'],
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
            'id' => 'ID',
            'name' => 'Name',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'image' => 'Image',
            'light_descr' => 'Light Descr',
            'content' => 'Content',
            'viewed' => 'Viewed',
        ];
    }

    public function getCommentsCount()
    {      
        (string) $count = count($this->comments);
        $val = substr($count, -1);

        if ($val == 1) {
            $last = 'й';
        } elseif ($val >= 2 && $val <= 4) {
            $last = 'я';
        } elseif ($val >= 5 && $val <= 9 || $val == 0) {
            $last = 'ев';
        }
       
        return $count . " Комментари$last"; 
    }

    // ========================== LINKS ======================
    public function getComments()
    {
        return $this->hasMany(BlogComment::className(), ['blog_id' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(BlogCategory::className(), ['id' => 'category_id'])
                ->viaTable('blog_category_links', ['blog_id' => 'id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCommentsForPage($limit, $offset)
    {
        return $this->hasMany(BlogComment::className(), ['blog_id' => 'id'])
            ->limit($limit)->offset($offset)->orderBy(['id' => SORT_DESC])->all();
    }
}
