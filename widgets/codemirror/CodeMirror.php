<?php

namespace app\widgets\codemirror;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * This widget will show a code editor on the web page.
 *
 * @author charles
 */
class CodeMirror extends Widget
{

    /**
     * @var string the content editor will load default
     */
    public $defaultContent = '';

    /**
     * @var string the container id of the editor
     */
    public $editorId = null;

    /**
     * @var string the form field name of the editor
     */
    public $editorName = 'code';

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->editorId === null) {
            $this->editorId = $this->getId();
        }
    }

    /**
     * @inheritdoc
     */
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
