<?php

namespace app\widgets\datetimepicker;

use yii\web\AssetBundle;

/**
 * Description of MomentAsset
 *
 * @author charles
 */
class MomentAsset extends AssetBundle
{

    public $sourcePath = '@bower/moment/min';
    public $js         = [
        'moment-with-locales.min.js',
    ];
}
