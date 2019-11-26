<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            //'light_descr',
            //'full_descr',
            [
                'attribute' => 'images',
                'format' => 'html',
                'value' => function($data) {
                    $images = unserialize($data->images);
                    if (isset($images['main'])) {
                        return Html::img("/frontend/web/uploads/images/products/" . $images['main'], [
                            'alt' => $data->name,
                            'style' => 'width:140px; margin-left:10px;',
                        ]);
                    } else {
                        return  Html::img("/frontend/web/img/no-image.svg", [
                            'alt' => $data->name,
                            'style' => 'width:130px;',
                        ]);   
                    }
                }
            ],
            [
                'attribute' => 'price',
                'value' => function($data) {
                    return ($data->price) ? $data->price : 'Не установленно';
                }
            ],
            [
                'attribute' => 'availibility',
                'value' => function($data) {
                    return ($data->availibility == 1) ? 'Есть' : "Нет";
                }
            ],
            [
                'attribute' => 'category_id',
                'value' => function($data) {
                    return $data->category->name;
                }
            ],
            //'parametrs_id',
            //'stars',
            //'recommended',
            //'sale',
            //'deals_week',
            //'exclusive',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
