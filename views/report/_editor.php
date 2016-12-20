<?php

use app\models\SqlForm;
use app\widgets\codemirror\CodeMirror;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\ButtonGroup;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $sqlForm SqlForm */
?>
<div class="box">
    <div class="box-body">
        <?php
        $form    = ActiveForm::begin([
              'action'  => '',
              'method'  => 'post',
              'options' => [
                  'id' => 'editorpanel'
              ]
          ])
        ?>
        <?=
        CodeMirror::widget([
            'editorId'       => 'sqleditor',
            'editorName'     => 'sql',
            'defaultContent' => $sqlForm->sql,
        ])
        ?>
        <input type="hidden" name="database_id" value="<?= Html::encode($sqlForm->database_id) ?>"/>
        <div class="row no-padding m-b-0 m-t-1">
            <div class="col-lg-12 col-sm-12">
                <?php
                $options = [
                    'split'    => false,
                    'options'  => [
                        'class' => 'btn-success',
                    ],
                    'dropdown' => [
                        'options' => [
                            'id'    => 'connector_list',
                            'class' => 'connector-dropdown',
                        ],
                        'items'   => [],
                    ],
                ];
                foreach ($dbDropdownOptions as $dbId => $dbAlias) {
                    $options['dropdown']['items'][] = [
                        'label'       => $dbAlias,
                        'url'         => '#',
                        'linkOptions' => [
                            'data-value' => $dbId,
                        ],
                        'options'     => [
                            'class' => $sqlForm->database_id == $dbId ? 'active' : '',
                        ],
                    ];
                    if ($sqlForm->database_id == $dbId) {
                        $options['label'] = $dbAlias;
                    }
                }
                echo ButtonGroup::widget([
                    'buttons' => [
                        Button::widget([
                            'label'   => '查询',
                            'options' => [
                                'class' => 'btn-success'
                            ]
                        ]),
                        ButtonDropdown::widget($options),
                    ]
                ]);
                ?>
            </div>
        </div>
        <?php $form->end() ?>
    </div>
</div>
<?php
$editorBehaviour = <<<JS
    CodeMirror.commands.save = function(){
        $('#editorpanel').submit();
    }
    $('#btn_update').click(function() {
        $('#editorpanel').append('<input type="hidden" name="update" value="1"/>').submit();
        return false;
    });
    $('#connector_list a').click(function() {
        var \$form =$('#editorpanel');
        var connector = $(this).data('value');
        $('input[name=connector]', \$form).val(connector);
        \$form.submit();
    });
JS;
$this->registerJS($editorBehaviour);
