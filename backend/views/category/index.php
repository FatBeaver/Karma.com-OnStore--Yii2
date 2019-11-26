<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            [
                'attribute' => 'parent_id',
                'value' => function($data) 
                {
                    return $data->getCategoryName();
                }
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data)
                {   
                    if (!$data->image) {
                        return  Html::img("/frontend/web/img/no-image.svg", [
                            'alt' => $data->name,
                            'style' => 'width:100px;',
                        ]);
                    }
                    return  Html::img("/frontend/web/uploads/images/categories/{$data->image}", [
                        'alt' => $data->name,
                        'style' => 'width:100px;',
                    ]);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
