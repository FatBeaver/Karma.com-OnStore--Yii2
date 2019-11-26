<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Процесс покупки</h1>
                <nav class="d-flex align-items-center">
                    <a href="<?=Url::to(['/home/index'])?>">Главная<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?=Url::to(['/category/index'])?>">Категории<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?=Url::to(['/cart/index'])?>">Корзина<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?=Url::to(['/cart/customer-data'])?>">Данные для заказа</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <div class="row">

            <?php if (Yii::$app->user->isGuest): ?>
               
                <?= $this->render('_guest') ?>
                       
            <?php else: ?>

                <?= $this->render('_non-guest', [
                    'user_data' => $user_data,
                    'email' => $email,
                ]) ?>
                
            <?php endif;?>

                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Ваш заказ</h2>
                        <ul class="list">
                            <li><a href="#">Продукт <span>Всего</span></a></li>
                            <?php foreach($_SESSION['cart'] as $product):?>
                                <li>
                                    <a href="#"><?=mb_substr($product['name'],0, 15)?>...
                                    <span class="middle">x <?=$product['qty']?></span> 
                                        <span class="last">$ <?=$product['sum'] * $product['qty']?></span>
                                    </a>
                                </li>
                            <?php endforeach;?>
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Всего: <span>$ <?=$_SESSION['cart_total']['total_sum']?>
                                </span></a></li>
                            <li>
                                <a href="#">Доставка: <span>$
                                    <?=$_SESSION['cart_total']['shipping'] ?></span>
                                </a>
                            </li>
                            <li><a href="#">Итого: <span>$ <?=$_SESSION['cart_total']['total_all']?></span></a></li>
                        </ul>

                        <button class="primary-btn process-button" form="cart-form" 
                        style="border:none; width:100%; margin-top:12px;">Оплатить заказ</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->

