<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'vi',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_cmsIdentity',
                'httpOnly' => true,
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => '/site/index',
                'login' => '/site/login',
                'logout' => '/site/logout',
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logFile' => '@logs/cms/error.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['warning'],
                    'logFile' => '@logs/cms/warning.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'logFile' => '@logs/cms/info.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['yii\db\Command*'],
                    'levels' => ['info'],
                    'logVars' => [],
                    'logFile' => '@logs/cms/queries.log',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
        'request' => [
            'enableCsrfCookie' => false,
        ],
        'gridview' => 'kartik\grid\Module',
        'encoder' => [
            'class' => 'mongosoft\soapclient\Client',
            'url' => 'http://localhost:9899/MappingEncoderWS?wsdl',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
            ],
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ],
        'gridview' => 'kartik\grid\Module',
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
        ]
    ],
    'params' => $params,
];
