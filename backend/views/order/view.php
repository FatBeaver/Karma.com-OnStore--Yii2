<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = 'ID Заказа: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Удалить заказ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'res_price',
            'shipping',
            'created_at',
            'first_name',
            'last_name',
            'company',
            'phone',
            'email:email',
            'country',
            'region',
            'city',
            'first_addr',
            'second_addr',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($model) {
                    if ($model->status == 1) {
                        return '<p class="text-success">Оплаченно</p>';
                    }
                    return '<p class="text-danger">Не оплаченно</p>';
                }
            ],
        ],
    ]) ?>

    <div class="container">
        <div class="order-items" style="border:1px solid #aaa; border-radius:10px;">
            <table class="table">
                <thead>
                    <tr>
                        <td>Изображение</td>
                        <td>Название</td>
                        <td>Цена</td>
                        <td>Кол-во</td>
                        <td>Сумма</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($model->orderItems as $item): ?>
                        <tr>
                            <td>
                                <?=Html::img('/frontend/web/uploads/images/products/main/'.
                                $item->image, [
                                    'alt' => $item->name,
                                    'style' => 'width:100px;',
                                ])?>
                            </td>
                            <td style="font-size:22px; padding-top:40px;"><?=$item->name?></td>
                            <td style="font-size:22px; padding-top:40px;"><?=$item->price?></td>
                            <td style="font-size:22px; padding-top:40px;"><?=$item->qty?></td>
                            <td style="font-size:22px; padding-top:40px;"><?=$item->total_price?> RUB</td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

</div>
