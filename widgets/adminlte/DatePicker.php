<?php

namespace app\widgets\adminlte;

use yii\base\Widget;

/**
 * The encapsulation of the Date Picker plugin of AdminLTE
 *
 * @author charles<charlestang@foxmail.com>
 */
class DatePicker extends Widget
{

    public $label = null;
    public $hideLabel = false;
    public $name = '';
    public $value = '';
    public $inputOptions = ['class' => 'datepicker'];

    public function run()
    {

        \app\widgets\adminlte\DatePickerAsset::register($this->view);
        return \app\widgets\adminlte\InputGroup::widget([
              'label'        => $this->label,
              'hideLabel'    => $this->hideLabel,
              'groupOptions' => [
                  'class'        => 'input-group date',
                  'data-provide' => 'datepicker',
              ],
              'members'      => [
                  [
                      'type'    => \app\widgets\adminlte\InputGroup::MEMBER_TYPE_ADDON,
                      'content' => '<i class="fa fa-calendar"></i>',
                  ],
                  [
                      'type'         => \app\widgets\adminlte\InputGroup::MEMBER_TYPE_CONTROL,
                      'name'         => $this->name,
                      'value'        => $this->value,
                      'control-type' => 'text',
                      'options'      => $this->inputOptions,
                  ]
              ],
        ]);
    }
}
