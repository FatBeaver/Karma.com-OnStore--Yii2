<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "prod_rating".
 *
 * @property int $id
 * @property int $stars
 * @property int $product_id
 * @property int $user_id
 */
class ProductRating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prod_rating';
    }

}
