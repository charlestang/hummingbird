<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Charles Tang <charlestang@foxmail.com>
 */
class AppAsset extends AssetBundle
{

    public $sourcePath = '@app/web/src';
    public $css = [
        'css/site.css',
        'css/spacing.css',
        'css/sql-highlight.css',
    ];
    public $js = [
        'js/non-ajax-submit.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\ListAsset',
    ];
}
