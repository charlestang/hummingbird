<?php

namespace app\widgets\codemirror;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * Description of CodeMirror
 *
 * @author charles
 */
class CodeMirror extends Widget
{

    /**
     * @var string 编辑器缺省加载的内容
     */
    public $defaultContent = '';

    /**
     * @var string 编辑器的ID
     */
    public $editorId = null;

    /**
     * @var string 编辑器的 name 属性
     */
    public $editorName = 'code';

    public function init()
    {
        if ($this->editorId === null) {
            $this->editorId = $this->getId();
        }
    }

    public function run()
    {
        $view = $this->getView();
        EditorAsset::register($view);
        $view->registerJs('var editor_' . ($this->editorId?$this->editorId:'') . '=editorInit("' . $this->editorId . '");');
        return Html::textarea($this->editorName, $this->defaultContent, [
            'style' => 'display: none;',
            'id' => $this->editorId,
        ]);
    }
}
