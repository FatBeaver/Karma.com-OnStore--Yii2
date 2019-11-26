<?php

namespace backend\models;

use Yii;
use backend\models\ProductParametrs;

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
 * @property string $brand
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
            [['full_descr'], 'string'],
            [['price', 'stars'], 'number'],
            [['availibility', 'category_id', 'parametrs_id', 'recommended', 'sale', 'deals_week', 'exclusive'], 'integer'],
            [['name', 'light_descr', ], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Товара',
            'name' => 'Имя',
            'light_descr' => 'Краткое описание',
            'full_descr' => 'Описание',
            'images' => 'Изображение',
            'price' => 'Цена',
            'availibility' => 'Наличие',
            'category_id' => 'Категория',
            'parametrs_id' => 'Параметры товара',
            'stars' => 'Оценка',
            'recommended' => 'Рекомендуемый',
            'sale' => 'Распродажа',
            'deals_week' => 'Товар недели?',
            'exclusive' => 'Эксклюзив',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getParametrs()
    {
        return $this->hasOne(ProductParametrs::className(), ['id' => 'parametrs_id']);
    }

    public function getAllCategories()
    {
        $categories = Category::find()->all();
        $catForList = [];
        foreach($categories as $category) {
            $catForList[$category->id] = $category->name;
        }
        return $catForList;
    }

    public function getViewParams()
    {
        $parametrs =  ProductParametrs::findOne(['id' => $this->parametrs_id]);
        $view = '<div style="display:flex; 
            flex-direction:column; border:1px solid #ccc;   
            padding:15px; border-radius:8px;">';
        $view .= '<p style="margin-bottom:7px;"><span style="font-size:20px;">Ширина: </span>' . $parametrs->width .'</p>';
        $view .= '<p style="margin-bottom:7px;"><span style="font-size:20px;">Высота: </span>' . $parametrs->height .'</p>';
        $view .= '<p style="margin-bottom:7px;"><span style="font-size:20px;">Глубина: </span>' . $parametrs->depth .'</p>';
        $view .= '<p style="margin-bottom:7px;"><span style="font-size:20px;">Масса: </span>' . $parametrs->weight .'</p>';
        $view .= '<p style="margin-bottom:7px;"><span style="font-size:20px;">Проверка при упаковке: </span>' . $parametrs->qual_check .'</p>';
        $view .= '<p style="margin-bottom:7px;"><span style="font-size:20px;">Гарантия: </span>' . $parametrs->freshness .'</p>';
        $view .= '<p style="margin-bottom:7px;"><span style="font-size:20px;">При упаковке: </span>' . $parametrs->packeting .'</p>';
        $view .= '<p style="margin-bottom:7px;"><span style="font-size:20px;">Размер коробки: </span>' . $parametrs->box_contains .'</p>';
        $view .= '</div>';

        return $view;
    }
}
