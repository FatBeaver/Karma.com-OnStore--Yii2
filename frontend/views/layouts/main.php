<?php 

use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;

AppAsset::register($this);

function ifActivePage($string)
{
	$uri = $_SERVER['REQUEST_URI'];
	if (preg_match("[$string]", $uri)) {
		return 'active';
	}
	return '';
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta name="interkassa-verification" content="244428f3f16fcc7e19f00b0ae7f5ef97" />
	<?= Html::csrfMetaTags() ?>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Karma Shop</title>
	<!--
		CSS
		============================================= -->
	<!--<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/main.css">-->
	<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="<?=Url::to(['/home/index'])?>"><img src="/img/logo.png" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">

							<li class="nav-item <?=ifActivePage('\\\\/')?>"><a class="nav-link"
							 href="<?=Url::to(['home/index'])?>">Главная</a></li>

							<li class="nav-item <?=ifActivePage('/category')?>">
								<a class="nav-link" 
								href="<?=Url::to(['category/index'])?>">Категории</a>
							</li>

							<li class="nav-item" <?=ifActivePage('/blog')?>>
								<a class="nav-link" 
								href="<?=Url::to(['blog/index'])?>">Блог</a>
							</li>

							<?php if(Yii::$app->user->isGuest): ?>
								<li class="nav-item <?=ifActivePage('/login')?>">
									<a href="<?=Url::to(['site/login'])?>" class="nav-link">Войти</a>
								</li>
							<?php else: ?>
								<li class="nav-item <?=ifActivePage('/profile')?>">
									<a href="<?=Url::to(['site/profile'])?>" class="nav-link">Профиль</a>
								</li>
								<li class="nav-item <?=ifActivePage('/login')?>">
									<a href="<?=Url::to(['site/logout'])?>" class="nav-link">
									Выйти ( <?=Yii::$app->user->identity['username']?> )
									</a>
								</li>
							<?php endif; ?>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="nav-item nav-item-cart">
								<a href="<?=Url::to(['/cart/index'])?>" class="cart">
									<span class="ti-bag"></span> 
									<span class="ajax_cart">
									<?php if (!empty($_SESSION['cart'])):?>
										<?=$_SESSION['cart_total']['total_qty']?>
									<?php endif;?>
									</span>
								</a>
							</li>
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>
	<!-- End Header Area -->

	<?=$content?>

	<!-- start footer Area -->
	<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-sm-6" style="margin-left:15%;">
					<div class="single-footer-widget">
						<h6>О нас</h6>
						<p>
							Супермегакрутойкручененайдешь магазин самых модных и качественных товаров!
						</p>
					</div>
				</div>
				<div class="col-lg-4  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Подписка на новости</h6>
						<p>Подпишись на нас</p>
						<div class="" id="mc_embed_signup">

							<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
							 method="get" class="form-inline">

								<div class="d-flex flex-row">

									<input class="form-control" name="EMAIL" placeholder="Введите Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
									 required="" type="email">


									<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
									<div style="position: absolute; left: -5000px;">
										<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
									</div>

									<!-- <div class="col-lg-4 col-md-4">
												<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
											</div>  -->
								</div>
								<div class="info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Мы в соц.сетях</h6>
						<p>Подпишись и будешь в курсе последних трендов моды!</p>
						<div class="footer-social d-flex align-items-center">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				Copyright &copy;<script>document.write(new Date().getFullYear());</script> Karma.com By FatBeaver <a href="https://github.com/FatBeaver" target="_blank">GitHub</a>
				<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->

<!--	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/countdown.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script> -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>