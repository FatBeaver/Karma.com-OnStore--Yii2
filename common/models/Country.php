<?php

namespace common\models;

use Yii;
use common\models\City;
use common\models\Region;

/**
 * This is the model class for table "country".
 *
 * @property int $id_country
 * @property string $name
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_country' => 'Id Country',
            'name' => 'Name',
        ];
    }

    // ======================== LINKS ========================
    public function getRegions()
    {
        return $this->hasMany(Region::className(), ['id_country' => 'id_country']);
    }

    public function getCities()
    {
        return $this->hasMany(City::className(), ['id_country' => 'id_country']);
    }
}
