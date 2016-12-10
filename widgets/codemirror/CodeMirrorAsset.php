<?php

namespace app\widgets\codemirror;

use yii\web\AssetBundle;

/**
 * 小爬虫功能的SQL编辑器
 *
 * @author charles
 */
class CodeMirrorAsset extends AssetBundle
{

    public $sourcePath = '@bower/codemirror';
    public $css        = [
        'lib/codemirror.css',
        'addon/dialog/dialog.css',
        'theme/blackboard.css',
        'addon/hint/show-hint.css',
    ];
    public $js         = [
        'lib/codemirror.js',
        'addon/dialog/dialog.js',
        'addon/search/searchcursor.js',
        'keymap/vim.js',
        'mode/sql/sql.js',
        'addon/hint/show-hint.js',
        'addon/hint/sql-hint.js',
    ];
    public $depends = [
        'yii\web\YiiAsset', // depend Yii > depend jQuery
    ];
}
