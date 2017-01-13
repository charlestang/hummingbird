<?php

$params = require(__DIR__ . '/params.php');
$i18n = require(__DIR__ . '/i18n.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'modules' => require(__DIR__ . '/modules.php'),
    'params' => $params,
    'components' => [
        'i18n' => $i18n,
    ],
];


if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
