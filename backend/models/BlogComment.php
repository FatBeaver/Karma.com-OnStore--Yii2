<?php

namespace backend\models;

use Yii;
use common\models\User;
use backend\models\BlogPost;
/**
 * This is the model class for table "blog_comment".
 *
 * @property int $id
 * @property string $text
 * @property int $user_id
 * @property string $created_at
 * @property int $blog_id
 */
class BlogComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['user_id', 'blog_id'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст',
            'user_id' => 'Автор',
            'created_at' => 'Созданно',
            'blog_id' => 'Пост',
        ];
    }

    public function getStringOfStatus()
    {
        if ($this->status == 0) {
            return 'Доступный';
        } else {
            return 'Запрещённый';
        }
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getPost()
    {
        return $this->hasOne(BlogPost::className(), ['id' => 'blog_id']);
    }
}
