<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property string $reviews
 * @property int $user_id
 * @property int $product_id
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reviews' => 'Reviews',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
