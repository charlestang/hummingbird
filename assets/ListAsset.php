<?php

namespace app\assets;

use yii\web\AssetBundle;
/**
 * Description of ListAsset
 *
 * @author charles
 */
class ListAsset extends AssetBundle
{
    public $sourcePath = '@_bower/list.js';
    public $js = [
        'dist/list.min.js',
    ];
}
