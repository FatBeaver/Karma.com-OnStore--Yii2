<?php

namespace common\models;

use Yii;
use common\models\Country;
use common\models\City;

/**
 * This is the model class for table "region".
 *
 * @property int $id_region
 * @property int $id_country
 * @property string $name
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_country'], 'required'],
            [['id_country'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_region' => 'Id Region',
            'id_country' => 'Id Country',
            'name' => 'Name',
        ];
    }

    // ======================== LINKS ========================
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id_country' => 'id_country']);
    }

    public function getCities()
    {
        return $this->hasMany(City::className(), ['id_region' => 'id_region']);
    }
}
