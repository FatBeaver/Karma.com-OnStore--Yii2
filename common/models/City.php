<?php

namespace common\models;

use Yii;
use common\models\Country;
use common\models\Region;

/**
 * This is the model class for table "city".
 *
 * @property int $id_city
 * @property int $id_region
 * @property int $id_country
 * @property string $name
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_region', 'id_country'], 'required'],
            [['id_region', 'id_country'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_city' => 'Id City',
            'id_region' => 'Id Region',
            'id_country' => 'Id Country',
            'name' => 'Name',
        ];
    }

    // ==================== LINKS ========================
    public function getCountry()
    {
        return $this->nasOne(Country::className(), ['id_country' => 'id_country']);
    }

    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id_region' => 'id_region']);
    }
}
