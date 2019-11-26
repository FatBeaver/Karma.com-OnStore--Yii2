<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'light_descr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_descr')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($model->getAllCategories()) ?>

    <hr/>
    <h2>Изображения: </h2>
    <div style="border:1px solid #aaa; border-radius:8px; padding:10px; background:#eee;">
    <?php if (isset($oldImages['main']) && $oldImages['main']): ?>
        <p style="font-size:20px; font-weight:bold;">Текущее главное изображение</p>
        <?= Html::img("/frontend/web/uploads/images/products/" . $oldImages['main'], [
                'alt' => $model->name,
                'style' => 'width:250px; margin-left:15px;',
            ]) ?>
    <?php endif; ?>
    <?= $form->field($fileModel, 'main_image')->fileInput(['accept' => 'image/*'])->label('Основное изображение')
    ->hint('Данное изображение будет являться главным (Лицевым) для данного товара.') ?>
    <hr/>

    <?php if (isset($oldImages['recommended']) && $oldImages['recommended'] ): ?>
        <p style="font-size:20px; font-weight:bold;">Текущее изображение для рекомендуемого товара</p>
        <?= Html::img("/frontend/web/uploads/images/products/" . $oldImages['recommended']['fileName'], [
                'alt' => $model->name,
                'style' => 'width:200px; margin-left:15px;',
            ]) ?>
    <?php endif; ?>
    <?= $form->field($fileModel, 'recomm_image')->fileInput(['accept' => 'image/*'])
    ->label('Изображение для рекоммендуемого товара')
    ->hint('Данное изображение будет отображенно в шапке сайта, на главной странице, 
    если товар будет выбран как "Рекоммендуемый".<br/> Рекомендуется добавить изображение БЕЗ ФОНА и 
    с пропорциями в которых ШИРИНА будет заметно БОЛЬШЕ ВЫСОТЫ
    для наиболее качественного отображения на сайте.') ?>
    <hr/>

    <?php if (isset($oldImages['additional']) && $oldImages['additional']): ?>
        <p style="font-size:20px; font-weight:bold;">Текущие дополнительные изображения</p>
        <?php foreach($oldImages['additional'] as $image): ?>
        <?= Html::img("/frontend/web/uploads/images/products/" . $image, [
                'alt' => $model->name,
                'style' => 'width:200px; margin-left:15px;',
            ]) ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?= $form->field($fileModel, 'images[]')->widget(\dosamigos\fileinput\BootstrapFileInput::className(), [
        'options' => ['accept' => 'image/*', 'multiple' => true],
        'clientOptions' => [
            'previewFileType' => 'text',
            'browseClass' => 'btn btn-success',
            'uploadClass' => 'btn btn-info',
            'removeClass' => 'btn btn-danger',
            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> '
        ]
    ])->label('Дополнительные изображения')
    ->hint('Для выбора нескольких файлов зажмите лев.Ctrl в проводнике файлов.') ?>
    </div>
    <hr/>

    <?= $form->field($model, 'price')->textInput() ?>

    <h2>Параметры товара</h2>
    <div style="border:1px solid #aaa; border-radius:8px; padding:10px; background:#eee;">

    <?= $form->field($paramModel, 'width')->textInput() ?>

    <?= $form->field($paramModel, 'height')->textInput() ?>

    <?= $form->field($paramModel, 'depth')->textInput() ?>

    <?= $form->field($paramModel, 'weight')->textInput() ?>

    <?= $form->field($paramModel, 'qual_check')->textInput() ?>

    <?= $form->field($paramModel, 'freshness')->textInput() ?>

    <?= $form->field($paramModel, 'packeting')->textInput() ?>

    <?= $form->field($paramModel, 'box_contains')->textInput() ?>

    </div>
    <hr/>
    <?= $form->field($model, 'availibility')->radioList([
        '1' => 'Да',
        '0' => 'Нет',
    ]) ?>

    <?= $form->field($model, 'recommended')->radioList([
        '1' => 'Да',
        '0' => 'Нет',
    ]) ?>

    <?= $form->field($model, 'sale')->radioList([
        '1' => 'Да',
        '0' => 'Нет',
    ]) ?>

    <?= $form->field($model, 'deals_week')->radioList([
        '1' => 'Да',
        '0' => 'Нет',
    ]) ?>

    <?= $form->field($model, 'exclusive')->radioList([
        '1' => 'Да',
        '0' => 'Нет',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Cохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
