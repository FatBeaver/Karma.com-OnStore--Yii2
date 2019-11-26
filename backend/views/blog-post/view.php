<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BlogPost */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Посты блога', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="blog-post-view">

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
            'name',   
            'created_at',
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
                    return  Html::img("/frontend/web/uploads/images/blog/{$model->image}", [
                        'alt' => $model->name,
                        'style' => 'width:500px;',
                    ]);
                }
            ],
            'light_descr',
            [
                'attribute' => 'content',
                'format' => 'html',
            ], 
            'viewed',
        ],
    ]) ?>

</div>
