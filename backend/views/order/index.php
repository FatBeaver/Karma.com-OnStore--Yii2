<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'res_price',
            'shipping',
            'created_at',
            'first_name',
            //'last_name',
            //'company',
            'phone',
            'email:email',
            //'country',
            //'region',
            //'city',
            //'first_addr',
            //'second_addr',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($data) {
                    if ($data->status == 1) {
                        return '<p class="text-success">Оплаченно</p>';
                    }
                    return '<p class="text-danger">Не оплаченно</p>';
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>


</div>
