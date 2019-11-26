<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Страница просмотра товара</h1>
                <nav class="d-flex align-items-center">
                    <a href="<?=Url::to(['/home/index'])?>">Главная<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?=Url::to(['/category/index'])?>">Категории<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?=Url::to(['/category/index', 'id' => $product->category_id])?>">
                    <?=$product->category->name?><span class="lnr lnr-arrow-right"></span>
                    </a>
                    <a href="#" class="detail-product-id" data-id="<?=$product->id?>"><?=$product->name?></a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="s_Product_carousel">
                <?php foreach($allImages['additional'] as $image): ?>
                    <div class="single-prd-item">
                        <?=Html::img('@web/uploads/images/products/additional/' . 
                        $image, [
                            'alt' => $product->name,
                        ])?>
                    </div>
                <?php endforeach; ?>  
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3><?=$product->name?></h3>
                    <h2>$ <?=$product->price?></h2>
                    <ul class="list">
                        <li>
                            <a class="active" href="<?=Url::to(['/category/index', 'id' => $product->category_id])?>">
                            <span>Категория</span> : <?=$product->category->name?></a>
                        </li>
                        <li>
                            <a href="#"><span>Наличие</span> : 
                            <?= ($product->availibility == 1) ? 'В наличии' : 'Отсутствует в продаже' ?>
                            </a>
                        </li>
                    </ul>
                    <p><?=$product->light_descr?></p>
                    <div class="product_count">
                        <label for="qty">Количество</label>
                        <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                            class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                        <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                            class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                    </div>
                    <div class="card_area d-flex align-items-center">
                        <a class="primary-btn add-to-cart-single" data-id="<?=$product->id?>" 
                        href="<?=Url::to(['/product/index/', 'id' => $product->id])?>">Добавить в корзину</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" 
                aria-controls="home" aria-selected="true">Описание товара</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                    aria-selected="false">Параметры товара</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
                    aria-selected="false">Отзывы о товаре</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p><?=$product->full_descr?></p>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <h5>Ширина</h5>
                                </td>
                                <td>
                                    <h5><?=$parametrs->width?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Высота</h5>
                                </td>
                                <td>
                                    <h5><?=$parametrs->height?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Глубина</h5>
                                </td>
                                <td>
                                    <h5><?=$parametrs->depth?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Масса</h5>
                                </td>
                                <td>
                                    <h5><?=$parametrs->weight?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Проверка качества</h5>
                                </td>
                                <td>
                                    <h5><?=$parametrs->qual_check?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Гарантия</h5>
                                </td>
                                <td>
                                    <h5><?=$parametrs->freshness?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>При упаковке</h5>
                                </td>
                                <td>
                                    <h5><?=$parametrs->packeting?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Размер коробки</h5>
                                </td>
                                <td>
                                    <h5><?=$parametrs->box_contains?></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row total_rate">
                        <?php if(!Yii::$app->user->isGuest): ?>
                            <?php if($userSendFeedback == null): ?>
                            <div class="col-6">
                                <div class="box_total">
                                    <h5>Оценка</h5>
                                    <h4><?=$rating?></h4>
                                    <h6>( <?=$countReview?> отзывов)</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="rating_list">
                                    <h3>Оставьте оценку данному товару</h3>
                                    <ul class="list">
                                        <li class="select-star" data-rating="5"><a href="#">5 Звёзд  <i style="margin-left:11px;" class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                            class="fa fa-star" ></i><i class="fa fa-star"></i></a></li>
                                        <li class="select-star" data-rating="4"><a href="#">4 Звезды <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                            class="fa fa-star"></i> </a></li>
                                        <li class="select-star" data-rating="3"><a href="#">3 Звезды <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></a></li>
                                        <li class="select-star" data-rating="2"><a href="#">2 Звезды <i class="fa fa-star"></i><i class="fa fa-star"></i> </a></li>
                                        <li class="select-star" data-rating="1"><a href="#">1 Звезда  <i style="margin-left:3px;" class="fa fa-star"></i>  </a></li>
                                    </ul>
                                </div>
                            </div>
                            <?php else: ?>
                                <div class="col-6">
                                    <div class="box_total">
                                        <h5>Оценка</h5>
                                        <h4><?=$rating?></h4>
                                        <h6>( <?=$countReview?> отзывов)</h6>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="rating_list">
                                        <h3>Вы оценили данный товар на <?=$userRating->stars?>. </h3>
                                        <ul class="list">
                                        
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                        <div class="col-6">
                            <div class="rating_list">
                                <h3>Авторизируйтесь что-бы оценить данный товар<div class=""></div></h3>
                                <ul class="list">
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                        </div>
                        <p class="user-reviews">Отзывы о товаре</p>
                    <div class="review_list">
                        <?php foreach($reviews as $review): ?>
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                    <?=Html::img('@web/uploads/images/users/for_profile/' . $review->user->data->image, [
                                        'alt' => $review->user->data->image,
                                        'style' => 'border-radius:50%;',
                                    ])?>
                                    </div>
                                    <div class="media-body">
                                        <h3><?=ucfirst($review->user->data->first_name) . ' ' . 
                                        ucfirst($review->user->data->last_name)?></h3>
                                    </div>
                                </div>
                                <p><?=ucfirst($review->reviews)?></p>
                            </div>
                            <hr/>
                        <?php endforeach; ?>
                        <div class="nav-reviews">
                            <?php 
                                if($pagination != null) {
                                echo $pagination->getNavPageList('review');
                                }
                            ?>
                        </div> 
                    </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                        <?php if (!Yii::$app->user->isGuest): ?>
                            <h3>Оставить свой отзыв</h3>
                            <form class="row contact_form" action="<?=Url::to(['/product/index', 'id' => $product->id])?>" m
                                ethod="POST" id="contactForm" novalidate="novalidate">
                                <div class="col-md-12">       
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" id="message" 
                                        rows="1" placeholder="Ваш отзыв" onfocus="this.placeholder = ''" 
                                        onblur="this.placeholder = 'Review'" data-product="<?=$product->id?>"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="primary-btn review">Отправить</button>
                                </div>
                            </form>
                        <?php else: ?>
                            <h3>Оставлять отзывы могут только авторизованные пользователи.</h3>
                        <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Description Area =================-->

<!-- Start related-product Area -->
<section class="related-product-area section_gap_bottom">
<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Лучшие товары недели</h1>
                    <p>Подборка самых топовых товаров этой недели!</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                <?php 
                    foreach($weekProducts as $product): 
                    $image = unserialize($product->images);
                ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            <a href="<?=Url::to(['product/index/', 'id' => $product->id])?>">
                                <?=Html::img('@web/uploads/images/products/main/' . 
                                $image['main'], [
                                    'alt' => $product->name,
                                    'style' => 'width:80px;',
                                ])?>
                            </a>
                            <div class="desc">
                                <a href="<?=Url::to(['product/index/', 'id' => $product->id])?>" class="title"><?=$product->name?></a>
                                <div class="price">
                                    <h6><?=$product->price?></h6>
                                    <h6 class="l-through">
                                    <?php 
                                        echo '$'. (($product->price / 100) * 115);
                                    ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ctg-right">
                    <a href="#" target="_blank">
                        <img class="img-fluid d-block mx-auto" src="/img/category/c5.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End related-product Area -->

