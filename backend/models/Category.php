<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property string $image
 */
class Category extends \yii\db\ActiveRecord
{
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['parent_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'name' => 'Имя',
            'parent_id' => 'Родительская категория',
            'image' => 'Изображение',
        ];
    }

    public static function getCategoryNames($id = 0)
    {   
        $models = self::find()->where(['parent_id' => 0])->all();
        $categories = [];
        $i = 0;
        if ((self::checkChildCategory($id))) {
            $parent[0] = 'Данная категория уже является родительской';
            return $parent;
        }

        foreach ($models as $category)
        {      
            if ($i === 0) $categories[$i] = 'Самостоятельная категория';
            if ($category->id == $id) continue;
            $categories[$category->id] = '- ' . $category->name;
            $i++;
        }
        return $categories;
    }

    protected static function checkChildCategory($category_id)
    {   
        $parent_IDs = self::find()->asArray()->all();
        $parent_IDs = array_column($parent_IDs, 'parent_id');
        if (in_array($category_id, $parent_IDs)) return true;
    }

    public function getCategory() 
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    public function getCategoryName()
    {
        $category = $this->category;
        return $category ? $category->name : 'Самостоятельная категория';
    }
}
