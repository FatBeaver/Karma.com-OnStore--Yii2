<?php

namespace frontend\models;

use Yii;
use common\models\Country;
use common\models\City;
use common\models\Region;

/**
 * This is the model class for table "user_data".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $company
 * @property string $number_phone
 * @property string $country_id
 * @property string $region_id
 * @property string $first_address
 * @property string $second_address
 * @property string $sity_id
 * @property string $image
 */
class UserData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_data';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'company' => 'Company',
            'number_phone' => 'Number Phone',
            'country_id' => 'Country',
            'region_id' => 'Region',
            'first_address' => 'First Address',
            'second_address' => 'Second Address',
            'city_id' => 'city',
            'image' => 'Image',
        ];
    }

    // ============================== LINKS ======================
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}
