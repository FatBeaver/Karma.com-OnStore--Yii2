<?php

namespace frontend\models;

use Yii;
use common\models\User;
/**
 * This is the model class for table "blog_comment".
 *
 * @property int $id
 * @property string $text
 * @property int $user_id
 * @property string $created_at
 * @property int $blog_id
 * @property int $status
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
            [['user_id', 'blog_id', 'status'], 'integer'],
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
            'text' => 'Text',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'blog_id' => 'Blog ID',
            'status' => 'Status',
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
