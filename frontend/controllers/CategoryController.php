<?php 

namespace frontend\controllers;

use Yii;
use frontend\models\Product;
use frontend\models\Category;
use yii\base\Controller;
use common\components\Pagination;


class CategoryController extends Controller
{
    public function actionIndex()
    {   
        $limit = 6;
        if (!$page = Yii::$app->request->get('page')){
            $page = 1;
        }
        $offset = ($page - 1) * $limit;
        
        $category = new Category();
        $product = new Product();

        $allCategories = $category->getAllCategories();
        $weekProducts = $product->getDealsWeekProducts();

        if ($id = Yii::$app->request->get('id')){
            $pageProducts = $product->getProductsForPageByCategory($limit, $offset, $id);

            $total = Product::find()->where(['category_id' => $id])->count();
            $second_index = "/$id";

            $selectedCategory = Category::findOne(['id' => $id]);
            $selectedCategoryName = $selectedCategory->name;
        } else {
            $id = '0';
            $pageProducts = $product->getProductsForPage($limit, $offset);

            $total = Product::find()->count();
            $second_index = "";

            $selectedCategoryName = 'Общая категория';
        }

        if ($limit < $total) {
            $pagination = new Pagination($total, $limit, $page, 'category', $second_index);
        } else {
            $pagination = null;
        }

        return $this->render('index', [
            'pageProducts' => $pageProducts,
            'allCategories' => $allCategories, 
            'weekProducts' => $weekProducts,
            'pagination' => $pagination,
            'selectedCategoryName' => $selectedCategoryName,
            'categoryId' => $id,
        ]);
    }


    //=================== AJAX ACTIONS ====================
    public function actionSelectPage()
    {   
        if(!$limit = Yii::$app->request->get('count')){
            $limit = 6;
        }
        if(!$page = Yii::$app->request->get('page')) {
            $page = 1; 
        }
        $offset = ($page - 1) * $limit;
        
        $product = new Product();

        if ($id = Yii::$app->request->get('id')){
            if ($price = Yii::$app->request->get('price')) {
                $pageProducts = $product->getProductsForPageByCategory($limit, $offset, $id, 'id', $price);
            } else {
                $pageProducts = $product->getProductsForPageByCategory($limit, $offset, $id);
            }
        } else {
            if ($price = Yii::$app->request->get('price')) {
                $pageProducts = $product->getProductsForPage($limit, $offset, 'id', $price);
            } else {
                $pageProducts = $product->getProductsForPage($limit, $offset);
            }  
        }

        return $this->renderPartial('select_page', [
            'pageProducts'=> $pageProducts,
        ]);
    }

    public function actionLinkPager()
    {
        if(!$limit = Yii::$app->request->get('count')){
            $limit = 6;
        }
        if(!$page = Yii::$app->request->get('page')) {
            $page = 1; 
        }

        if (($id = Yii::$app->request->get('id')) != false){
            if ($price = Yii::$app->request->get('price')) {
                $total = Product::find()->where(['category_id' => $id])
                    ->andWhere(['between', 'price', $price[0], $price[1]])
                    ->count();
                $second_index = "/$id";
            } else {
                $total = Product::find()->where(['category_id' => $id])->count();
                $second_index = "/$id";
            }
        } else {
            if ($price = Yii::$app->request->get('price')) {
                $total = Product::find()
                    ->where(['between', 'price', $price[0], $price[1]])
                    ->count();
                $second_index = "";
            } else {
                $total = Product::find()->count();
                $second_index = "";
            }
        }

        if ($limit < $total) {
            $pagination = new Pagination($total, $limit, $page, 'category', $second_index);
        } else {
            $pagination = null;
        }
        return $this->renderPartial('nav_pagination', [
            'pagination' => $pagination,
        ]);
    }


    // ==================== PRINT_DATA ===========================
    protected function debug($val, $exit = true)
    {
        echo "<pre>";
        print_r($val);
        echo "</pre>";
        if ($exit == true) {
            exit();
        }
    }
}