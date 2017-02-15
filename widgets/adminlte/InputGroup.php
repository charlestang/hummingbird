<?php

namespace app\widgets\adminlte;

use Yii;
use yii\base\Widget;
use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;

/**
 * Description of InputGroup
 *
 * @author charles
 */
class InputGroup extends Widget
{

    const MEMBER_TYPE_ADDON   = 'addon';
    const MEMBER_TYPE_CONTROL = 'control';

    public $wrapperOptions = ['class' => 'form-group'];
    public $groupOptions   = ['class' => 'input-group'];
    public $label          = null;
    public $hideLabel      = false;
    public $for            = '';
    public $members        = [];

    public function run()
    {
        BootstrapAsset::register($this->view);
        $html = '';
        foreach ($this->members as $member) {
            switch ($member['type']) {
                case self::MEMBER_TYPE_ADDON:
                    unset($member['type']);
                    $html .= $this->renderAddon($member);
                    break;
                case self::MEMBER_TYPE_CONTROL:
                    unset($member['type']);
                    $html .= $this->renderControl($member);
                    break;
                default:
                    break;
            }
        }
        $html = Html::tag('div', $html, $this->groupOptions);
        if ($this->label) {
            $options = [];
            if ($this->hideLabel) {
                $options['class'] = 'sr-only';
            }
            $html = Html::label($this->label, $this->for, $options) . $html;
        }

        return Html::tag('div', $html, $this->wrapperOptions);
    }

    protected function renderAddon($config)
    {
        if (!isset($config['content'])) {
            $config['content'] = '';
        }
        if (!isset($config['options'])) {
            $config['options'] = [
                'class' => 'input-group-addon',
            ];
        } elseif (isset($config['options']['class'])) {
            $config['options']['class'] = 'input-group-addon ' . $config['options']['class'];
        } else {
            $config['options']['class'] = 'input-group-addon';
        }
        return Html::tag('div', $config['content'], $config['options']);
    }

    protected function renderControl($config)
    {
        if (isset($config['config'])) {
            $widget = Yii::createObject($config['config']);
            return $widget->run();
        }
        if (!isset($config['name'])) {
            $config['name'] = '';
        }
        if (!isset($config['value'])) {
            $config['value'] = '';
        }
        if (!isset($config['options'])) {
            $config['options'] = [
                'class' => 'form-control',
            ];
        } elseif (isset($config['options']['class'])) {
            $config['options']['class'] = 'form-control ' . $config['options']['class'];
        } else {
            $config['options']['class'] = 'form-control ';
        }
        return Html::input($config['control-type'], $config['name'], $config['value'], $config['options']);
    }
}
