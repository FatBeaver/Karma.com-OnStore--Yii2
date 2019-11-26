<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Корзина товаров</h1>
                <nav class="d-flex align-items-center">
                    <a href="<?=Url::to(['/home/index'])?>">Главная<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?=Url::to(['/category/index'])?>">Категории<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?=Url::to(['/cart/index'])?>">Корзина</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
            <?php if(isset($_SESSION['cart']) && (!empty($_SESSION['cart']))): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Изображение</th>
                            <th scope="col">Название</th>
                            <th scope="col">Цена($)</th>
                            <th scope="col">Количество(шт.)</th>
                            <th scope="col">Всего($)</th>
                            <th scope="col">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($_SESSION['cart'] as $id => $product): ?>
                        <tr id="row-<?=$id?>">
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                    <?=Html::img('@web/uploads/images/products/main/' . 
                                    $product['image'], [
                                        'alt' => $product['name'],
                                        'style' => 'width:200px;'
                                    ])?>
                                    </div>
                
                                </div>
                            </td>
                            <td>
                                <div class="media-body">
                                    <p><?=$product['name']?></p>
                                </div>
                            </td>
                            <td>
                                <h5><?=$product['price']?></h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input type="text" name="qty" id="<?=$id?>" data-id="<?=$id?>" maxlength="12" value="<?=$product['qty']?>" title="Quantity:"
                                        class="input-text qty-cart-product">

                                    <button onclick="
                                        var result = document.getElementById('<?=$id?>'); 
                                        var sst = result.value; 
                                        if( !isNaN( sst )) result.value++;
                                        return false; "
                                        class="increase items-count" type="button" style="background:white;">
                                        <i class="lnr lnr-chevron-up" style="color:#333;"></i>
                                    </button>

                                    <button onclick="
                                        var result = document.getElementById('<?=$id?>'); 
                                        var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;
                                        return false;"
                                        class="reduced items-count" type="button" style="background:white;">
                                        <i class="lnr lnr-chevron-down" style="color:#333;"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <h5 id="prod-<?=$id?>"><?=$product['qty'] * $product['price']?></h5>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove-prod" 
                                data-id="<?=$id?>">Убрать</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        <tr class="bottom_button ">
                            <td>
                               
                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="cupon_text d-flex align-items-center">
                                    
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5 style="font-size:24px;">Итого</h5>
                            </td>
                            <td>
                                <h5 id="total-price">$ <?=$_SESSION['cart_total']['total_sum']?></h5>
                            </td>
                        </tr>
                        <tr class="shipping_area">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <h5 style="font-size:24px;">Доставка</h5>
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <div class="shipping_box">
                                    <ul class="list">
                                        <li class="active"><a href="#" data-price="0">Бесплатная доставка</a></li>
                                        <li><a href="#" data-price="5">Быстрая доставка: $5.00</a></li>
                                        <li><a href="#"  data-price="2">Местная доставка: $2.00</a></li>
                                    </ul>  
                                </div>
                            </td>
                        </tr>
                        <tr class="out_button_area">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="gray_btn" href="<?=Url::to(['/category/index'])?>">
                                    Продолжить покупки</a>
                                    <a class="primary-btn" href="<?=Url::to(['/cart/customer-data'])?>">
                                    Оформить заказ</a>
                                </div>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <?php else: ?>
                    <h1 style="margin-left:29%; font-size:44px;">Товаров в корзине пока нет...</h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->
