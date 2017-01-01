<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Charles Tang <charlestang@foxmail.com>
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@app/web/css';
    public $css = [
        'site.css',
        'spacing.css',
        'sql-highlight.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
