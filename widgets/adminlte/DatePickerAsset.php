<?php

namespace app\widgets\adminlte;

use yii\web\AssetBundle;

/**
 * The date picker asset bundle
 *
 * @author charles <charlestang@foxmail.com>
 */
class DatePickerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $css = [
        'datepicker/datepicker3.css',
    ];
    public $js = [
        'datepicker/bootstrap-datepicker.js'
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
