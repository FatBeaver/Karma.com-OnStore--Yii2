<?php

namespace frontend\controllers;

use Yii;
use common\components\Pagination;
use frontend\models\Reviews;
use frontend\models\Product;
use frontend\models\ProductRating;
use frontend\models\UserData;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex()
    {   
        $prodObj = new Product();
        $product_id = Yii::$app->request->get('id');
        $user_id = Yii::$app->user->identity['id'];

        $pageReviews = $this->getPageReviews(); // Получение отзывов для конкретной страницы;
        $pagination = $this->getPaginationForReviews(); // Пагинация для конкретной странницы;

        $product = Product::findOne(['id' => $product_id]); 
        $parametrs = $product->parametrs;
        $allImages = unserialize($product->images);

        $weekProducts = $prodObj->getDealsWeekProducts();

        $countReview = Reviews::find()->where(['product_id' => $product_id])->count();
        $countAssessment = ProductRating::find()->where(['product_id' => $product_id])->count();
        $userSendFeedback = ProductRating::find()->where(['user_id' => $user_id])
            ->andWhere(['product_id' => $product_id])->all();
        $userRating = ProductRating::find()->where(['product_id' => $product_id])
            ->andWhere(['user_id' => $user_id])->one();
        
        $allStars = ProductRating::findAll(['product_id' => $product_id]);

        if ($allStars) {

            $totalRating = 0;
            foreach ($allStars as $star)
            {
                $totalRating += $star->stars;
            }
            $rating = $totalRating / $countAssessment;

        } else {

            $rating = 'Нет оценок';
        }

        return $this->render('index', [
            'product' => $product,
            'parametrs' => $parametrs,
            'allImages' => $allImages,
            'weekProducts' => $weekProducts,
            'reviews' => $pageReviews,
            'pagination' => $pagination,
            'userSendFeedback' => $userSendFeedback,
            'rating' => $rating,
            'countReview' => $countReview,
            'userRating' => $userRating,
        ]);
    }

    protected function getPageReviews()
    {   
        $product_id = Yii::$app->request->get('id');

        $limit = 4;
        if (!$page = Yii::$app->request->get('page')){
            $page = 1;
        }
        $offset = ($page - 1) * $limit;
        
        $reviews = Reviews::find()->where(['product_id' => $product_id])->limit($limit)->offset($offset)
            ->orderBy(['id' => SORT_DESC])->all();
        
        return $reviews;
    }

    protected function getPaginationForReviews()
    {   
        $product_id = Yii::$app->request->get('id');

        $limit = 4;
        if (!$page = Yii::$app->request->get('page')){
            $page = 1;
        }

        $total = Reviews::find()->where(['product_id' => $product_id])->count();

        if ($limit < $total) {
            $pagination = new Pagination($total, $limit, $page, 'product/detail', $product_id);
        } else {
            $pagination = null;
        }

        return $pagination;
    }

    // =================== AJAX ACTIONS =====================
    public function actionAddReview()
    {
        $user_id = Yii::$app->user->identity['id'];
        $product_id = Yii::$app->request->get('id');
        $reviewText = Yii::$app->request->get('text');

        $review = new Reviews();
        $review->reviews = $reviewText;
        $review->user_id = $user_id;
        $review->product_id = $product_id;
        $review->save();

        $viewReview = Reviews::find()->where(['user_id' => $user_id])
            ->orderBy(['id' => SORT_DESC])->limit(1)->one();
        $user_data = UserData::findOne(['user_id' => $user_id]);
       
        return $this->renderPartial('add_review', [
            'viewReview' => $viewReview,
            'user_data' => $user_data,
        ]);
    }

    public function actionSelectStar()
    {
        $stars = Yii::$app->request->get('stars');
        $user_id = Yii::$app->user->identity['id'];
        $product_id = Yii::$app->request->get('id');

        $rating = new ProductRating();
        $rating->stars = $stars;
        $rating->product_id = $product_id;
        $rating->user_id = $user_id;
        $rating->save();
        
        $countReview = Reviews::find()->where(['product_id' => $product_id])->count();
        $countAssessment = ProductRating::find()->where(['product_id' => $product_id])->count();
        $allStars = ProductRating::findAll(['product_id' => $product_id]);
        $userRating = ProductRating::find()->where(['product_id' => $product_id])
            ->andWhere(['user_id' => $user_id])->one();
        if ($allStars) {

            $totalRating = 0;
            foreach ($allStars as $star)
            {
                $totalRating += $star->stars;
            }
            $viewRating = round($totalRating / $countAssessment, 1);

        } else {
            
            $viewRating = 'Нет оценок';
        }

        return $this->renderPartial('prod_rating', [
            'viewRating' => $viewRating,
            'countReview' => $countReview,
            'userRating' => $userRating,
        ]);
    }

    public function actionSelectPageReviews()
    {  
        $product_id = Yii::$app->request->get('id');
        $limit = 4;
        if(!$page = Yii::$app->request->get('page')) {
            $page = 1; 
        }
        $total = Reviews::find()->count();
        
        $offset = ($page - 1) * $limit;

        $pageReviews = Reviews::find()->where(['product_id' => $product_id])->limit($limit)->offset($offset)
        ->orderBy(['id' => SORT_DESC])->all();
        

        if ($limit < $total) {
            $pagination = new Pagination($total, $limit, $page, 'product/detail', $product_id);
        } else {
            $pagination = null;
        }

        return $this->renderPartial('review_ajax', [
            'pagination' => $pagination,
            'pageReviews' => $pageReviews,
        ]);
    }
    // =================== END AJAX ACTIONS ===============


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