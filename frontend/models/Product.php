<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $light_descr
 * @property string $full_descr
 * @property string $images
 * @property double $price
 * @property int $availibility
 * @property int $category_id
 * @property int $parametrs_id
 * @property double $stars
 * @property int $recommended
 * @property int $sale
 * @property int $deals_week
 * @property int $exclusive
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['full_descr', 'images'], 'string'],
            [['price', 'stars'], 'number'],
            [['availibility', 'category_id', 'parametrs_id', 'recommended', 'sale', 'deals_week', 'exclusive'], 'integer'],
            [['name', 'light_descr'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'light_descr' => 'Light Descr',
            'full_descr' => 'Full Descr',
            'images' => 'Images',
            'price' => 'Price',
            'availibility' => 'Availibility',
            'category_id' => 'Category ID',
            'parametrs_id' => 'Parametrs ID',
            'stars' => 'Stars',
            'recommended' => 'Recommended',
            'sale' => 'Sale',
            'deals_week' => 'Deals Week',
            'exclusive' => 'Exclusive',
        ];
    }

    /**
     * @return array 
     * 
     * Метод получения всех товаров из всех категорий с "жадной" загрузкой. 
     * Сортировка по полю ID в порядке убывания.
     */
    public function getAllProducts()
    {
        return self::find()->with('category')->orderBy(['id' => SORT_DESC])->all();
    }

    /**
     * @return array
     * 
     * Метод получения рекоммендуемых товаров с "жадной" загрузкой.
     * Сортировка по полю ID в порядке убывания.
     */
    public function getRecommendedProducts()
    {
        return self::find()->with('category')->where(['recommended' => 1])
        ->orderBy(['id' => SORT_DESC])->all();
    }

    /**
     * @return array 
     * 
     * Метод получения новых товаров (добавленных в текущем месяце), с жадной загрузкой.
     * Сортировка по полю ID в порядке убывания.
     * Лимит получаемых товаров - 8.
     */
    public function getLatestProducts()
    {
        return self::find()->with('category')->where(['latest' => 1])->limit(8)
        ->orderBy(['id' => SORT_DESC])->all();
    }

    /**
     * @return array 
     * 
     * Метод получения давних товаров (добавленных в прошлом и более ранних месяцах), с жадной загрузкой.
     * Сортировка по полю ID в порядке убывания.
     * Лимит получаемых товаров - 8.
     */
    public function getCommingProducts()
    {
        return self::find()->with('category')->where(['latest' => 0])->limit(8)
        ->orderBy(['id' => SORT_DESC])->all();
    }

    /**
     * @return array 
     * 
     * Метод получения эксклюзивных товаров, с жадной загрузкой.
     * Сортировка по полю ID в порядке убывания.
     */
    public function getExclusiveProducts()
    {
        return self::find()->with('category')->where(['exclusive' => 1])
        ->orderBy(['id' =>SORT_DESC])->all();
    }

    /**
     * @return array 
     * 
     * Метод получения топовых товаров недели, с жадной загрузкой.
     * Сортировка по полю ID в порядке убывания.
     * Лимит получаемых товаров - 8.
     */
    public function getDealsWeekProducts()
    {
        $sql = 'SELECT * FROM product WHERE stars > 3 AND deals_week = 1 LIMIT 9';
        return self::findBySql($sql)->with('category')->orderBy(['id' => SORT_DESC])->all();
    }

    /**
     * @return array
     * 
     * Метод получения товаров для конкретной странницы общей категории.
     * Данный метод работает в паре с самописной пагинацией.
     * Сортировка по умолчанию по полю ID в порядке убывания.
     */
    public function getProductsForPage($limit = 6, $offset, $order = 'id', $order_price = null)
    {   
        if ($order_price == null) {
            return self::find()->limit($limit)->offset($offset)->orderBy([$order => SORT_DESC])->all();
        }

        return self::find()->where(['between', 'price', $order_price[0], $order_price[1]])
            ->limit($limit)
            ->offset($offset)
            ->orderBy([$order => SORT_DESC])
            ->all();
    }

    /**
     * @return array
     * 
     * Метод получения товаров для конкретной странницы определенной категории.
     * Данный метод работает в паре с самописной пагинацией.
     * Сортировка по умолчанию по полю ID в порядке убывания.
     */
    public function getProductsForPageByCategory($limit = 6, $offset, $id, $order_id = 'id', $order_price = null) 
    {
        if ($order_price == null) {
            return self::find()->where(['category_id' => $id])->limit($limit)->offset($offset)
                ->orderBy([$order_id => SORT_DESC])->all();
        }
        
        return self::find()->where(['category_id' => $id])
            ->andWhere(['between', 'price' , $order_price[0], $order_price[1]])
            ->limit($limit)
            ->offset($offset)
            ->orderBy([$order_id => SORT_DESC])
            ->all();   
    }


    // =============================== LINKS ==========================================
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getParametrs()
    {
        return $this->hasOne(ProductParametrs::className(), ['id' => 'parametrs_id']);
    }

    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['product_id' => 'id']);
    }
}
