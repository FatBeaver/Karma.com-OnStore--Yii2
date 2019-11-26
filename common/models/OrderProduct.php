<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_products".
 *
 * @property int $id
 * @property int $order_id
 * @property string $image
 * @property string $name
 * @property string $price
 * @property int $qty
 * @property string $total_price
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'qty'], 'integer'],
            [['image', 'name'], 'string', 'max' => 255],
            [['price', 'total_price'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'image' => 'Image',
            'name' => 'Name',
            'price' => 'Price',
            'qty' => 'Qty',
            'total_price' => 'Total Price',
        ];
    }

    public static function saveOrderItems()
    {
        $order_id = Yii::$app->db->getLastInsertId();

        $products = [];
        foreach ($_SESSION['cart'] as $id => $product)
        {   
            $products[$id][] = $order_id;
            $products[$id][] = $product['image'];
            $products[$id][] = $product['name'];
            $products[$id][] = $product['price'];
            $products[$id][] = $product['qty'];
            $products[$id][] = $product['sum'];
        }
       // print_r($products);exit;
        Yii::$app->db->createCommand()->batchInsert(
            OrderProduct::tableName(), 
            ['order_id', 'image', 'name', 'price', 'qty', 'total_price'], 
            $products
        )->execute();
        
        return $order_id;
    }
}
