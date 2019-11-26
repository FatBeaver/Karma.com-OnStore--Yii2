<?php
use yii\helpers\Url;
?>
<td><?=$comment->id?></td>
<td><?=$comment->author->data->first_name?></td>
<td><?=$comment->text?></td>
<td id="<?=$comment->id?>" data-status="<?=$comment->status?>"><?=$comment->getStringOfStatus()?></td>
<td><?=$comment->post->name?></td>
<td>

<?php if($comment->status == 1): ?>
    <a class="btn btn-success comment-status-allow" data-id="<?=$comment->id?>"
    href="<?= Url::to(['blog-comment/allow', 'id' => $comment->id]) ?>">Разрешить</a>
<?php else: ?>
    <a class="btn btn-warning comment-status-disallow" data-id="<?=$comment->id?>"
    href="<?= Url::to(['blog-comment/disallow', 'id' => $comment->id]) ?>">Запретить</a>
<?php endif; ?>

    <a class="btn btn-danger" 
    href="<?= Url::to(['blog-comment/delete', 'id' => $comment->id]) ?>">Удалить</a>

</td>