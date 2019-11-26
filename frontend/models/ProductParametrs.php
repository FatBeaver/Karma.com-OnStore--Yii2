<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "prod_parametrs".
 *
 * @property int $id
 * @property string $width
 * @property string $height
 * @property string $depth
 * @property string $weight
 * @property string $qual_check
 * @property string $freshness
 * @property string $packeting
 * @property string $box_contains
 */
class ProductParametrs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prod_parametrs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['width', 'height', 'depth', 'weight', 'qual_check', 'freshness', 'packeting', 'box_contains'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'width' => 'Width',
            'height' => 'Height',
            'depth' => 'Depth',
            'weight' => 'Weight',
            'qual_check' => 'Qual Check',
            'freshness' => 'Freshness',
            'packeting' => 'Packeting',
            'box_contains' => 'Box Contains',
        ];
    }
}
