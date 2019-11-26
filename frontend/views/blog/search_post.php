<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php if($posts != null): ?>
<?php foreach($posts as $post): ?>
    <article class="row blog_item">
        <div class="col-md-3">
            <div class="blog_info text-right">
                <div class="post_tag">
                    <?php foreach($post->categories as $category): ?>
                        <a href="<?=Url::to(['/blog/category', 'id' => $category->id])?>"
                        class="active-category">
                        <?=ucfirst($category->name)?></a>
                    <?php endforeach; ?>
                </div>
                <ul class="blog_meta list">
                    <li><a href="#"><?=ucfirst($post->author->data->first_name) . ' ' 
                    . ucfirst($post->author->data->last_name)?>
                    <i class="lnr lnr-user"></i></a></li>
                    <li><a href="#"><?=Yii::$app->formatter->asDate($post->created_at, 'long')?>
                        <i class="lnr lnr-calendar-full"></i></a>
                    </li>
                    <li><a href="#"><?=$post->viewed?><i class="lnr lnr-eye"></i></a></li>
                    <li><a href="#"><?=$post->getCommentsCount()?><i class="lnr lnr-bubble"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="blog_post">
                <?php if ($post->image): ?>
                    <?=Html::img('@web/uploads/images/blog/main/' . 
                    $post->image, [
                        'alt' => $post->name
                    ])?>
                <?php else: ?>
                    <?=Html::img('@web/img/no-image.svg', [
                        'style' => 'width:500px;',
                        ]
                    )?>
                <?php endif;?>
                <div class="blog_details">
                    <a href="<?=Url::to(['/blog/detail', 'id' => $post->id])?>">
                        <h2><?=$post->name?></h2>
                    </a>
                    <p><?=$post->light_descr?></p>
                    <a href="<?=Url::to(['/blog/detail', 'id' => $post->id])?>" 
                    class="white_bg_btn">Подробнее</a>
                </div>
            </div>
        </div>
    </article>
<?php endforeach; ?> 
<?php else: ?>
<h1>Ничего не найдено...</h1>
<?php endif; ?>