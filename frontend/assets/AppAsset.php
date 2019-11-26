<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "css/linearicons.css",
        "css/font-awesome.min.css",
        "css/themify-icons.css",
        "css/bootstrap.css",
        "css/owl.carousel.css",
        "css/nice-select.css",
        "css/nouislider.min.css",
        "css/ion.rangeSlider.css",
        "css/ion.rangeSlider.skinFlat.css",
        "css/magnific-popup.css",
        "css/main.css",
    ];
    public $js = [
        "js/vendor/jquery-2.2.4.min.js",
        "js/vendor/bootstrap.min.js",
        "js/jquery.ajaxchimp.min.js",
        "js/jquery.nice-select.min.js",
        "js/jquery.sticky.js",
        "js/nouislider.min.js",
        "js/jquery.mCustomScrollbar.concat.min.js",
        "js/countdown.js",
        "js/jquery.magnific-popup.min.js",
        "js/owl.carousel.min.js",
        "https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE",
        "js/gmaps.min.js",
        "js/main.js",
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
