<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
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
            'name',
            'light_descr',
            'full_descr',
            [
                'attribute' => 'images',
                'format' => 'html',
                'value' => function($model) {
                    if (!$model->images) { 
                        return  Html::img("/frontend/web/img/no-image.svg", [
                            'alt' => $model->name,
                            'style' => 'width:250px;',
                        ]);   
                    }
                    $images = unserialize($model->images);
                    // print_r($model->images);exit;
                    $viewImg = '';
                    if (isset($images['main'])) {
                        $main_img = $images['main'];
                        $viewImg .= Html::img("/frontend/web/uploads/images/products/{$main_img}", [
                                'alt' => $model->name,
                                'style' => 'width:250px; margin-left:15px;',
                            ]);
                    }
                    if (isset($images['additional'])) {
                        foreach ($images['additional'] as $image) {
                            $viewImg .= Html::img("/frontend/web/uploads/images/products/{$image}", [
                                'alt' => $model->name,
                                'style' => 'width:150px; margin-left:15px;',
                            ]);
                        }
                    }
                    return $viewImg;
                }
            ],
            'price',
            [
                'attribute' => 'availibility',
                'value' => function($model) {
                    return ($model->availibility == 1) ? 'В наличии' : 'Нет';
                }
            ],
            [
                'attribute' => 'category_id',
                'value' => function($model) {
                    return $model->category->name;
                }
            ],
            [
                'attribute' => 'parametrs_id',
                'format' => 'html',
                'value' => function($model) {
                    return $model->getViewParams();
                }
            ],
            [
                'attribute' => 'stars',
                'value' => function($model) {
                    if (!$model->stars) {
                        return 'Покачто не оцененно';
                    }
                    return $model->stars;
                }
            ],
            [
                'attribute' => 'recommended',
                'value' => function($model) {
                    return ($model->recommended == 1) ? 'Да' : "Нет";
                }
            ],
            [
                'attribute' => 'sale',
                'value' => function($model) {
                    return ($model->sale == 1) ? 'Да' : "Нет";
                }
            ],
            [
                'attribute' => 'deals_week',
                'value' => function($model) {
                    return ($model->deals_week == 1) ? 'Да' : "Нет";
                }
            ],
            [
                'attribute' => 'exclusive',
                'value' => function($model) {
                    return ($model->exclusive == 1) ? 'Да' : "Нет";
                }
            ],
        ],
    ]) ?>

</div>
