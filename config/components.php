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
        'mailer' => [
            'class'            => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db'     => require(__DIR__ . '/db.php'),
        'i18n'   => require(__DIR__ . '/i18n.php'),
    ],
];
