<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Product;
use frontend\models\Cart;
use frontend\models\UserData;

class CartController extends Controller
{
    public function actionIndex()
    {   
        $session = Yii::$app->session;
        $session->open();

        return $this->render('index');
    }

    public function actionCustomerData()
    {
        $session = Yii::$app->session;
        $session->open();

        $user_id = Yii::$app->user->identity['id'];
        $email = Yii::$app->user->identity['email'];

        if (!$user_id) {

            return $this->render('customer_data', [
                'user_data' => null,
            ]);
        } else {
            $user_data = UserData::findOne(['user_id' => $user_id]);

            return $this->render('customer_data', [
                'user_data' => $user_data,
                'email' => $email,
            ]);
        }
    }



    public function actionAddProduct()
    {   
        $session = Yii::$app->session;
        $session->open();
        $id = Yii::$app->request->get('id');
        $qty = Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;

        $product = Product::findOne(['id' => $id]);
        if ($product == null) return false;

        $cart = new Cart();
        $cart->addToCart($product, $qty);
        
        return $_SESSION['cart_total']['total_qty'];
    }

    public function actionChangeCountProduct()
    {   
        $session = Yii::$app->session;
        $session->open();

        $id = Yii::$app->request->get('id');
        $count = Yii::$app->request->get('count');

        $cart = new Cart(); 
        $newCount = [];

        $newCount['product_qty'] = $cart->changeCountProduct($id, $count);
        
        $newCount['product_total_sum'] = $_SESSION['cart'][$id]['price'] * $newCount['product_qty'];
        
        $newCount['total_qty'] = $_SESSION['cart_total']['total_qty'];
        $newCount['total_sum'] = $_SESSION['cart_total']['total_sum'];
        
        if (!isset($_SESSION['cart_total']['shipping'])) {
            $_SESSION['cart_total']['shipping'] = 0;
        }

        return $this->asJson($newCount);
    }

    public function actionRemoveProduct()
    {   
        $session = Yii::$app->session;
        $session->open();

        $product_id = Yii::$app->request->get('id');

        $removed_qty = $_SESSION['cart'][$product_id]['qty'];
        $removed_sum = $_SESSION['cart'][$product_id]['qty'] * $_SESSION['cart'][$product_id]['price'];

        $_SESSION['cart_total']['total_qty'] -= $removed_qty;
        $_SESSION['cart_total']['total_sum'] -= $removed_sum;

        unset($_SESSION['cart'][$product_id]);

        $newCount['total_qty'] = $_SESSION['cart_total']['total_qty'];
        $newCount['total_sum'] = $_SESSION['cart_total']['total_sum'];

        if (!isset($_SESSION['cart_total']['shipping'])) {
            $_SESSION['cart_total']['shipping'] = 0;
        }

        return $this->asJson($newCount);
    }

    public function actionShipping()
    {   
        $session = Yii::$app->session;
        $session->open();

        $oldPrice = Yii::$app->request->get('oldPrice');
        $price = Yii::$app->request->get('price');
        if (!$price) $price = 0;
        
        $_SESSION['cart_total']['total_all'] = $_SESSION['cart_total']['total_sum'] - $oldPrice;
        $_SESSION['cart_total']['total_all'] = $_SESSION['cart_total']['total_sum'] + $price;
        $_SESSION['cart_total']['shipping'] = $price;

        $newPrice = $_SESSION['cart_total']['total_all'];

        return $newPrice;
    }

    // ============== HELPERS METHODS =================
    protected function debug($val, $exit = true)
    {
        echo "<pre>";
        print_r($val);
        echo "</pre>";
        if ($exit === true) {
            exit();
        }
    }
}