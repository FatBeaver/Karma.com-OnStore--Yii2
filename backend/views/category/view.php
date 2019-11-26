<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            [
                'attribute' => 'parent_id',
                'value' => function($model) 
                {
                    return $model->getCategoryName();
                }
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($model)
                {   
                    if (!$model->image) {
                        return  Html::img("/frontend/web/img/no-image.svg", [
                            'alt' => $model->name,
                            'style' => 'width:140px;',
                        ]);
                    }
                    return  Html::img("/frontend/web/uploads/images/categories/{$model->image}", [
                        'alt' => $model->name,
                        'style' => 'width:140px;',
                    ]);
                }
            ],
        ],
    ]) ?>

</div>
