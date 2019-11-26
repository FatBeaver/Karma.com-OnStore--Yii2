<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Product;
use frontend\models\Cart;
use frontend\models\UserData;
use common\models\Order;
use common\models\OrderProduct;

class CartController extends Controller
{   
    public $enableCsrfValidation = false;

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

        if (!isset($_SESSION['cart_total']['shipping'])) {
            $_SESSION['cart_total']['shipping'] = 0;
        }
        $_SESSION['cart_total']['total_all'] = $_SESSION['cart_total']['total_sum'] + 
        $_SESSION['cart_total']['shipping'];

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

    public function actionProcess()
    {
        if (empty($_POST)) {
            die;
        }

        $test_key = 'QJT0fRX9rD6qi2zy';
        $ic_co_id = "5ddbca751ae1bd11048b4594";
        $dataSet = $_POST;

        unset($dataSet['ik_sign']); 
        ksort($dataSet, SORT_STRING); 
        array_push($dataSet, $test_key); 
        $signString = implode(':', $dataSet); 
        $sign = base64_encode(md5($signString, true)); 
        
        $order = Order::findOne(['id' => $dataSet['ik_pm_no']]);

        if (!$order) die;
        if ($dataSet['ik_co_id'] != $ic_co_id || $dataSet['ik_inv_st'] != 'success' ||
        $dataSet['ik_am'] != $order->res_price || $sign != $_POST['ik_sign']) {
            die;
        } 

        $order->status = 1;
        $order->save(false);
        return true;
    }

    public function actionSuccess()
    {
        return $this->render('success');
    }

    public function actionWait()
    {
        $session = Yii::$app->session;
        $session->open();

        if (empty($_POST)) {
            $this->redirect(['/cart/customer-data']);
        }

        $order = new Order();
        $this->loadOrderData($order);
       
        if ($order->save(false)) {
            $order_id = OrderProduct::saveOrderItems();

            return $this->render('wait', [
                'order_id' => $order_id,
            ]);
        }       
    }

    protected function loadOrderData($order)
    {   
        $order->res_price = $_SESSION['cart_total']['total_all'];
        $order->shipping = $_SESSION['cart_total']['shipping'];
        $order->first_name = Yii::$app->request->post('f_name');
        $order->company = Yii::$app->request->post('company');
        $order->last_name = Yii::$app->request->post('l_name');
        $order->phone = Yii::$app->request->post('number');
        $order->email = Yii::$app->request->post('email');
        $order->country = Yii::$app->request->post('country');
        $order->region = Yii::$app->request->post('region');
        $order->city = Yii::$app->request->post('city');
        $order->first_addr = Yii::$app->request->post('add1');
        $order->second_addr = Yii::$app->request->post('add2');
        $order->status = 0;
    }

    // ============= AJAX ACTIONS ===================
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