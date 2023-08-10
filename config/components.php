<?php
/**
 * This file is used to config components used by both `web` and `console` environment
 * and it will requried in `your_app/web/index.php` and `your_app/yii` file
 */
return [
    'components' => [
        'cache'  => [
            'class' => 'yii\caching\FileCache',
        ],
        'log'    => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        // the authManager component will be used by migration script
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'db'     => require(__DIR__ . '/db.php'),
        'i18n'   => require(__DIR__ . '/i18n.php'),
    ],
];
