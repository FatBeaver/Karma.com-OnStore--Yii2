<?php

use common\widgets\CategoryWidget;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Страница категорий</h1>
                <nav class="d-flex align-items-center">
                    <a href="<?=Url::to(['home/index'])?>">Главная<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?=Url::to(['category/index'])?>">Товары<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#" id="category_id" data-id="<?=$categoryId?>"><?=$selectedCategoryName?></a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->
<div class="container">
    <div class="row">

        <div class="col-xl-3 col-lg-4 col-md-5">
            <div class="sidebar-categories">
        
                <?= CategoryWidget::widget(['categories' => $allCategories]) ?>
                
            </div>
            <div class="sidebar-filter mt-50">
                
                <div class="common-filter">
                    <div class="head">Сортировка по цене</div>
                    <div class="price-range-area">
                        <div id="price-range"></div>
                        <div class="value-wrapper d-flex">
                            <div class="price">Цена:</div>
                            <div class="to">от </div>
                            <span>$</span>
                            <div id="lower-value"></div>
                            <div class="to"> до </div>
                            <span>$</span>
                            <div id="upper-value"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-9 col-lg-8 col-md-7">
            <!-- Start Filter Bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center">
                <div class="sorting">
                   <!-- <select>
                        <option value="6">По алфавиту</option>
                        <option value="9">По цене</option>
                        <option value="12">По дате</option>
                    </select> -->
                </div>
                <div class="sorting mr-auto index_category">
                    <select>
                        <option value="3">Показать 3</option>
                        <option value="6" selected>Показать 6</option>
                        <option value="9">Показать 9</option>
                        <option value="12">Показать 12</option>
                    </select>
                </div>
                <div class="ajax_link_pager">
                    <?php if($pagination) {
                       echo $pagination->getNavPageList('category');
                    } ?>
                </div>
            </div>
            <!-- End Filter Bar -->
            <!-- Start Best Seller -->
            <section class="lattest-product-area pb-40 category-list index_category_list">
                <div class="row">
                <?php if(!empty($pageProducts)): ?>
                    <!-- single product -->
                    <?php 
                        foreach($pageProducts as $product):
                        $image = unserialize($product->images); 
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-product">
                            <div style="height:290px !important;">
                                <?=Html::img('@web/uploads/images/products/main/' . 
                                $image['main'], [
                                    'alt' => $product->name,
                                ])?>
                            </div>
                            <div class="product-details">
                                <h6>
                                    <a href="<?=Url::to(['/product/index/', 'id' => $product->id])?>"
                                    style="color:#222;">
                                    <?=$product->name?>
                                    </a>
                                </h6>
                                <div class="price">
                                    <h6>$<?=$product->price?></h6>
                                    <h6 class="l-through">
                                    <?php 
                                        echo '$'. (($product->price / 100) * 115);
                                    ?>
                                    </h6>
                                </div>
                                <div class="prd-bottom">

                                    <a href="<?=Url::to(['/cart/add-product', 'id' => $product->id])?>" 
                                        class="social-info add-to-cart" data-id="<?=$product->id?>">
                                        <span class="ti-bag"></span>
                                        <p class="hover-text">В корзину</p>
                                    </a>
                                    <a href="<?=Url::to(['/product/index/', 'id' => $product->id])?>" 
                                        class="social-info" style="color:#000;">
                                        <span class="lnr lnr-move"></span>
                                        <p class="hover-text">Подробнее</p>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h1 style="margin:80px auto;">Товаров выбранной категории нет в продаже...</h1>
                <?php endif;?>
                </div>
            </section>
            <!-- End Best Seller -->
            <!-- Start Filter Bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center">
                <div class="sorting mr-auto index_category">
                    <select>
                        <option value="3">Показать 3</option>
                        <option value="6" selected>Показать 6</option>
                        <option value="9">Показать 9</option>
                        <option value="12">Показать 12</option>
                    </select>
                </div>
                <div class="ajax_link_pager">
                    <?php if($pagination) {
                       echo $pagination->getNavPageList('category');
                    } ?>
                </div>
            </div>
            <!-- End Filter Bar -->
        </div>
    </div>
</div>

<!-- Start related-product Area -->
<section class="related-product-area section_gap">
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
                    <a href="<?=Url::to(['/category/sale'])?>" target="_blank">
                        <img class="img-fluid d-block mx-auto" src="/img/category/c5.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End related-product Area -->


<!-- Modal Quick Product View -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="container relative">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="product-quick-view">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="quick-view-carousel">
                            <div class="item" style="background: url(img/organic-food/q1.jpg);">

                            </div>
                            <div class="item" style="background: url(img/organic-food/q1.jpg);">

                            </div>
                            <div class="item" style="background: url(img/organic-food/q1.jpg);">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="quick-view-content">
                            <div class="top">
                                <h3 class="head">Mill Oil 1000W Heater, White</h3>
                                <div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10">$149.99</span></div>
                                <div class="category">Category: <span>Household</span></div>
                                <div class="available">Availibility: <span>In Stock</span></div>
                            </div>
                            <div class="middle">
                                <p class="content">Mill Oil is an innovative oil filled radiator with the most modern technology. If you are
                                    looking for something that can make your interior look awesome, and at the same time give you the pleasant
                                    warm feeling during the winter.</p>
                                <a href="#" class="view-full">View full Details <span class="lnr lnr-arrow-right"></span></a>
                            </div>
                            <div class="bottom">
                                <div class="color-picker d-flex align-items-center">Color:
                                    <span class="single-pick"></span>
                                    <span class="single-pick"></span>
                                    <span class="single-pick"></span>
                                    <span class="single-pick"></span>
                                    <span class="single-pick"></span>
                                </div>
                                <div class="quantity-container d-flex align-items-center mt-15">
                                    Quantity:
                                    <input type="text" class="quantity-amount ml-15" value="1" />
                                    <div class="arrow-btn d-inline-flex flex-column">
                                        <button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
                                        <button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
                                    </div>

                                </div>
                                <div class="d-flex mt-20">
                                    <a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
                                    <a href="#" class="like-btn"><span class="lnr lnr-layers"></span></a>
                                    <a href="#" class="like-btn"><span class="lnr lnr-heart"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



	