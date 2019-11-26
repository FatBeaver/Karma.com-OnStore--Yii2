<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Посты блога';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить пост', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return ucfirst($data->author->data->first_name) . ' ' . 
                    ucfirst($data->author->data->last_name);
                }
            ],
            'created_at',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data) {
                    if (isset($data->image)) {
                        return Html::img("/frontend/web/uploads/images/blog/" . $data->image, [
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
            'light_descr',
            //'content:ntext',
            'viewed',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
