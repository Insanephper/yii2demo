<?php
//error_reporting(0);

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'front',
    'basePath' => dirname(__DIR__),
    //'basePath' => dirname(__DIR__) . '/../../',
	'runtimePath' => dirname(__DIR__) . '/runtime',
	'vendorPath' => dirname(__DIR__) . '/../../vendor',
    'bootstrap' => ['log'],
    'extensions' => require(__DIR__ . '/../../../vendor/yiisoft/extensions.php'),
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
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
        'db' => $db,
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
