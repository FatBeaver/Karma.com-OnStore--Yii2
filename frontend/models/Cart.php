<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function addToCart($product, $qty = 1)
    {   
        if(isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] += $qty;    
            $_SESSION['cart'][$product->id]['sum'] += $product->price * $qty;
        } else {
            $images = unserialize($product->images);

            $_SESSION["cart"][$product->id] = [
                'name' => $product->name,
                'image' => $images['main'], 
                'price' => $product->price,
                'qty' => $qty,
                'sum' => $product->price,
            ];
        }

        $total_qty = array_column($_SESSION['cart'], 'qty');
        $total_qty = array_sum($total_qty);
        $total_sum =  array_column($_SESSION['cart'], 'sum');
        $total_sum = array_sum($total_sum);

        $_SESSION['cart_total']['total_qty'] = $total_qty;
        $_SESSION['cart_total']['total_sum'] = $total_sum;
    }

    public function changeCountProduct($product_id, $count = 0)
    {   
        if ($count > $_SESSION['cart'][$product_id]['qty']) {
            $_SESSION['cart_total']['total_qty'] -= $_SESSION['cart'][$product_id]['qty'];
            $_SESSION['cart'][$product_id]['qty'] = $count;
            
            $_SESSION['cart_total']['total_qty'] += $count; 
            $_SESSION['cart_total']['total_sum'] += $_SESSION['cart'][$product_id]['price'];
        }
        if ($count < $_SESSION['cart'][$product_id]['qty']) {
            $_SESSION['cart_total']['total_qty'] -= $_SESSION['cart'][$product_id]['qty'];
            $_SESSION['cart'][$product_id]['qty'] = $count;

            $_SESSION['cart_total']['total_qty'] += $count; 
            $_SESSION['cart_total']['total_sum'] -= $_SESSION['cart'][$product_id]['price'];
        }
        
        return  $_SESSION['cart'][$product_id]['qty'];
    }

}