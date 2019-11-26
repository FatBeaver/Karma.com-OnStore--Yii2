<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Страница блога</h1>
                <nav class="d-flex align-items-center">
                    <a href="<?=Url::to(['/home/index'])?>">Главная<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?=Url::to(['/blog/index'])?>">Блог<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?=Url::to(['/blog/detail', 'id' => $post->id])?>">
                    <?=ucfirst($post->name)?></a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Blog Area =================-->
<section class="blog_area single-post-area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post row">

                    <div class="col-lg-12 ">
                        <div class="feature-img">
                        <?=Html::img('@web/uploads/images/blog/' . 
                            $post->image, [
                                'alt' => $post->name,
                                'style' => 'float:right; max-width:750px; min-width:400px;'
                            ])?>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
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

                    <div class="col-lg-9 col-md-9 blog_details">
                        <h2><?=ucfirst($post->name)?></h2>
                        <?=mb_substr($post->content, 0, 500)?>       
                    </div>

                    <div class="col-lg-12" style="margin-top:-11px;">
                        
                        <?=mb_substr($post->content, 500)?> 
                       
                    </div>
                </div>
                <div class="navigation-area">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                            <?php if (isset($navPosts['prev_post'])): ?>
                            <div class="thumb">
                                <a href="<?=Url::to(['/blog/detail', 'id' => $navPosts['prev_post']->id])?>">
                                    <?=Html::img('@web/uploads/images/blog/for_nav/' . 
                                    $navPosts['prev_post']->image, [
                                        'alt' => $navPosts['prev_post']->name,
                                        
                                    ])?>
                                </a>
                            </div>
                            <div class="arrow">
                                <a href="<?=Url::to(['/blog/detail', 'id' => $navPosts['prev_post']->id])?>">
                                    <span class="lnr text-white lnr-arrow-left"></span>
                                </a>
                            </div>
                            <div class="detials">
                                <p>Предыдущий пост</p>
                                <a href="<?=Url::to(['/blog/detail', 'id' => $navPosts['prev_post']->id])?>">
                                    <h4><?=$navPosts['prev_post']->name;?></h4>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                     

                        <?php if (isset($navPosts['next_post'])):?>
                        <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                            <div class="detials">
                                <p>Cледующий пост</p>
                                <a href="<?=Url::to(['/blog/detail', 'id' => $navPosts['next_post']->id])?>">
                                    <h4><?=$navPosts['next_post']->name;?></h4>
                                </a>
                            </div>
                            <div class="arrow">
                                <a href="#"><span class="lnr text-white lnr-arrow-right"></span></a>
                            </div>
                            <div class="thumb">
                                <a href="<?=Url::to(['/blog/detail', 'id' => $navPosts['next_post']->id])?>">
                                <?=Html::img('@web/uploads/images/blog/for_nav/' . 
                                    $navPosts['next_post']->image, [
                                        'alt' => $navPosts['next_post']->name,    
                                    ])?>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="comments-area">
                    <h4><?=$post->getCommentsCount()?></h4>

                    <?php foreach ($pagination['comments_page'] as $comment): ?>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <?=Html::img('@web/uploads/images/users/for_profile/'. 
                                    $comment->author->data->image, [
                                        'alt' => $comment->author->data->first_name,
                                        'style' => 'border-radius:50%;',
                                    ])?>
                                </div>
                                <div class="desc">
                                    <h5><a href="#"><?=ucfirst($comment->author->data->first_name) . 
                                    ' ' . ucfirst($comment->author->data->last_name)?></a></h5>
                                    <p class="date"><?=Yii::$app->formatter->asDateTime($comment->created_at, 'medium')?></p>
                                    <p class="comment">
                                        <?=ucfirst($comment->text)?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
                <div class="comment-form">
                <?php if (!Yii::$app->user->isGuest):?>
                    <h4>Оставить комментарий</h4>
                    <form method="POST" action="<?=Url::to(['/blog/detail', 'id' => $post->id])?>">
                        <div class="form-group">
                            <textarea class="form-control mb-10" rows="5" name="message" 
                            placeholder="Поле для комментария"
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Поле для комментария'" 
                            required=""></textarea>
                        </div>
                        <input type="hidden" value="<?=Yii::$app->request->getCsrfToken()?>" />
                        <input type="submit" class="primary-btn submit_btn" value="Отправить" name="submit">
                    </form>
                <?php else: ?>
                    <h1>Комментирование доступно авторизованным пользователям...</h1>
                <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget author_widget">
                            <?=Html::img('@web/uploads/images/users/' . 
                            $blogAdmin->data->image, [
                                'alt' => $blogAdmin->username,
                                'style' => 'width:120px; border-radius:50%;',
                            ])?>
                            <h4><?=ucfirst($blogAdmin->data->first_name) . ' ' . ucfirst($blogAdmin->data->last_name)?></h4>
                            <p>Администратор блога</p>
                            <div class="social_icon">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="https://github.com/fatbeaver"><i class="fa fa-github"></i></a>
                                <a href="#"><i class="fa fa-behance"></i></a>
                            </div>
                            <p>Администратор постов блога, путшествует по
                                разным странам и делится своими впечатлениями/истроиями в данном блоге.</p>
                            <div class="br"></div>
                        </aside>
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Популярные посты</h3>
                        <?php foreach($popularPosts as $post): ?>
                            <div class="media post_item">
                            <?=Html::img('@web/uploads/images/blog/' . 
                                $post->image, [
                                    'alt' => $post->name,
                                    'style' => 'width:100px;',
                                ])?>
                                <div class="media-body">
                                    <a href="<?=Url::to(['/blog/detail', 'id' => $post->id])?>">
                                        <h3><?=$post->name?></h3>
                                    </a>
                                    <p><?php echo Yii::$app->formatter->format($post->created_at, 'relativeTime') ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="br"></div>
                    </aside>
                    <aside class="single_sidebar_widget ads_widget">
                        <a href="#"><img class="img-fluid" src="img/blog/add.jpg" alt=""></a>
                        <div class="br"></div>
                    </aside>
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Категории постов</h4>
                        <ul class="list cat-list">
                        <?php foreach($allCategories as $category): ?>            
                            <li>
                            <a href="<?=Url::to(['/blog/category', 'id' => $category->id])?>" 
                            class="d-flex justify-content-between">
                                <p><?=$category->name?></p>
                                <p><?=$category->getCountPosts()?></p>
                            </a>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                        <div class="br"></div>
                    </aside>
                </div>
            </div>

        </div>
    </div>
</section>
<!--================Blog Area =================-->
