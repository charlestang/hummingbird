<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Hummingbird',
    'language' => 'zh-CN',
    'sourceLanguage' => 'en-US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    //NOTE: components in this section are all used by web application
    //      components used by both web and console application should be 
    //      put in components.php
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) -
            // this is required by cookie validation
            'cookieValidationKey' => 'xNMSvlVtnsv5nSripgdIjbE1Uu3GkRGe',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue',
                    //'skin' => 'skin-blue-light',
                    //'skin' => 'skin-yellow',
                    //'skin' => 'skin-yellow-light',
                    //'skin' => 'skin-green',
                    //'skin' => 'skin-green-light',
                    //'skin' => 'skin-purple',
                    //'skin' => 'skin-purple-light',
                    //'skin' => 'skin-red',
                    //'skin' => 'skin-red-light',
                    //'skin' => 'skin-black',
                    //'skin' => 'skin-black-light',
                ],
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => 'google_client_id',
                    'clientSecret' => 'google_client_secret',
                ],
                /*
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => 'facebook_client_id',
                    'clientSecret' => 'facebook_client_secret',
                ],
                // etc.
                 */
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/logout',
            'site/login',
            'site/auth',
            'site/about',
            'site/reset-password',
        ],
    ],
    'modules'        => [
        'admin' => [
            'class'         => 'mdm\admin\Module',
            'layout'        => 'left-menu',
            'mainLayout'    => '@app/views/layouts/main.php',
            'controllerMap' => [
                'assignment' => [
                    'class'        => 'mdm\admin\controllers\AssignmentController',
                    'extraColumns' => [[
                          'class' => '\yii\grid\DataColumn',
                          'label' => 'Roles',
                          'value' => function($user) {
                              $roles = Yii::$app->authManager->getRolesByUser($user->id);
                              return empty($roles) ? '' : implode(',',
                                                                  array_map(function($arrItem) {
                                        return $arrItem->name;
                                    }, $roles));
                          }
                        ]],
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
    $config['as access']['allowActions'][] = 'debug/*';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['as access']['allowActions'][] = 'gii/*';
    $config['components']['authClientCollection']['clients'] = require(__DIR__ . '/oauth_clients.php');
}

return $config;
