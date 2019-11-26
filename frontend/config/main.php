<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'home/index',
    'language' => 'ru_RU',
    'components' => [
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                'category/page/<page:\d+>' => 'category/index',
                'category/<id:\d+>/page/<page:\d+>' => 'category/index',
                'category/<id:\d+>' => 'category/index',
                'category' => 'category/index',

                'blog-category/<id:\d+>' => 'blog/category',
                'blog-category/<id:\d+>/page/<page:\d+>' => 'blog/category',
                'blog/page/<page:\d+>' => 'blog/index',   
                'blog/detail/<id:\d+>' => 'blog/detail', 
                'blog/page/<id:\d+>' => 'blog/index',  
                'blog' => 'blog/index',     

                'product/detail/<id:\d+>' => 'product/index',
                
                'cart/add-product/<id:\d+>' => 'cart/add-product',

                'site/profile' => 'site/profile',
                  
                '' => 'home/index',
            ],
        ],
    ],
    'params' => $params,
];
