<?php

namespace app\widgets\datetimepicker;

/**
 * Description of DateTimePickerAsset
 *
 * @author charles
 */
class DateTimePickerAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@_bower/eonasdan-bootstrap-datetimepicker/build';
    public $css = [
        'css/bootstrap-datetimepicker.min.css',
    ];
    public $js = [
        'js/bootstrap-datetimepicker.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'app\widgets\datetimepicker\MomentAsset',
    ];
}
