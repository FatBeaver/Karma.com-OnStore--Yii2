<?php 

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Category;
use frontend\models\Product;

class HomeController extends Controller
{   
    public function actionIndex()
    {   
        $product = new Product();
        $category = new Category();

        $recommProducts = $product->getRecommendedProducts();
        $weekProducts = $product->getDealsWeekProducts();
        $latestProducts = $product->getLatestProducts();
        $comingProducts = $product->getCommingProducts();
        $exclusiveProducts = $product->getExclusiveProducts();
        $recommCategories = $category->getRecommendedCategory();

        return $this->render('index', [
            'recommProducts' => $recommProducts,
            'categories' => $recommCategories,
            'latestProducts' => $latestProducts,
            'comingProducts' => $comingProducts,
            'exclusiveProducts' => $exclusiveProducts,
            'weekProducts' => $weekProducts,
        ]);
    }

    protected function debug($val)
    {
        echo '<pre>';
        print_r($val);exit;
        echo '</pre>';
    }
}