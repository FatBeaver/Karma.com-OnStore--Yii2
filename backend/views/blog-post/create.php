<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BlogPost */

$this->title = 'Добавление поста';
$this->params['breadcrumbs'][] = ['label' => 'Посты блога', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'imageModel' => $imageModel,
        'blog_category' => $blog_category,
    ]) ?>

</div>
