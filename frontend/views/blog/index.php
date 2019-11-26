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
                    <a href="<?=Url::to(['/blog/index'])?>">Блог</a>
                    <?php if(isset($category)): ?>     
                        <a href="<?=Url::to(['/blog/index', 'id' => $category->id])?>"><span class="lnr lnr-arrow-right">
                        <?=ucfirst($category->name)?></a>
                    <?php endif;?>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Blog Categorie Area =================-->
<section class="blog_categorie_area">
    <div class="container">
        <div class="row">
        <?php foreach($lastCategories as $category): ?>
            <div class="col-lg-4" >
                <div class="categories_post" >
                    <?php if ($category->image): ?>
                        <?=Html::img('@web/uploads/images/blog_category/main/' .
                        $category->image, [
                            'alt' => $category->name,
                        ])?>
                    <?php else: ?>
                        <?=Html::img('@web/img/no-image.svg', [
                            'style' => 'height:220px;',
                        ]
                        )?>
                    <?php endif; ?>
                    <div class="categories_details" >
                        <div class="categories_text">
                            <a href="<?=Url::to(['/blog/category', 'id' => $category->id])?>">
                                <h5><?=$category->name?></h5>
                            </a>
                            <div class="border_line"></div>
                            <p><?=$category->description?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        </div>
    </div>
</section>
<!--================Blog Categorie Area =================-->

<!--================Blog Area =================-->
<section class="blog_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_left_sidebar">

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

                <nav class="blog-pagination justify-content-center d-flex">
                    <?php if ($pagination != null): ?>
                        <?=$pagination->getNavPageList('blog')?>
                    <?php endif; ?>
                </nav>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <div class="input-group">
                            <input type="text" class="form-control input-search" placeholder="Поиск" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Posts'">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="lnr lnr-magnifier"></i></button>
                            </span>
                        </div><!-- /input-group -->
                        <div class="br"></div>
                    </aside>

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

