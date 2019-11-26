<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии к постам';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-comment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!empty($comments)): ?>

    <table class="table">
        <thead>
            <tr>
                <td>#</td>
                <td>Автор</td>
                <td>Содержание</td>
                <td>Статус</td>
                <td>Пост</td>
                <td>Действие</td>
            </tr>
        </thead>

        <tbody>
            <?php foreach($comments as $comment): ?>
                <tr id="<?=$comment->id?>" class="comment-row">
                    <td><?=$comment->id?></td>
                    <td><?=$comment->author->data->first_name?></td>
                    <td><?=$comment->text?></td>
                    <td><?=$comment->getStringOfStatus()?></td>
                    <td><?=$comment->post->name?></td>
                    <td>

                    <?php if($comment['status'] == 1): ?>
                        <a class="btn btn-success comment-status-allow" data-id="<?=$comment->id?>"
                        href="<?= Url::to(['blog-comment/allow', 'id' => $comment->id]) ?>">Разрешить</a>
                    <?php else: ?>
                        <a class="btn btn-warning comment-status-disallow" data-id="<?=$comment->id?>"
                        href="<?= Url::to(['blog-comment/disallow', 'id' => $comment->id]) ?>">Запретить</a>
                    <?php endif; ?>

                        <a class="btn btn-danger" 
                        href="<?= Url::to(['blog-comment/delete', 'id' => $comment->id]) ?>">Удалить</a>
              
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php else: ?>
        
        <h1>Комментариев нет...</h1>
    <?php endif; ?>   

</div>
