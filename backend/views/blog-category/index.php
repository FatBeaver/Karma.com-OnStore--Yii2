<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории блога';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) {
                    if (isset($data->image) && ($data->image != null)) {
                        return Html::img("/frontend/web/uploads/images/blog_category/" . $data->image, [
                            'alt' => $data->name,
                            'style' => 'width:130px; margin-left:0px;',
                        ]);
                    } else {
                        return  Html::img("/frontend/web/img/no-image.svg", [
                            'alt' => $data->name,
                            'style' => 'width:130px;',
                        ]);   
                    }
                }
            ],
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
