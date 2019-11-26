<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="row ">
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
                    <a href="<?=Url::to(['product/index/', 'id' => $product->id])?>"
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

                    <a href="" class="social-info">
                        <span class="ti-bag"></span>
                        <p class="hover-text">В корзину</p>
                    </a>
                    <a href="<?=Url::to(['product/index/', 'id' => $product->id])?>" 
                        class="social-info" style="color:#000;">
                        <span class="lnr lnr-move"></span>
                        <p class="hover-text">Подробнее</p>
                    </a>

                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>