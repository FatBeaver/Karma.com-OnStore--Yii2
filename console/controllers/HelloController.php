<?php 

namespace console\controllers;
use backend\models\Product;

class HelloController extends \yii\console\Controller
{
    public function actionHello()
    {   
        ini_set("auto_detect_line_endings", true);
        $logFile = '/var/www/karma.com/console/runtime/logs/latest.log';
        $newWrite = print_r("\n\n===========================================// \n");
        $date = print_r('Записанно: ' . date('Y-m-d H:i:s') . "\n");

        $flow = fopen($logFile, 'a+');
        fwrite($flow, $newWrite);
        fwrite($flow, $date);

        $products = Product::find()->where(['latest' => 1])->all();
        foreach ($products as $product)
        {   
            $product->latest = 0;
            if ($product->save()) {
                $succes = print_r("Статус товара с наименованием $product->name изменен на 'Давний' \n");
                fwrite($flow, $succes); 
            } else {
                $die = print_r("Не удалось изменить статус товара $product->name \n");
                fwrite($flow, $die);
            } 
        }
        fclose($flow);
    }
}