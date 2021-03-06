<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $res_price
 * @property string $shipping
 * @property string $created_at
 * @property string $first_name
 * @property string $last_name
 * @property string $company
 * @property string $phone
 * @property string $email
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $first_addr
 * @property string $second_addr
 * @property int $status
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['res_price', 'shipping', 'first_name', 'last_name', 'phone', 'email', 'country', 'region', 'city', 'first_addr'], 'required'],
            [['created_at'], 'safe'],
            [['status'], 'integer'],
            [['res_price', 'shipping'], 'string', 'max' => 50],
            [['first_name', 'last_name', 'company', 'email', 'first_addr', 'second_addr'], 'string', 'max' => 255],
            [['phone', 'country'], 'string', 'max' => 100],
            [['region'], 'string', 'max' => 200],
            [['city'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'res_price' => 'Сумма',
            'shipping' => 'Доставка',
            'created_at' => 'Созданно',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'company' => 'Компания',
            'phone' => 'Телефон',
            'email' => 'Email',
            'country' => 'Страна',
            'region' => 'Регион',
            'city' => 'Город',
            'first_addr' => 'Первый адресс',
            'second_addr' => 'Второй адресс',
            'status' => 'Статус',
        ];
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'id']);
    }
}
