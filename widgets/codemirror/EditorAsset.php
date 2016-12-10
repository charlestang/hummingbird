<?php

namespace app\widgets\codemirror;

use yii\web\AssetBundle;

/**
 * Description of EditorAsset
 *
 * @author charles
 */
class EditorAsset extends AssetBundle
{

    public $sourcePath = '@app/widgets/codemirror/assets';
    public $js         = [
        'editor.js',
    ];
    public $depends    = [
        'app\widgets\codemirror\CodeMirrorAsset',
    ];
}
