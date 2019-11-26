<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\InputFile;
use mihaildev\elfinder\ElFinder;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['options' => [
        'enctype' => 'multipart/form-data'
    ]]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($categories) ?>

    <?php if($model->image):?> 
    <?= Html::img("/frontend/web/uploads/images/categories/{$model->image}", [
            'alt' => $model->name,
            'style' => 'width:200px;',
        ]); ?>
    <?php else: ?>
    <?= Html::img("/frontend/web/img/no-image.svg", [
            'alt' => $model->name,
            'style' => 'width:140px;',
        ]); ?>
    <?php endif; ?>

    <?= $form->field($fileModel, 'image')->fileInput()->label('Изменить изображение') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
