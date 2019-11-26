<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\HomeCategoryWidget;
?>

<!-- start banner Area -->
	<section class="banner-area">
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12" >
					<div class="active-banner-slider owl-carousel" >
						<!-- single-slide -->
						<?php 
							foreach($recommProducts as $product): 
							$image = unserialize($product->images); 
							$imageWidth = $image['recommended']['width'];
							print_r($imageWidth);
							?>
						<div class="row single-slide align-items-center d-flex" style="margin-top:100px !important">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content" >
									<h1><?=$product->name?></h1>
									<p><?= mb_substr($product->light_descr, 0, 200) ?></p>
									<div class="add-bag d-flex align-items-center">
										<a class="add-btn add-to-cart plus-button" href="#" data-id="<?=$product->id?>">
										<span class="lnr lnr-cross"></span></a>
										<span class="add-text text-uppercase add-to-cart"
										data-id="<?=$product->id?>">Добавить в корзину</span>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">	
									<?= Html::img('@web/uploads/images/products/recommended/' . 
										$image['recommended']['fileName'],	 [
											'alt' => $product->name,
											'class' => "img-fluid",
											'style' => "margin-left:15%; width:$imageWidth%;",
										]); ?>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
						<!-- single-slide -->
						

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->

	<!-- start features Area -->
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon1.png" alt="">
						</div>
						<h6>Бесплатная доставка</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon2.png" alt="">
						</div>
						<h6>Возврат средств</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon3.png" alt="">
						</div>
						<h6>24/7 Поддержка</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon4.png" alt="">
						</div>
						<h6>Защищенные платежи</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end features Area -->

	<!-- Start category Area -->
	<section class="category-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-12">
					<div class="row">

						<?= HomeCategoryWidget::widget(['categories' => $categories])?>

					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-deal">
						<div class="overlay"></div>
						<img class="img-fluid w-100" src="img/category/c5.jpg" alt="">
						<a href="img/category/c5.jpg" class="img-pop-up" target="_blank">
							<div class="deal-details">
								<h6 class="deal-title">распродажа</h6>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End category Area -->

	<!-- start product Area -->
	<section class="owl-carousel active-product-area section_gap">
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Последние товары</h1>
							<p>Топовые товары появившиеся в продаже в этом месяце.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- single product -->
				<?php 
					foreach($latestProducts as $product): 
					$image = unserialize($product->images);
				?>
					<div class="col-lg-3 col-md-6">
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
											echo '$'. (($product->price / 100) * rand(115, 125));
										?>
									</h6>
								</div>
								<div class="prd-bottom">

									<a href="<?=Url::to(['/cart/add-product', 'id' => $product->id])?>" 
									class="social-info add-to-cart" data-id="<?=$product->id?>">
										<span class="ti-bag"></span>
										<p class="hover-text">В Корзину</p>
									</a>
									<a href="<?=Url::to(['/product/index', 'id' => $product->id])?>" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">Подробнее</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>	
				</div>
			</div>
		</div>
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Недавние товары</h1>
							<p>Топовые товары появишившиеся в продаже в прошлом месяце.</p>
						</div>
					</div>
				</div>
				<div class="row">
				<?php 
					foreach($comingProducts as $product): 
					$image = unserialize($product->images);
				?>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<?= Html::img('@web/uploads/images/products/main/' . $image['main'], [
								'alt' => $product->name,
								'class' => "img-fluid",
							]) ?>
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
											echo '$'. (($product->price / 100) * rand(115, 125));
										?>
									</h6>
								</div>
								<div class="prd-bottom">

									<a href="<?=Url::to(['/cart/add-product', 'id' => $product->id])?>" 
									class="social-info add-to-cart" data-id="<?=$product->id?>">
										<span class="ti-bag"></span>
										<p class="hover-text">В Корзину</p>
									</a>
									<a href="<?=Url::to(['/product/index', 'id' => $product->id])?>" class="social-info">
										<span class="lnr lnr-move"></span>
										<p class="hover-text">Детальный просмотр</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	<!-- end product Area -->

	<!-- Start exclusive deal Area -->
	<section class="exclusive-deal-area">
		<div class="container-fluid">

			<div class="row justify-content-center align-items-center">
				<div class="col-lg-6 no-padding exclusive-left">
					<div class="row clock_sec clockdiv" id="clockdiv">
						<div class="col-lg-12">
							<h1>Редкая акция, скоро заканчивается!</h1>
							<p>Для тех кто ценит удобство и качество.</p>
						</div>
						<div class="col-lg-12">
							<div class="row clock-wrap">
								<div class="col clockinner1 clockinner">
									<h1 class="days">150</h1>
									<span class="smalltext">Дней</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="hours">23</h1>
									<span class="smalltext">Часа\ов</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="minutes">47</h1>
									<span class="smalltext">Минут</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="seconds">59</h1>
									<span class="smalltext">Секунд</span>
								</div>
							</div>
						</div>
					</div>
					<a href="" class="primary-btn">Купить</a>
				</div>

				<div class="col-lg-6 no-padding exclusive-right">
					<div class="active-exclusive-product-slider">
						<!-- single exclusive carousel -->
					<?php 
						foreach($exclusiveProducts as $product): 
							if (!$product->images) {
								continue;
							}
							$image = unserialize($product->images); 
					?>		
						<div class="single-exclusive-slider">	
							<?= Html::img('@web/uploads/images/products/recommended/' 
							. $image['recommended']['fileName'], [
								'alt' => $product->name,
								'class' => "img-fluid",
								'style' => 'width:95%',
							]) ?>
							<div class="product-details">
								<div class="price">
									<h6>$<?=$product->price?></h6>
									<h6 class="l-through">
										<?php 
											echo '$'. (($product->price / 100) * 120);
										?>
									</h6>
								</div>
								<h4>
                                    <a href="<?=Url::to(['product/index/', 'id' => $product->id])?>"
                                    style="color:#222;">
                                    <?=$product->name?>
                                    </a>
                                </h4>
								<div class="add-bag d-flex align-items-center justify-content-center">
									<a class="add-btn add-to-cart" data-id="<?=$product->id?>"
									href="<?=Url::to(['/product/index', 'id' => $product->id])?>">
									<span class="ti-bag"></span></a>
									<span class="add-text text-uppercase">В Корзину</span>
								</div>
							</div>
						</div>
					<?php endforeach; ?>				
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End exclusive deal Area -->

	<!-- Start brand Area -->
	<section class="brand-area section_gap">
		<div class="container">
			<div class="row">
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/1.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/2.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/3.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/4.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/brand/5.png" alt="">
				</a>
			</div>
		</div>
	</section>
	<!-- End brand Area -->

	<!-- Start related-product Area -->
	<section class="related-product-area section_gap_bottom">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>Лучшие товары этой недели</h1>
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
								<a href="<?=Url::to(['/product/index', 'id' => $product->id])?>">
									<?= Html::img('@web/uploads/images/products/main/' 
									. $image['main'], [
										'alt' => $product->name,
										'class' => "img-fluid",
										'style' => 'width:80px',
									]) ?>
								</a>
								<div class="desc">
									<a href="<?=Url::to(['/product/index', 'id' => $product->id])?>" class="title"><?=$product->name?></a>
									<div class="price">
										<h6>$<?=$product->price?></h6>
										<h6 class="l-through">
										<?php 
											echo '$'. (($product->price / 100) * 120);
										?>
										</h6>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
						<!--<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r11.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div> -->
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