<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $image
 */
class Category extends \yii\db\ActiveRecord
{   
    public $childs;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'image' => 'Image',
        ];
    }

    public function getRecommendedCategory()
    {
        return self::find()->where(['recommended' => 1])->limit(4)->orderBy(['id' => SORT_ASC])->all();
    }

    public function getAllCategories()
    {
        return self::find()->with('products')->orderBy(['id' => SORT_ASC])->all();
    }

    // ================================= LINKS =======================================
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }
}
